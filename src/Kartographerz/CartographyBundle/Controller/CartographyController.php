<?php

namespace Kartographerz\CartographyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Kartographerz\CartographyBundle\Entity\Cartography;
use Kartographerz\CartographyBundle\Form\CartographyType;

class CartographyController extends Controller {

    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction() {
        return $this->render('KartographerzCartographyBundle:Cartography:index.html.twig');
    }

    /**
     * @Security("has_role('ROLE_MODELISATEUR')")
     */
    public function addAction(Request $request) {

        $cartography = new Cartography();
        $form = $this->get('form.factory')->create(new CartographyType(), $cartography);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cartography);
            $em->flush();
            return $this->render('KartographerzCartographyBundle:Cartography:view.html.twig', array("id" => $cartography->getId()));
        }
        // Si on n'est pas en POST, alors on affiche le formulaire
        return $this->render('KartographerzCartographyBundle:Cartography:add.html.twig', array("form" => $form->createView()));
    }

    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function viewAction($id, Request $request) {
        /*
         * Ici, il va falloir vérifier si la cartographie existe.
         * Si elle n'existe pas, il faut créer et retourner une erreur 404 qui explicite l'erreur
         * (e.g. la cartographie n'existe pas)
         */

        //Vérifier que la carto existe en base
        $CartoExists = true;

        if (!$CartoExists) {
            // On déclenche une exception NotFoundHttpException, cela va afficher
            // une page d'erreur 404
            throw new NotFoundHttpException('Cartographie "' . $id . '" inexistante.');
        }

        return $this->render('KartographerzCartographyBundle:Cartography:view.html.twig', array("id" => $id));
    }

    public function translationAction($name) {
        return $this->render('KartographerzCartographyBundle::translation.html.twig', array(
                    'name' => $name
        ));
    }

}
