<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'message';

    protected $fillable = ['id_user','name_user','date','text'];


}
