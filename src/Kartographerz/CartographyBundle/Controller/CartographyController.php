<?php

namespace Kartographerz\CartographyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Kartographerz\CartographyBundle\Entity\Cartography;
use Kartographerz\CartographyBundle\Form\CartographyType;
use Symfony\Component\HttpFoundation\Response;
use Kartographerz\CartographyBundle\Entity\Version;
use Kartographerz\CartographyBundle\Entity\VersionElement;
use Kartographerz\CartographyBundle\Entity\Link;


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
            $Firstversion = new Version();
            $Firstversion->setDate(new \DateTime());
            $Firstversion->setCartography($cartography);
            $em->persist($Firstversion);
            $em->flush();
            $lastVersion = $this->lastVersionCart($cartography->getId());
            return $this->render('KartographerzCartographyBundle:Cartography:view.html.twig', array("lastVersion" => $lastVersion , "id" => $cartography->getId()));
        }
        // Si on n'est pas en POST, alors on affiche le formulaire
        return $this->render('KartographerzCartographyBundle:Cartography:add.html.twig', array("form" => $form->createView()));
    }
    function updateAction( Request $request)
    {
        $New_elements = $request->get("elements");
        $New_links = $request->get("links");
        $idCart = $request->get("cart");
        
        $em = $this->getDoctrine()->getManager();
        $repositoyCartography = $em->getRepository("KartographerzCartographyBundle:Cartography");
        $carto = $repositoyCartography->find($idCart);
        $repositoyElements = $em->getRepository("KartographerzCartographyBundle:Element");
        
        // on ajoute les nouveau maintenant
        
        $newVersionCart = new Version();
        $newVersionCart->setCartography($carto);
        $newVersionCart->setDate(new \DateTime );
        
        foreach ( $New_elements as $ne )
        {
            $element =   $repositoyElements->find($ne->getId());
            $ve =  new VersionElement();
            $ve->setElement($ne);
            $ve->setVersion($newVersionCart);
            $em->persist($ve);
        }
        
        foreach ( $New_links as $nl )
        {
            
            $link =  new Link();
            $link->setElement1($nl[0]);
            $link->setElement2($nl[1]);
            $link->setVersionCartography($newVersionCart);
            $em->persist($link);
        }
        
        
    }
    
    function updateElementsAction( Request  $request )
    {
        $New_elements = $request->get("elements");
        $idCart = $request->get("cart");
        
        $em = $this->getDoctrine()->getManager();
        $repositoyCartography = $em->getRepository("KartographerzCartographyBundle:Cartography");
        $carto = $repositoyCartography->find($idCart);
        $repositoyElements = $em->getRepository("KartographerzCartographyBundle:Element");
        
        // on ajoute les nouveau maintenant
        
        $newVersionCart = new Version();
        $newVersionCart->setCartography($carto);
        $newVersionCart->setDate(new \DateTime );
        $em->persist($newVersionCart);
        if( sizeof($New_elements) != 0)
        {
                foreach ( $New_elements as $ne )
            {
                $element =  $repositoyElements->find($ne);
                $ve =  new VersionElement();
                $ve->setElement($element);
                $ve->setVersion($newVersionCart);
                $em->persist($ve);
            }

//            $repositoryVersion = $em->getRepository("KartographerzCartographyBundle:Version");
//            $all = $repositoryVersion->findBy(array("cartography" => $idCart));
//            $lastVersion = ($all[0]->getId());
        }
        $em->flush();
        return new Response("ok");
         
        
        
        
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
        // on récupère la derniere version
        $em = $this->getDoctrine()->getManager();
        $repositoyVersion = $em->getRepository("KartographerzCartographyBundle:Version");
        $all = $repositoyVersion->findBy(array("cartography" => $id));
        if($all == NULL)
            $CartoExists = false;
        else
            $lastVersion = $this->lastVersionCart($id);
        if (!$CartoExists) {
            // On déclenche une exception NotFoundHttpException, cela va afficher
            // une page d'erreur 404
            throw new NotFoundHttpException('Cartographie "' . $id . '" inexistante.');
        }

        return $this->render('KartographerzCartographyBundle:Cartography:view.html.twig', array("lastVersion" => $lastVersion , "id" => $id));
    }
    
    function lastVersionCart($cartId)
    {
        $em = $this->getDoctrine()->getManager();
        $repositoryVersion = $em->getRepository("KartographerzCartographyBundle:Version");
        $all = $repositoryVersion->findBy(array("cartography" => $cartId)); 
        $lastVersion = ($all[sizeof($all)-1]->getId());
        return $lastVersion;
    }

}
