<?php

namespace Kartographerz\CartographyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CartographyController extends Controller {

    public function indexAction() {
        return $this->render('KartographerzCartographyBundle:Cartography:index.html.twig');
    }

    public function addAction(Request $request) {

        // Si la requête est en POST, c'est que le visiteur a soumis le formulaire
        if ($request->isMethod('POST')) {
            // Ici, on s'occupera de la création et de la gestion du formulaire

            $id = rand(1, 100); // Exemple d'un id de carto

            /*
             * Si l'ajout s'est bien déroulé, on redirige vers la page de consultation
             * de cette cartographie
             */
            // Définition d'un flashbag pour stocker un message d'ajout
            $session = $request->getSession();
            // Le « flashBag » est ce qui contient les messages flash dans la session
            $session->getFlashBag()->add('info', 'Cartographie enregistrée');

            // Redirection vers la page de consultation de la cartographie
            return $this->redirect($this->generateUrl('kartographerz_cartography_view', array('id' => $id)));
        }

        // Si on n'est pas en POST, alors on affiche le formulaire
        return $this->render('KartographerzCartographyBundle:Cartography:add.html.twig');
    }

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

}
