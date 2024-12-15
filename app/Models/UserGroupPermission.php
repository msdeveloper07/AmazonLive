<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroupPermission extends Model
{

    
    protected $primaryKey = 'user_group_permission_id';
    protected $table = 'user_group_permissions';
    protected $fillable = array('user_group_id','permission_id');

}
