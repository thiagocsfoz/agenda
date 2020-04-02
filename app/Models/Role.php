<?php

namespace App\Models;;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Role extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'roles';

    protected $fillable = [
        'name'
    ];

    public function group()
    {
        return $this ->belongsTo('App\Models\Group');
    }
}
