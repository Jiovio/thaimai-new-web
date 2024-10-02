<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
  //  protected $fillable = [
       /* 'name', 
        'username', 
        'email', 
        'mobile', 
        'usertype', // Add this to align with your schema
        'status', 
        'createdBy', // Include createdBy for user creation
        // 'password', // Exclude if you don’t want to set it during creation
        // 'token', // Exclude if you don’t want to set it during creation */
        protected $fillable = [ 
            'name', 
            'username', 
            'email', 
            'mobile', 
            'usertype', // Specifies user role
            'HosId', 
            'BlockId', 
            'PhcId', 
            'HscId', 
            'PanchayatId', 
            'VillageId', 
            'encpassword', // If needed for encryption
            'password', // Only if you intend to set it during creation
            'token', // For API authentication
            'emailVerified', 
            'phoneVerified', 
            'status', 
           'createdBy', // User who created the record
           'updatedBy', // User who updated the record            
         'otp', // Include if using OTP
         'otp_expires_at',
        ];
        
 //   ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', // Include if you want to hash passwords
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
      //  'emailVerified' => 'integer', // Cast if you need to work with it
        'phoneVerified' => 'integer', // Cast if you need to work with it
        // Add any other casts you might need
        'otp_expires_at' => 'datetime',
    ];

    public $timestamps = false; // Set to false since your table does not use default timestamps

    // You may want to set the primary key and table if they differ
    protected $table = 'users';
    protected $primaryKey = 'id';
}
