<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

/**
 * Class ParseCurrencies
 * @package App\Console\Commands
 */
class ParseCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:currencies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will parse xml on specific url and update currency table in database';

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
     * Get data from xml and Create new records of currency or update existed if specified date is provided
     *
     * @return int
     */
    public function handle()
    {
        $xml = simplexml_load_file('https://nationalbank.kz/rss/rates_all.xml?switch=russian');
        foreach($xml->channel->item as $item){
            $date = $time = strtotime($item->pubDate);
            \App\Currency::updateOrCreate(['name' => $item->title, 'date' => date('Y-m-d',$date)], [
                'rate' => $item->description
            ]);
        }
        $this->info('Currencies table were updated');
    }
}
