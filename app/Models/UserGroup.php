<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{

    protected $primaryKey = 'user_group_id';
 
    protected $table = 'user_groups';
    protected $fillable = array('user_group_name');

}
