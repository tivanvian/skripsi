<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ZivarSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zivar:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Zivar Installation Command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting Zivar installation...');

        $this->info('Refreshing database...');
        $this->call('migrate:refresh');
        
        $this->info('Installing Telescope...');
        $this->call('telescope:install');

        $this->info('Seeding database...');
        $this->call('db:seed');

        $this->info('Clearing cache...');
        $this->call('optimize:clear');

        $this->info('Generating new key...');
        $this->call('key:generate');

        //publish all vendor --all
        $this->info('Publishing vendor...');
        $this->call('vendor:publish', ['--all' => true]);
        $this->call('vendor:publish', ['--tag' => 'datatables']);

        $this->info('Zivar installation completed.');
        return 0;
    }
}
