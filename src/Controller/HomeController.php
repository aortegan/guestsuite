<?php

// src/Controller/HomeController.php 
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use App\Util\Helpers;

class HomeController extends AbstractController
{
    public function view()
    {   
        // Get helper functions
        $helpers = new Helpers();

        // Get json mock data from file
        $fileData = file_get_contents('./../src/data/mockdata.json');
        $data = json_decode($fileData, true);

        /*
         * Objects to return 
         * 
         * array of site's rates and average rate
         * array of sites containing days and rates
         *
         * */
        $rates = [];
        $dates = [];

        // Iterate each day
        foreach($data as $date)
        {   
            // Iterate each rate of the day
            foreach($date['rates'] as $site => $rate)
            {   
                // Initialize the array of the site if it doesn't exist already
                if( !array_key_exists($site,$rates) )
                {
                    $rates[$site] = [];
                    $rates[$site]['name'] = $site;
                    $rates[$site]['rates'] = [];
                    $rates[$site]['average'] = 0.0;
                    // For icons display purposes
                    $rates[$site]['stars'] = 0;
                    $rates[$site]['halfstar'] = false;
                }
                // Push rate into the site's rates array
                array_push($rates[$site]['rates'], $rate); 
            }
            // Push date into dates array
            array_push($dates,$date['date']);
        }

        // Set the average rate for each site
        foreach($rates as $site)
        {
            $name = $site['name'];
            // If average function returns a number, use it, default to 0
            $average = $helpers->average($site['rates']) ? $helpers->average($site['rates']) : 0;
            $rates[$name]['average'] = round($average,2);
            $rates[$name]['stars'] = round($average/2);
            $rates[$name]['halfstar'] = round($average)%2 == 1 ? true : false;
        }

        // Return view, passing site's rates array and dates array
        return $this->render('Home/view.html.twig', [
            'sites' => $rates,
            'dates' => $dates
        ]);
    }
}