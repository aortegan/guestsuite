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

        // Get json data
        $fileData = file_get_contents('./../src/data/mockdata.json');
        $rates = json_decode($fileData, true);

        /*
         * Objects to return 
         * 
         * array of average rates and site ['Tripadvisor' => '7.1', 'Google' => '6.9']
         * array of sites containing days and rates
         * 
         *
         * */

        $allSitesData = [];

        $chart = [];
        $dates = [];
        $average = [];

        foreach($rates as $date)
        {   

            foreach($date['rates'] as $site => $rate)
            {   
                if( !array_key_exists($site,$average) )
                {   
                    $average[$site] = [$rate]; 
                }else{
                    array_push($average[$site],$rate);
                }

                if( !array_key_exists($site,$allSitesData) )
                {
                    $allSitesData[$site] = [];
                    $allSitesData[$site]['name'] = $site;
                    $allSitesData[$site]['rates'] = [];
                    $allSitesData[$site]['average'] = 0.0;
                }

                array_push($allSitesData[$site]['rates'], $rate); 
            }
            array_push($dates,$date['date']);
        }

        //var_dump($allSitesData);

        foreach($average as $site => $rates)
        {
            $average[$site] = round($helpers->average($rates),2);
            //var_dump($rates);
        }

        foreach($allSitesData as $site)
        {
            $name = $site['name'];
            $allSitesData[$name]['average'] = round($helpers->average($site['rates']),2);
            //$allSitesData[$site['name']]['average'] = round($helpers->average($site['rates']),2);
            //var_dump($site);
        }
        //var_dump($allSitesData["Guest Suite"]);

        //$average = $helpers->average($values);

        return $this->render('Home/view.html.twig', [
            'average' => $average,
            'sites' => $allSitesData,
            'dates' => $dates
        ]);
    }
}