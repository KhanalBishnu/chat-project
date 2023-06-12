<?php

namespace App\Models;

use App\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model implements  HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $fillable=[
        'creator_id',
        'name',
        'join_limit',
    ];
    public function user(){
        return $this->belongsTo(User::class, 'creator_id','id');
    }
}
