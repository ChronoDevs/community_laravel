<?php
namespace App\Http\Services;

use App\Models\{PostLike, Notification};
use Illuminate\Support\Facades\{DB, Log, Cache};
use App\Components\ResponseComponent;
use App\Http\Repositories\NotificationRepository;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Throwable;

class PostLikeService
{
    private $response;
    private $postLike;
    private $notification;
    private $notifRepository;

    public function __construct(ResponseComponent $response, NotificationRepository $nofifRepository)
    {
        $this->response = $response;
        $this->postLike = app(PostLike::class);
        $this->notification = app(Notification::class);
        $this->notifRepository = $nofifRepository;
    }

    public function index() {
        return $this->postLike->postLikesList();
    }

    public function getLikesByYear() {
        return $this->postLike->likesByYearList();
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $lock = Cache::lock('like', 10);

            try {
                $lock->block(5);
                $postLike = PostLike::create([
                    'user_id' => $request['user_id'],
                    'post_id' => $request['post_id'],
                ]);
                // Lock acquired after waiting a maximum of 5 seconds...
            } catch (LockTimeoutException $e) {
                Log::error($e);
                // Unable to acquire lock...
            } finally {
                $lock?->release();
            }

            if ($postLike) {
                $data = [
                    'user_id' => $postLike->user,
                    'receiver_id' => $postLike->post->user,
                    'post_id' => $postLike->post,
                    'notification_type' => 'liked'
                ];

                $this->notifRepository->createNotif($data);
            }
            DB::commit();

            return $this->response->succeed('post', 'create');
        } catch (Throwable $e) {
            DB::rollback();
            Log::error($e);

            return $this->response->fail('post', 'create');
        }
    }

    /**
     * Function to delete or unlike a post
     *
     * @param int $post_id
     * @param int $user_id
     *
     * @return array|mixed
     */
    public function destroy($post_id, $user_id)
    {
        try {
            PostLike::where('user_id', $user_id)
                ->where('post_id', $post_id)
                ->whereNull('deleted_at')
                ->lockForUpdate()
                ->first()
                ->delete();

            return $this->response->succeed('post', 'delete');
        } catch (Throwable $e) {
            return $this->response->fail('post', 'delete');
        }
    }
}
