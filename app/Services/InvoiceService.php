<?php 

namespace App\Services;

use App\Models\Invoice;

class InvoiceService 
{ 
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }
}