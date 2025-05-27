<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File; // Add this import

class RemoveBladeComments extends Command
{
    protected $signature = 'remove:blade-comments';
    protected $description = 'Remove all Blade comments from view files';

    public function handle()
    {
        $viewsPath = resource_path('views');
        
        $files = collect(File::allFiles($viewsPath))
            ->filter(fn ($file) => str_ends_with($file->getPathname(), '.blade.php'));

        $this->withProgressBar($files, function ($file) {
            $content = File::get($file->getPathname());
            $cleaned = preg_replace('/\{\{--.*?--\}\}/s', '', $content);
            File::put($file->getPathname(), $cleaned);
        });

        $this->newLine();
        $this->info("Successfully removed comments from {$files->count()} Blade templates.");
        
        return Command::SUCCESS;
    }
}