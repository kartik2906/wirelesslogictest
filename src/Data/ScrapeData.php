<?php
namespace App\Data;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;


class ScrapeData{

  private $client;
  private $crawler;
  
  public function __construct(){
    $this->client = new Client();
    $this->crawler = new Crawler();
    $this->crawler = new Crawler( $this->getNode());
   
  }
  
  public function getUrl(){
   return  $this->client->request('GET', 'https://videx.comesconnected.com/');
  }

  public function getNode(){
      return  $this->getUrl()->getNode(0);
   }

  public function fetchItems(){
   
    $scrapeItems = [];
    $package = [];

    foreach($this->crawler->filter('.package') as $dom){ 
        $crawler = new Crawler($dom);
        $scrapeItems['title'] = $crawler->filter('h3')->text();
        $scrapeItems['description'] = $crawler->filter('.package-name')->text();
        $scrapeItems['price'] = $crawler->filter('.package-price > span')->text();
       
        $package[] = $scrapeItems;
      
    }
    return $package;
  }


}