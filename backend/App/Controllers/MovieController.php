<?php

namespace ZenithPHP\App\Controllers;

use DOMXPath;
use ZenithPHP\Core\Controller\Controller;
use hmerritt\Imdb;
use ZenithPHP\Core\Http\Request;
use ZenithPHP\Core\Http\Response;

class MovieController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $response->json(['message' => 'Welcome to ZenithPHP!']);
    }

    public function getMovie(Request $request, Response $response)
    {
        $imdb = new Imdb();
        $data = $imdb->search("Iron Man");
        $response->json($data['titles']);
    }

    public function getBoxOfficeList(Request $request, Response $response): void
    {
        $curl = curl_init();
        $request_type = "GET";
        $url = "https://www.imdb.com/chart/boxoffice/";
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => $request_type,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_RETURNTRANSFER => true,
        ]);
        $r = curl_exec($curl);
        curl_close($curl);

        if ($r === false) {
            // Handle the cURL error
            die('Error fetching the data from IMDb');
        }

        $dom = new \DOMDocument();
        libxml_use_internal_errors(true); // Suppress HTML parsing warnings
        $dom->loadHTML($r);
        libxml_clear_errors(); // Clear any errors that were generated

        $xpath = new DOMXPath($dom);

        // Fetch the weekend title
        $weekendTitleNode = $xpath->query('//*[@id="__next"]/main/div/div[2]/section/div/div[1]/div/div[2]/div');
        $weekendTitle = $weekendTitleNode->item(0) ? trim($weekendTitleNode->item(0)->nodeValue) : 'No Weekend Title Found';

        // Select the main <ul> element containing the Top Box Office list
        $movieNodes = $xpath->query('//*[@id="__next"]/main/div/div[2]/section/div/div[2]/div/ul/li');

        // Initialize an array to store movie data
        $movies = [];

        foreach ($movieNodes as $movieNode) {
            // Extract title
            $titleNode = $xpath->query('.//h3', $movieNode);
            $title = $titleNode->item(0) ? trim($titleNode->item(0)->nodeValue) : 'Unknown Title';

            // Extract cover image URL
            $coverImageNode = $xpath->query('.//img', $movieNode);
            $coverImage = $coverImageNode->item(0) ? $coverImageNode->item(0)->getAttribute('src') : '';

            // Extract IMDb rating
            $ratingNode = $xpath->query('.//span[contains(@class, "imdb-rating")]', $movieNode);
            $rating = $ratingNode->item(0) ? trim($ratingNode->item(0)->nodeValue) : 'N/A';

            // Extract weekend gross
            $weekendGrossNode = $xpath->query('.//div[2]/div/div/ul/li[1]', $movieNode);
            $weekendGross = $weekendGrossNode->item(0) ? trim($weekendGrossNode->item(0)->nodeValue) : 'N/A';

            // Extract total gross
            $totalGrossNode = $xpath->query('.//div[2]/div/div/ul/li[2]', $movieNode);
            $totalGross = $totalGrossNode->item(0) ? trim($totalGrossNode->item(0)->nodeValue) : 'N/A';

            // Extract weeks released
            $weeksReleasedNode = $xpath->query('.//div[2]/div/div/ul/li[3]', $movieNode);
            $weeksReleased = $weeksReleasedNode->item(0) ? trim($weeksReleasedNode->item(0)->nodeValue) : 'N/A';

            // Add movie details to the list
            $movies[] = [
                'title' => $title,
                'coverImage' => $coverImage,
                'rating' => $rating,
                'weekendGross' => $weekendGross,
                'totalGross' => $totalGross,
                'weeksReleased' => $weeksReleased,
            ];
        }

        $json_data = [
            'status' => 'success',
            'weekendTitle' => $weekendTitle,
            'topBoxOffice' => $movies,
        ];

        $response->json($json_data);
    }
}
