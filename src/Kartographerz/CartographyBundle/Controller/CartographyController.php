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
        $webPath = $this->get('request')->getBasePath();
        $cartography = new Cartography();
        $form = $this->get('form.factory')->create(new CartographyType(), $cartography);
        $usr = $this->get('security.context')->getToken()->getUser();
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
            $Firstversion->setCurrentId(1);
            $Firstversion->setCartography($cartography);
            $em->persist($Firstversion);
            $em->flush();
            $lastVersion = $this->lastVersionCart($cartography->getId());

            return $this->redirect($this->generateUrl('kartographerz_cartography_view', array("id" => $cartography->getId())));
        }
        // Si on n'est pas en POST, alors on affiche le formulaire
        return $this->render('KartographerzCartographyBundle:Cartography:add.html.twig', array("form" => $form->createView()));
    }

    function updateAction(Request $request) {
        $New_elements = $request->get("elements");
        $idCart = $request->get("cart");
        $New_links = $request->get("links");

        $em = $this->getDoctrine()->getManager();
        $repositoyCartography = $em->getRepository("KartographerzCartographyBundle:Cartography");
        $carto = $repositoyCartography->find($idCart);
        $repositoyElements = $em->getRepository("KartographerzCartographyBundle:Element");

        // on ajoute les nouveau maintenant

        $newVersionCart = new Version();
        $newVersionCart->setCartography($carto);
        $newVersionCart->setDate(new \DateTime);
        $newVersionCart->setCurrentId(1);
        $em->persist($newVersionCart);
        $this->currentVersionCart($idCart, $newVersionCart->getId());
        if (sizeof($New_elements) != 0) {
            foreach ($New_elements as $ne) {
                $element = $repositoyElements->find($ne);
                $ve = new VersionElement();
                $ve->setElement($element);
                $ve->setVersion($newVersionCart);
                $em->persist($ve);
            }
        }
        $inter = 0;
        if (sizeof($New_links) != 0) {
            foreach ($New_links as $nl) {
                $link = new Link();
                $e1 = $repositoyElements->find($nl[0]);
                $e2 = $repositoyElements->find($nl[1]);
                $link->setElement1($e1);
                $link->setElement2($e2);

                $link->setVersionCartography($newVersionCart);
                $em->persist($link);
            }
        }
        $em->flush();

        return new Response("ok2");
    }

    function updateElementsAction(Request $request) {
        $New_elements = $request->get("elements");
        $idCart = $request->get("cart");

        $em = $this->getDoctrine()->getManager();
        $repositoyCartography = $em->getRepository("KartographerzCartographyBundle:Cartography");
        $carto = $repositoyCartography->find($idCart);
        $repositoyElements = $em->getRepository("KartographerzCartographyBundle:Element");
        $repositoryLink = $em->getRepository("KartographerzCartographyBundle:Link");



        // on ajoute les nouveau maintenant

        $newVersionCart = new Version();
        $newVersionCart->setCartography($carto);

        $newVersionCart->setCurrentId(1);
        $this->currentVersionCart($idCart, $newVersionCart->getId());
        $newVersionCart->setDate(new \DateTime);
        $em->persist($newVersionCart);
        $this->currentVersionCart($idCart, $newVersionCart->getId());
        if (sizeof($New_elements) != 0) {
            foreach ($New_elements as $ne) {
                $element = $repositoyElements->find($ne);
                $ve = new VersionElement();
                $ve->setElement($element);
                $ve->setVersion($newVersionCart);
                $em->persist($ve);
            }

//            $repositoryVersion = $em->getRepository("KartographerzCartographyBundle:Version");
//            $all = $repositoryVersion->findBy(array("cartography" => $idCart));
//            $lastVersion = ($all[0]->getId());
        }
        $lastVersionCart = $this->lastVersionCart($idCart);

        $lastlinks = $repositoryLink->findBy(array("versionCartography" => $lastVersionCart));
        $newlinks = array();
        $pass = 0;
        foreach ($lastlinks as $l) {
            foreach ($New_elements as $ne) {
                if ($ne == $l->getElement1()->getId())
                    $pass++;
                if ($ne == $l->getElement2()->getId())
                    $pass++;
            }
            if ($pass == 2)
                $newlinks[] = $l;
            $pass = 0;
        }

        foreach ($newlinks as $l) {
            $link = new Link();
            $link->setElement1($l->getElement1());
            $link->setElement2($l->getElement2());
            $link->setVersionCartography($newVersionCart);
            $em->persist($link);
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
        $repositoyVersion = $em->getRepository("KartographerzCartographyBundle:Version");
        $repositoyVersionElement = $em->getRepository("KartographerzCartographyBundle:VersionElement");
        $repositoyLink = $em->getRepository("KartographerzCartographyBundle:Link");
        $carto = $repositoyCartography->find($id);
        
        $versionDelete = $repositoyVersion->findBy(array("cartography" => $carto));
        $versionElementAll = $repositoyVersionElement->findAll();
        $elementDelete = array();
        foreach($versionElementAll as $ve )
        {
            if(in_array($ve->getVersion(),$versionDelete))
                    $elementDelete[] = $ve;
        }
        
        $LinkAll = $repositoyLink->findAll();
        $linksDelete = array();
        foreach($LinkAll as $l )
        {
            if(in_array($l->getVersion(),$versionDelete))
                    $linksDelete[] = $l;
        }
        
        foreach ($linksDelete as $todel)
        {
            $em->remove($todel);
        }
        foreach ($elementDelete as $todel)
        {
            $em->remove($todel);
        }
        foreach ($versionDelete as $todel)
        {
            $em->remove($todel);
        }
        $em->remove($carto);
        $em->flush();
        return new Response("ok");
    }

    /**
     * @Security("has_role('ROLE_MODELISATEUR')")
     */
    public function updateVersionIdAction(Request $request) {

        $currentCarographyVersion = $request->request->get('currentCarographyVersion');
        $currentCarographyId = $request->request->get('currentCarographyId');
        //currentVersionCart("5");
        $this->currentVersionCart($currentCarographyId, $currentCarographyVersion);

        //   return new Response($x);
        //  return $currentCarographyVersion;

        return $this->redirect($request->headers->get('referer'));
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
        // on récupère le chemin
        $webPath = $this->get('request')->getBasePath();

        //Vérifier que la carto existe en base
        $CartoExists = true;
        // on récupère la derniere version
        $em = $this->getDoctrine()->getManager();
        $repositoyVersion = $em->getRepository("KartographerzCartographyBundle:Version");
        $all = $repositoyVersion->findBy(array("cartography" => $id));
        if ($all == NULL)
            $CartoExists = false;
        else
            $lastVersion = $this->lastVersionCart($id);
        if (!$CartoExists) {
            // On déclenche une exception NotFoundHttpException, cela va afficher
            // une page d'erreur 404
            throw new NotFoundHttpException('Cartographie "' . $id . '" inexistante.');
        }

        return $this->render('KartographerzCartographyBundle:Cartography:view.html.twig', array("lastVersion" => $lastVersion, "id" => $id, "webPath" => $webPath));
    }

    function lastVersionCart($cartId) {
        $em = $this->getDoctrine()->getManager();
        $repositoryVersion = $em->getRepository("KartographerzCartographyBundle:Version");
        $all = $repositoryVersion->findBy(array("cartography" => $cartId));

        foreach ($all as $line) {
            if ($line->getCurrentId() == 1) {
                $lastVersion = $line->getId();
            }
        }

        return $lastVersion;
    }
    public function listDataTableAction(Request $request) {
        $conn = $this->get('database_connection');
        $list = $conn->fetchAll('SELECT *,author_id,(select name from user where  id = author_id ) as nameAuthor FROM Cartography');
        return new Response(json_encode( array("data" => $list)));
    }
    public function currentVersionCart($cartId, $currentCartId) {
        // On insère la version actuelle de cartographie à afficher (1 = true et 0 = false : donc une seule version à 1 et toutes les autres à 0)
        $em = $this->getDoctrine()->getManager();
        $repositoryVersion = $em->getRepository("KartographerzCartographyBundle:Version");
        $all = $repositoryVersion->findBy(array("cartography" => $cartId));

        foreach ($all as $line) {
            // $advert est une instance de Advert
            if ($line->getId() != $currentCartId) {
                $line->setCurrentId(0);
            } else {
                $line->setCurrentId(1);
            }
            $em->persist($line);
            $em->flush();
        }
    }

}
