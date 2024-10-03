<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class StoreFileJob implements ShouldQueue
{
    use Dispatchable;
    use Queueable;

    protected $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $req = Http::get('https://picsum.photos/200');
        Storage::disk('public')->put($this->filename, $req->body());
    }
}
