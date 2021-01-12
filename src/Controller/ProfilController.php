<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\Photo;
use App\Form\CityType;
use App\Entity\Chambre;
use App\Form\PhotoType;
use App\Form\ChambreType;
use App\Repository\CityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
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
    public function view_city(City $c,Request $req): Response
    {
        $chambre = new Chambre();
        $chambre->setCity($c);
        $chambreForm = $this->createForm(ChambreType::class,$chambre);
        $chambreForm->handleRequest($req);
        if ($chambreForm->isSubmitted() && $chambreForm->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $file = $chambreForm->get('poster')->getData();
            $name = $file->getClientOriginalName();
            $file->move('images',$name);
            $chambre->setPoster($name);
            //dd($chambre);
            $em->persist($chambre);
            $em->flush();
            $this->addFlash('succes','Chabre ajouter !!');
            return $this->redirectToRoute('house_add_img',['id'=>$chambre->getId()]);
        }
        return $this->render('profil/view_city.html.twig', [

            'city' => $c ,
            'form'=> $chambreForm->createView(),
        ]);
    }

    /**
     * @Route("/house/{id}/imgs", name="house_add_img")
     */
    public function house_add_img(Chambre $c,Request $req): Response
    {
        $photo = new Photo();
        $photo->setChambre($c);
        $photoForm = $this->createForm(PhotoType::class,$photo);
        $photoForm->handleRequest($req);
        if ($photoForm->isSubmitted() && $photoForm->isValid()) {
            $file = $photoForm->get('path')->getData();
            $name = $file->getClientOriginalName();
            $file->move('images',$name);
            $photo->setPath($name);
            $c->addPhoto($photo);
            $em = $this->getDoctrine()->getManager();
            $em->persist($photo);
            $em->persist($c);
            $em->flush();
            $this->addFlash('succes','image ajouter avec succes ajouter en autre');
            return $this->redirect($req->headers->get('referer'));
        }
        return $this->render('profil/house_add_img.html.twig', [
            'chambre' => $c ,
            'form'=> $photoForm->createView(),
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
