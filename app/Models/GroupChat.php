<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupChat extends Model
{
    use HasFactory;
    protected $fillable=[
        'sender_id',
        'group_id',
        'message',
    ];

    public function userInfo(){
        return $this->belongsTo(User::class, 'sender_id','id');
    }
}
