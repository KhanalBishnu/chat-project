<?php

namespace App\Models;

use App\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FriendShip extends Model  implements HasMedia
{
    use HasFactory , InteractsWithMedia;
    protected $fillable=[
        'user_id',
        'friend_id',
        'status'
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id' );
    }
    public function user(){
        return $this->belongsTo(User::class, 'friend_id' );
    }

    public function friends(){
        return $this->belongsTo(User::class, 'user_id','friend_id');
    } 
   


   
}
