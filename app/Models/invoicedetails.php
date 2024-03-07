<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class invoicedetails extends Model
{
    use HasFactory;
    // protected $guarded=[];
    protected $fillable = [
        'product_name',
        'unit',
        'quantity',
        'unit_price',
        'row_sub_total',
    ];
    /**
     * Get the user that owns the invoicedetails
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(invoice::class, 'invoice_id', 'id');
    }
}
