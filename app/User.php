<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
use DB;

class User extends Authenticatable
{
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function roles()
    {
      return $this->belongsToMany(Role::class);
    }
    
    /**
    * @param string|array $roles
    */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {

            return $this->hasAnyRole($roles);
        }

        return $this->hasRole($roles) || abort(401, 'This action is unauthorized.');
    }

    /**
    * Check multiple roles
    * @param array $roles
    */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    /**
    * Check one role
    * @param string $role
    */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }
    
    /** 
    * get student user
    */
    public static function getStudentUsers()
    {
        $student_user = DB::table('roles')
                ->join('role_user', 'role_id', '=', 'roles.id')
                ->join('users', 'users.id', '=' , 'user_id' )
                ->where('role_id', '<>', '2')
                ->get();
        return $student_user;
    }
   
    /**
     * Delete Role from role user
     */
    
    public static function trashRole($id)
    {
        $delete_role = DB::table('role_user')->where('user_id','=',$id)->delete();
        return $delete_role;
    }
}
