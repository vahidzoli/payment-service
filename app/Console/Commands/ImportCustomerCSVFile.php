<?php

namespace App\Console\Commands;

use App\Imports\CustomersImport;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportCustomerCSVFile extends Command
{
    private $client;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:customers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import customers.csv file to database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        parent::__construct();
        $this->client = $client;
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $response = $this->client->request('GET', config('credential.customer_file_url'), [
            'auth' => [config('credential.user'), config('credential.pass')]
        ]);

        Storage::disk('public')->put('files/customers.csv', $response->getBody());

        if (Storage::disk('public')->exists('/files/customers.csv')) {
            $this->output->title('Starting import');
            
            (new CustomersImport)->withOutput($this->output)->import('/files/customers.csv', 'public');

            $this->output->success('Import successful');
        } else {
            return $this->info('File not found');
        }

        $this->info('File successfully imported to database.');
    }
}
