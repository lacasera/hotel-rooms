<?php
namespace App\Console\Commands;

use App\AdvertisersFactory;
use App\Events\RoomsPooled;
use Illuminate\Console\Command;
use Illuminate\Support\LazyCollection;


class PoolAdvertisersCommand extends Command
{
    
    protected $signature = 'advertisers:pool';

    protected $description = 'Gets Hotel and room information from various advertisers we support';

    protected $advertisersClassPath;

    public function __construct()
    {
        parent::__construct();

        $this->advertisersClassPath = app()->path() . DIRECTORY_SEPARATOR . "Advertisers";
    }

    public function handle()
    {
        $advertiserClassFiles = array_diff(scandir($this->advertisersClassPath),  ['..', '.']);

        LazyCollection::make($advertiserClassFiles)->each(
            fn ($class) => $this->runAdvertiserClass($class)
        );
    }

    private function runAdvertiserClass(string $advertiser) 
    {
        $this->info("Running $advertiser");
        $rooms = (new AdvertisersFactory)->make($advertiser)->pool();

        event(new RoomsPooled($rooms));
    }
}