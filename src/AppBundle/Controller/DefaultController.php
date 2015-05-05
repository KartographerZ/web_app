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

        return $this->render('default/index.html.twig');
    }

}
