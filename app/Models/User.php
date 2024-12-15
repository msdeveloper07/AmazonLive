<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'facebook_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

     public function userGroup() {
         return $this->belongsTo('App\Models\UserGroup','user_group_id');
    }
    
    public static function checkPermission($user_group_id,$element,$title)
        {
            $permission = DB::table('user_group_permissions as up')
                            ->leftJoin('permissions as p','p.permission_id','=','up.permission_id')
                            ->where('up.user_group_id',"'.$user_group_id.'")
                            ->where('p.element',"'.$element.'")
                            ->where('p.title',"'.$title.'")
                            ->count();
            
            if($permission>0)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
            
        }
    
}


