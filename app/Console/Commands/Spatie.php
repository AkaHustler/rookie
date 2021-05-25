<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Browsershot\Browsershot;

class Spatie extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Spatie:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Spatie:run';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Browsershot::url("https://china.nba.com/")
            ->save("/Users/houzhongbo/Desktop/tips/test.jpeg");
    }
}
