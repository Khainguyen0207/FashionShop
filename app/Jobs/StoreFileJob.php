<?php

namespace App\Jobs;

use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

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
