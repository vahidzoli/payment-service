<?php

namespace App\Console\Commands;

use App\Imports\ProductsImport;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportProductCSVFile extends Command
{
    private $client;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products.csv file to database';

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
     * @return int
     */
    public function handle()
    {
        $response = $this->client->request('GET', config('credential.product_file_url'), [
            'auth' => [config('credential.user'), config('credential.pass')]
        ]);

        Storage::disk('public')->put('files/products.csv', $response->getBody());

        if (Storage::disk('public')->exists('/files/products.csv')) {
            $this->output->title('Starting import');

            (new ProductsImport)->withOutput($this->output)->import('/files/products.csv', 'public');

            $this->output->success('Import successful');
        } else {
            return $this->info('File not found');
        }

        return $this->info('File successfully imported to database.');
    }
}
