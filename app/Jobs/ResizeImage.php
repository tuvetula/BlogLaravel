<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class ResizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var string
     */
    private $path;

    /**
     * Create a new job instance.
     *
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $formats = [50,100];
        $manager = new ImageManager();
        foreach ($formats as $format){
            $manager->make(Storage::get('public/'.$this->path))->fit($format,$format)
                ->save(public_path('storage/avatarsMiniatures'.$format.'x'.$format.'/'.basename($this->path)));
        }
    }
}
