<?php

namespace App\Jobs\Batch;

use App\Services\Admin\Batch\JudgmentDocumentService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessPdf2 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected $batchId
    )
    {
    }

    /**
     * Execute the job.
     */
    public function handle(JudgmentDocumentService $judgmentDocumentService): void
    {
        $judgmentDocumentService->processPdf2($this->batchId);
    }
}
