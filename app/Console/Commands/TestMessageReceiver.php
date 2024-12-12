<?php

namespace App\Console\Commands;

use App\Events\MessageReceived;
use Illuminate\Console\Command;

class TestMessageReceiver extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test-message-receiver';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $this->info('Testando mensagem');
        
        MessageReceived::dispatch();
        
        $this->info('Mensagem Enviada');
        return 0;
    }
}
