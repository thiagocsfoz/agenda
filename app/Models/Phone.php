<?php

namespace App\Models;;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Phone extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'phones';

    protected $fillable = [
        'number'
    ];

    public function client()
    {
        return $this ->belongsTo('App\Models\Client');
    }
    //

    function numberformated() {
        $fone = $this->number;

        if (strlen($fone) == 10) {
            return '(' . substr($fone, 0, 2) . ') ' . substr($fone, 2, 4) . '-' . substr($fone, 6);
        }

        if (strlen($fone) == 11) {
            return '(' . substr($fone, 0, 2) . ') ' . substr($fone, 2, 5) . '-' . substr($fone, 7);
        }

        return $fone;
    }
}
