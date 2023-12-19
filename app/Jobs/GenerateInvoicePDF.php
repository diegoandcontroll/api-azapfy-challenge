<?php

namespace App\Jobs;

use App\Notifications\InvoiceGenerated;
use App\Repositories\Eloquent\InvoiceRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;
use Illuminate\Support\Str;
use Spatie\Dropbox\Client as DropboxClient;

class GenerateInvoicePDF implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $invoice;
    /**
     * Create a new job instance.
     */
    public function __construct($data,$invoice)
    {
        $this->data = $data;
        $this->invoice = $invoice;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {

        try {
            $uniqueId = Str::uuid();
            $pdf = PDF::loadView('templates.invoice', $this->data)->output();
            $fileName = 'nota_fiscal_' . $uniqueId . '.pdf';
            $filePath = public_path($fileName);
            file_put_contents($filePath, $pdf);
            return dispatch(new ProcessInvoiceFileJob($filePath, $this->invoice->id))->onQueue('invoices-process');
        } catch (\Exception $e) {
            return 'Erro durante a geração do arquivo: ' . $e->getMessage();
        }
    }
}
