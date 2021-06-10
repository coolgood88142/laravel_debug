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
        return [
            'invoice_number' => '001'
        ];
    }
}