<?php

// src/Controller/HomeController.php 
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    public function view()
    {
        $hello = 'Hello world';

        return $this->render('Home/view.html.twig', [
            'hello' => $hello,
        ]);
    }
}