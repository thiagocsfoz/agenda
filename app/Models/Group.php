<?php

namespace App\Models;;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Group extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'groups';

    protected $fillable = [
        'name'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public function roles()
    {
        return $this->hasMany('App\Models\Role');
    }

    public function verifyRole($roleName)
    {
        foreach ($this->roles as $role)
        {
            if($role->name == $roleName)
                return true;
        }

        return false;
    }
}
