<?php
namespace App\Service;

use App\Entity\Chambre;
use App\Entity\User;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Bundle\TwigBundle\DependencyInjection\TwigExtension;
use Twig\Environment;

class NotificationService {
    private $twig;
    public function __construct( Environment $twig )
    {
        $this->twig=$twig;
    }

    public function sendNotification(Chambre $c,User $u){
        $body = $this->twig->render('notif/reservation.html.twig',[
            'user'=>$u,
            'chambre'=>$c,
        ]);
    }
}
?>