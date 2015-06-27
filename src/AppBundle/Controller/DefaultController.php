<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    /**
     * @Route("/", name="default")
     */
    public function indexAction() {
        return $this->redirect($this->generateUrl('homepage'));
    }

    /**
     * @Route("/{_locale}/", name="homepage")
     */
    public function indexLocalAction() {
        $french = $this->generateUrl('homepage', array("_locale" => 'fr'));
        $english = $this->generateUrl('homepage', array("_locale" => 'en'));
        return $this->render('default/index.html.twig', array("french_flag" => $french, "english_flag" => $english));
    }

}
