<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'user_id', 'comments_id', 'twets_id', 'balas'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }


    public function isComents(){
        return $this->comments_id == null;
    }

    public function balas($id){
       $balas = $this->twet->id == $id && $this->comments_id != null;

       return $balas;
    }
    public function isUser(){
        return $this->user_id == Auth()->id();
    }
}