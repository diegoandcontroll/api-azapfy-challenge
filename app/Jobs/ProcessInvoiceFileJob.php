<?php

namespace App\Jobs;

use App\Models\Invoice;
use App\Notifications\InvoiceGenerated;
use App\Repositories\Eloquent\InvoiceRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ProcessInvoiceFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;
    public $invoiceId;
    public $repo;

    public function __construct($filePath, $invoiceId)
    {
        $this->filePath = $filePath;
        $this->invoiceId = $invoiceId;
        $this->repo = new InvoiceRepository();
    }

    public function handle()
    {
        $this->clearPdf();
        $user = Auth::user();

        $url = url(basename($this->filePath));
        $invoice = Invoice::findOrFail($this->invoiceId);
        $urlFormated = str_replace('\/', '/', $url);
        $invoice->file = $urlFormated;
        $invoice->save();
        return $user->notify(new InvoiceGenerated($url));
    }
    public function clearPdf()
    {
        $pdfFiles = glob(public_path('*.pdf'));

        if (count($pdfFiles) > 100) {
            foreach ($pdfFiles as $file) {
                if (pathinfo($file, PATHINFO_EXTENSION) === 'pdf') {
                    unlink($file);
                }
            }
        }
    }
}
