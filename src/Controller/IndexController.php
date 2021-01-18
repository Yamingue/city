<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\Chambre;
use App\Entity\Reservation;
use App\Entity\TypeChabre;
use App\Form\ReservationType;
use App\Repository\ChambreRepository;
use App\Repository\TypeChabreRepository;
use App\Service\NotificationService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

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
    public function view_house(Chambre $c,Request $req,NotificationService $notifi ): Response
    {
        $res = new Reservation();
        $res->setChambre($c);
        $user =$this->getUser();
        if ($user!=null) {
            # code...
            $res->setEmail($user->getEmail());
            $res->setTel($user->getTel());
        }
        $form = $this->createForm(ReservationType::class,$res);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($res);
            $em->flush();
            $notifi->sendReservationNotification($res);
        }
       
        return $this->render('index/view_house.html.twig', [
            'chambre'=>$c,
            'cat'=> $this->catRepo->findAll(),
            'form'=> $form->createView()
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
