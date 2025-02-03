<?php

namespace App\Jobs;

use App\Services\StatService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SyncStats implements ShouldQueue
{
    use Queueable;

    protected $dateFrom;
    protected $dateTo;
    protected $type;
    protected $statService;
    /**
     * Create a new job instance.
     */
    public function __construct($dateFrom, $dateTo, $type)
    {
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->type = $type;
        $this->statService = new StatService();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->statService->generateStat($this->dateFrom, $this->dateTo, $this->type);
    }
}
