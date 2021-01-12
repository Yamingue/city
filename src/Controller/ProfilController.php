<?php

namespace App\Controller;

use App\Entity\City;
use App\Form\CityType;
use App\Repository\CityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @Route("/profil")
*/
class ProfilController extends AbstractController
{
    /**
     * @Route("/", name="profil")
     */
    public function index(Request $req): Response
    {
        
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }

     /**
     * @Route("/city/{id}/view", name="view_city")
     */
    public function view_city(City $c): Response
    {
        
        return $this->render('profil/view_city.html.twig', [
            'city' => $c ,
        ]);
    }


    /**
     * @Route("/city/add/", name="add_city")
     */
    public function add_city(Request $req): Response
    {
        $city = new City();
        $city->setUser($this->getUser());
        $form = $this->createForm(CityType::class,$city);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $file = $form->get('poster')->getData();
            $name = $file->getClientOriginalName();
            $file->move('images',$name);
            $city->setPoster($name);
            $em->persist($city);
            $em->flush();
            $this->addFlash('succes','Cité créé avec succes !!!!');
            return $this->redirectToRoute('add_city');
        }
        return $this->render('profil/add_city.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
