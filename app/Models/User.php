<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
        /**
 * @OA\Schema(
 *   schema="User",
 *   type="object",
 *   required={"id","name","email"},
 *   @OA\Property(property="id", type="integer", example=1),
 *   @OA\Property(property="name", type="string", example="Juan Pérez"),
 *   @OA\Property(property="email", type="string", format="email", example="juan@example.com"),
 *   @OA\Property(property="email_verified_at", type="string", format="date-time", nullable=true, example="2025-09-01T10:15:30.000000Z"),
 *   @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-01T10:15:30.000000Z"),
 *   @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-01T12:45:10.000000Z")
 * )
 */

class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'password' => 'hashed',
    ];

}
