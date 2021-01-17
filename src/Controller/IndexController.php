<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\Chambre;
use App\Entity\TypeChabre;
use App\Repository\ChambreRepository;
use App\Repository\TypeChabreRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    private $catRepo;

    public function __construct( TypeChabreRepository $tr )
    {
        $this->catRepo=$tr;
    }
    /**
     * @Route("/", name="index")
     */
    public function index(ChambreRepository $cityRepo): Response
    {
        $citys = $cityRepo->findLibre();
        
        

        return $this->render('index/index.html.twig', [
            'chambre'=>$citys,
            'cat'=> $this->catRepo->findAll(),
        ]);
    }

    /**
     * @Route("/house/{id}", name="view_house")
     */
    public function view_house(Chambre $c): Response
    {
        
       
        return $this->render('index/view_house.html.twig', [
            'chambre'=>$c,
            'cat'=> $this->catRepo->findAll(),
        ]);
    }

      /**
     * @Route("/city/{id}", name="city")
     */
    public function city(City $c): Response
    {
        //dd($c);
        return $this->render('index/city.html.twig', [
            'city'=>$c,
            'cat'=> $this->catRepo->findAll(),
        ]);
    }

      /**
     * @Route("/cat-{id}", name="cat")
     */
    public function cat(TypeChabre $cat): Response
    {
        //dd($c);
        return $this->render('index/index.html.twig', [
            'chambre'=>$cat->getChambres(),
            'cat'=> $this->catRepo->findAll(),
        ]);
    }
}
