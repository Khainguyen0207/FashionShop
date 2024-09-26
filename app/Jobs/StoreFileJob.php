<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;

class StoreFileJob implements ShouldQueue
{
    use Queueable;

    protected $filename;

    protected $content;

    public function __construct($filename, $content)
    {
        $this->filename = $filename;
        $this->content = $content;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Storage::disk('public')->put($this->filename, $this->content);
    }
}
