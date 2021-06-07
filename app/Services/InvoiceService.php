<?php 

namespace App\Services;

class InvoiceService 
{
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }
    
    public function newInvoice(array $data)
    {
        $now = array_push($data, "invoice3");
        return $now;
    }
}