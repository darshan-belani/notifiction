<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Posts extends Model
{
    use SoftDeletes , Notifiable;

    protected $table = 'post';
}
