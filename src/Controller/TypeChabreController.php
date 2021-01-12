<?php

namespace App\Controller;

use App\Entity\TypeChabre;
use App\Form\TypeChabreType;
use App\Repository\TypeChabreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type/chabre")
 */
class TypeChabreController extends AbstractController
{
    /**
     * @Route("/", name="type_chabre_index", methods={"GET"})
     */
    public function index(TypeChabreRepository $typeChabreRepository): Response
    {
        return $this->render('type_chabre/index.html.twig', [
            'type_chabres' => $typeChabreRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_chabre_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeChabre = new TypeChabre();
        $form = $this->createForm(TypeChabreType::class, $typeChabre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeChabre);
            $entityManager->flush();

            return $this->redirectToRoute('type_chabre_index');
        }

        return $this->render('type_chabre/new.html.twig', [
            'type_chabre' => $typeChabre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_chabre_show", methods={"GET"})
     */
    public function show(TypeChabre $typeChabre): Response
    {
        return $this->render('type_chabre/show.html.twig', [
            'type_chabre' => $typeChabre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_chabre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeChabre $typeChabre): Response
    {
        $form = $this->createForm(TypeChabreType::class, $typeChabre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_chabre_index');
        }

        return $this->render('type_chabre/edit.html.twig', [
            'type_chabre' => $typeChabre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_chabre_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeChabre $typeChabre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeChabre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeChabre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_chabre_index');
    }
}
