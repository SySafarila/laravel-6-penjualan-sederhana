<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceProduct extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }
}
