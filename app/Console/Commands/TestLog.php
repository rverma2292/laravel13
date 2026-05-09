<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

#[Signature('app:test-log')]
#[Description('Test logging functionality')]
class TestLog extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('This is an info log message from TestLog command.');
        Log::warning('This is a warning log message from TestLog command.');
        Log::error('This is an error log message from TestLog command.');
        $confirm = $this->confirm('Do you want to continue?');
        if (!$confirm) {
            $this->error('User denied access to this action.');
        }
        $name = $this->anticipate('What is your name?', ['Alice', 'Bob', 'Charlie']);
        if (!empty($name)) {
            $this->info("Hello, $name! Welcome to the TestLog command.");
        }
        $this->info('Log messages have been written. Check your log files.');


        return Command::SUCCESS;
    }
}
