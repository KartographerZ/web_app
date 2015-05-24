<?php

namespace Kartographerz\CartographyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Kartographerz\CartographyBundle\Entity\Cartography;
use Kartographerz\CartographyBundle\Form\CartographyType;
use Symfony\Component\HttpFoundation\Response;

class CartographyController extends Controller {

    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction() {
        return $this->render('KartographerzCartographyBundle:Cartography:index.html.twig');
    }

    public function listAction(Request $request) {
        $conn = $this->get('database_connection');
        $list = $conn->fetchAll('SELECT * FROM Cartography');
        return new Response(json_encode($list));
    }
    
    public function versionListAction(Request $request) {
        $conn = $this->get('database_connection');
        $list = $conn->fetchAll('SELECT * FROM version');
        return new Response(json_encode($list));
    }

    /**
     * @Security("has_role('ROLE_MODELISATEUR')")
     */
    public function addAction(Request $request) {

        $cartography = new Cartography();
        $form = $this->get('form.factory')->create(new CartographyType(), $cartography);
        $usr= $this->get('security.context')->getToken()->getUser();
        $authorId = $usr->getId();
        $author = $this->getDoctrine()
        ->getRepository('KartographerzUserBundle:User')
        ->find($authorId);
        $cartography->setAuthor($author);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cartography);
            $em->flush();
            return $this->render('KartographerzCartographyBundle:Cartography:view.html.twig', array("id" => $cartography->getId()));
        }
        // Si on n'est pas en POST, alors on affiche le formulaire
        return $this->render('KartographerzCartographyBundle:Cartography:add.html.twig', array("form" => $form->createView()));
    }
    function updateAction( Request $request)
    {
        $elements = $request->get("elements");
        $links = $request->get("links");
        $idCart = $request->get("cart");
        
        $repositoyCartography = $em->getRepository("KartographerzCartographyBundle:Cartography");
        $carto = $repositoyCartography->find($idCart);
        
        $repositoyElement = $em->getRepository("KartographerzCartographyBundle:Element");

        
        
    }
    /**
     * @Security("has_role('ROLE_MODELISATEUR')")
     */
    public function deleteAction(Request $request) {
        $id = $request->get("id");
        $em = $this->getDoctrine()->getManager();
        $repositoyCartography = $em->getRepository("KartographerzCartographyBundle:Cartography");
        $carto = $repositoyCartography->find($id);
        $em->remove($carto);
        return $this->render('KartographerzCartographyBundle:Cartography:delete.html.twig', array("name" => $carto->getName()));
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

}
