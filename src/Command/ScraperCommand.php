<?php
// Ontf/ScraperBundle/Command/ScraperCommand.php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use App\Data\ScrapeData;
use Symfony\Component\HttpFoundation\JsonResponse;

class ScraperCommand extends Command
{
    public $crawler;
    protected static $defaultName = 'app:scrape';
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure()
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output) 
    {
        $data = new ScrapeData();
        $data->getUrl();
        $package = $data->fetchItems();  
        
        krsort($package);
        
        echo new JsonResponse($package);
    }
}