<?php

namespace App\Controller;

use App\Form\CityType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        

        return $this->render('index/index.html.twig', [
            'form' => null,
        ]);
    }
}