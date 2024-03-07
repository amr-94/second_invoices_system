<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class invoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get all of the comments for the invoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details(): HasMany
    {
        return $this->hasMany(invoicedetails::class, 'invoice_id', 'id');
    }
}
