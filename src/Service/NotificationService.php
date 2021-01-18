<?php
namespace App\Service;

use App\Entity\Chambre;
use App\Entity\Reservation;
use App\Entity\User;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Bundle\TwigBundle\DependencyInjection\TwigExtension;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class NotificationService {
    private $twig;
    private $mailer;
    public function __construct( Environment $twig, MailerInterface $mailer )
    {
        $this->twig=$twig;
        $this->mailer=$mailer;
    }

    public function sendReservationNotification(Reservation $re){
        $mail1= $re->getEmail();
        $mail2= $re->getChambre()->getCity()->getUser()->getEmail();
        $body = $this->twig->render('notif/reservation.html',[
            'reservation'=>$re
        ]);
        $email= (new Email())
                ->from('king@yamking.go.yj.fr')
                ->to($mail2)
                ->subject('Reservation de chambre')
                ->addTo($mail1)
                ->html($body)
                ;
        $this->mailer->send($email);
    }
}
?>