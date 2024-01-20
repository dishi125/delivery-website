<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Transaction
 * @package App\Models
 * @version June 1, 2020, 5:07 am UTC
 *
 * @property integer $payment_id
 * @property integer $payer_id
 * @property integer $amount
 * @property string $description
 * @property string $invoice
 * @property string $status
 */
class Transaction extends Model
{
    public $table = 'transaction';

    public $fillable = [
        'payment_id',
        'payer_id',
        'amount',
        'description',
        'invoice',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'payment_id' => 'integer',
        'payer_id' => 'integer',
        'amount' => 'integer',
        'description' => 'string',
        'invoice' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


}
