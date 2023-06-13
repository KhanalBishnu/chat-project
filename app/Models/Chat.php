<?php

namespace App\Models;

use App\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model implements HasMedia
{
    use HasFactory ,InteractsWithMedia;
    protected $fillable=[
        'sender_id',
        'receiver_id',
        'message'
    ];

    public function user(){
        return $this->belongsTo(User::class,'receiver_id', 'id',);
    }
    public function userDetail(){
        return $this->belongsTo(User::class,'sender_id', 'id',);
    }
}
