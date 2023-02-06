<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\CanResetPassword;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserRole;
use App\Enums\UserGender;
use Throwable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    // use MustVerifyEmail;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'email',
        'username',
        'password',
        'name',
        'nick_name',
        'birth_date',
        'gender',
        'zip_code',
        'address',
        'tel',
        'profile'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function registerUser($data)
    {
        $data['date_of_birth'] = $this->formatDate($data['date_of_birth']);
        try {
            $user = $this->create([
                'role_id' => UserRole::USER,
                'email' => $data['email'],
                'username' => $data['username'],
                'password' => Hash::make($data['password']),
                'name' => $this->setName($data['first_name'], $data['middle_name'], $data['last_name']),
                'nick_name' => $data['nick_name'],
                'birth_date' => Carbon::createFromFormat('Y-m-d', $this->formatDate($data['date_of_birth'])),
                'birth_date' => now(),
                'gender' => UserGender::GENDERS[$data['gender']],
                'zip_code' => $data['zip_code'],
                'address' => $data['address'],
                'tel' => $data['contact_number']
            ]);

            return true;
        } catch (Throwable $e) {
            return false;
        }
    }

    /**
     * Sets the user name
     */
    public function setName($firstName, $middleName, $lastName)
    {
        return $firstName . ' ' . $middleName . ' ' . $lastName;
    }

    public function formatDate($date)
    {
        $date = explode('-', $date);

        return $date[2] . '-' . $date[1] . '-' . $date[0];
    }

    /**
     * Route notifications for the Slack channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForSlack($notification)
    {
        return config('app.slack_channel');
    }
}
