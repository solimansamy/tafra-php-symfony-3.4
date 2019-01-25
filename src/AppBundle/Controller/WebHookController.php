<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/api/webhook")
 */
class WebHookController extends Controller
{
    /**
     * @Route("/messenger")
     * @Method({"POST"})
     */
    public function MessengerAction()
    {
        return $this->render('AppBundle:WebHook:messenger.html.php', array(
            // ...
        ));
    }

    /**
     * @Route("/whatsapp")
     * @Method({"POST"})
     */
    public function WhatsappAction()
    {
        return $this->render('AppBundle:WebHook:whatsapp.html.php', array(
            // ...
        ));
    }

}
