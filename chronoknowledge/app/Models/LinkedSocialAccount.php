<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LinkedSocialAccount extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'email',
        'provider_name',
        'provider_id'
    ];

    /**
     * Store or update new linked social account
     *
     * @param App\Models\User $user
     * @param mixed $googleUser
     */
    public function store($user, $googleUser) {
        return $this->updateOrCreate([
            'user_id' => $user->id,
            'provider_id' => $googleUser->id,
            'provider_name' => 'google',
            'email' => $googleUser->email,
        ]);
    }
}
