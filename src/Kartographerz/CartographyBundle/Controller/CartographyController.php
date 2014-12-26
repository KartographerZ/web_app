<?php

namespace Kartographerz\CartographyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CartographyController extends Controller {

    public function indexAction() {
        return $this->render('KartographerzCartographyBundle:Cartography:index.html.twig');
    }

    public function addAction() {
        return $this->render('KartographerzCartographyBundle:Cartography:add.html.twig');
    }

    public function viewAction($id) {
        return $this->render('KartographerzCartographyBundle:Cartography:view.html.twig', array("id" => $id));
    }

}
