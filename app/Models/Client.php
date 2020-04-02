<?php

namespace App\Models;;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Client extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'clients';

    protected $fillable = [
        'name', 'email'
    ];

    public function phones()
    {
        return $this->hasMany( 'App\Models\Phone');
    }

    public function user()
    {
        return $this ->belongsTo('App\Models\User');
    }
}
