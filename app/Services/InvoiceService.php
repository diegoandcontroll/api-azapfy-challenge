<?php

namespace App\Services;

use App\Jobs\GenerateInvoicePDF;
use App\Models\Invoice;
use App\Notifications\InvoiceStoredNotification;
use App\Repositories\Eloquent\InvoiceRepository;
use App\Validators\InvoiceValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;

class InvoiceService
{
    private $invoiceRepository;


    public function __construct(InvoiceRepository $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function getUserInvoices()
    {
        $userId = Auth::id();
        return $this->invoiceRepository->getUserInvoices($userId);
    }


    public function getInvoiceById(string $invoiceId): Invoice
    {
        return $this->invoiceRepository->findInvoiceById($invoiceId);
    }

    public function createInvoice(array $validatedData): Invoice
    {
        $currentUser = Auth::user();

        $invoice = new Invoice();
        $invoice->fill($validatedData);
        $invoice->emission_date = now();
        $invoice->user_id = optional($currentUser)->id;
        $currentUser->notify(new InvoiceStoredNotification($invoice->toArray()));
        $invoiceCreated = $this->invoiceRepository->createInvoice($invoice);
        dispatch(new GenerateInvoicePDF($invoice->toArray(), $invoice))->onQueue('invoices');
        return $invoice;
    }

    public function updateInvoice(Invoice $invoice, array $data): Invoice
    {
        $invoice = $this->parseData($invoice, $data);
        $invoiceUpdated = $this->invoiceRepository->updateInvoice($invoice);
        return $invoiceUpdated;
    }

    public function deleteInvoice(Invoice $invoice)
    {
        return $this->invoiceRepository->deleteInvoice($invoice);
    }


    private function parseData(Invoice $invoice, array $data): Invoice
    {
        $invoice->amount = $data['amount'];
        $invoice->sender_cnpj = $data['sender_cnpj'];
        $invoice->sender_name = $data['sender_name'];
        $invoice->transporter_cnpj = $data['transporter_cnpj'];
        $invoice->transporter_name = $data['transporter_name'];
        return $invoice;
    }
    public function getUserInvoicesPaginated($userId, $perPage)
    {
        return $this->invoiceRepository->getUserInvoicesPaginated($userId, $perPage);
    }
}
