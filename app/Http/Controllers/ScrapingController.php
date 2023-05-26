<?php

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\CssSelector\CssSelectorConverter;

class ScrapingController extends Controller
{
    public function scrapeRealEstateAgencies(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $url = "https://www.google.com/maps/search/agentie+imobiliara/@{$latitude},{$longitude},15z/data=!3m1!4b1?entry=ttu";

        $client = new Client();
        $crawler = $client->request('GET', $url);

        $data = [];

        $crawler->filter('.section-result-content')->each(function (Crawler $node) use (&$data) {
            $name = $node->filter('.section-result-title')->text();
            $phoneNumber = $node->filter('.section-result-phone-number')->text();
            $website = $node->filter('.section-result-action-button-text')->attr('href');

            $data[] = [
                'name' => $name,
                'phone_number' => $phoneNumber,
                'website' => $website,
            ];
        });

        // Debugging statements
        $converter = new CssSelectorConverter();
        $cssSelector = $converter->toXPath('.section-result-content');
        $count = $crawler->filterXPath($cssSelector)->count();

        return response()->json([
            'data' => $data,
            'count' => $count,
        ]);
    }
}
