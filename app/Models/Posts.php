<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    //
    protected $fillable = ['body','title','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
