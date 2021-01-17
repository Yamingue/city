<?php

namespace App\Controller;

use App\Repository\ChatRepository;
use App\Repository\TypeChabreRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MessageController extends AbstractController
{
    private $catRepo;

    public function __construct( TypeChabreRepository $tr )
    {
        $this->catRepo=$tr;
    }
    /**
     * @Route("/message", name="message")
     */
    public function index(ChatRepository $ch_repo): Response
    {
        $message =  $ch_repo->findBy(['form'=>$this->getUser()]) ;
        return $this->render('message/index.html.twig', [
            'cat'=> $this->catRepo->findAll(),
        ]);
    }
}
