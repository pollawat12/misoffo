<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceHasReceipt extends Model
{
    use HasFactory;

    protected $table = 'invoice_has_receipts';
    
    public $timestamps = false;

    
    
    /**
     * getReceiptWithInvoiceId
     *
     * @param  mixed $id
     * @return void
     */
    public static function getReceiptWithInvoiceId($id=0)
    {
        return self::where('invoice_details_id', (int) $id)->orderBy('updated_at', 'desc')->get();
    }

    
}
