<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author wbouss
 */

namespace Kartographerz\CartographyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Kartographerz\CartographyBundle\Entity\Element;
use Kartographerz\CartographyBundle\Form\ElementType;
use Kartographerz\CartographyBundle\Entity\TypeElement;
use Kartographerz\CartographyBundle\Form\TypeElementType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;

class ElementController extends Controller {

    //put your code here


    public function listAction(Request $request) {
        $conn = $this->get('database_connection');
        $list = $conn->fetchAll('SELECT id, name, typeElement_id, (select label from type_element where id= typeElement_id) as typeelementlabel '
                . 'FROM Element');
        return new Response(json_encode(array('data' => $list)));
    }

    public function versionListAction(Request $request) {
        $conn = $this->get('database_connection');
        $list = $conn->fetchAll('SELECT id, version_id, element_id'
              . ',(select typeElement_id from element where id=element_id) as typeElement_id'
              . ',(select image_id from type_element where id=typeElement_id) as typeElementImageId'
              . ',(select path from image where id=typeElementImageId) as typeElementImagePath FROM version_element');
        return new Response(json_encode(array('data' => $list)));
    }

   
    /**
     * @Security("has_role('ROLE_MODELISATEUR')")
     */
    public function addAction(Request $request) {

        $cartographyId = $request->get("id");
        $element = new Element();
        $repositoyElementType = $this->getdoctrine()->getRepository("KartographerzCartographyBundle:TypeElement");
        $elementTypes = $repositoyElementType->findAll();
        $r = array();
        foreach ($elementTypes as $v) {
            $r[$v->getId()] = $v->getLabel();
        }
        $form = $this->get('form.factory')->create(new ElementType($r), $element);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $element->setTypeElement($repositoyElementType->find($element->getTypeElement()));
            $em->persist($element);
            $em->flush();
            return $this->render('KartographerzCartographyBundle:Element:add.html.twig', array("form" => $form->createView(), "element" => $element));
        }
        return $this->render('KartographerzCartographyBundle:Element:add.html.twig', array("form" => $form->createView()));
    }

    /**
     * @Security("has_role('ROLE_MODELISATEUR')")
     */
    public function addElementTypeAction(Request $request) {

        $elementType = new TypeElement();

        $form = $this->get('form.factory')->create(new TypeElementType(), $elementType);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $elementType->getImage()->upload();
            $em->persist($elementType);
            $em->flush();
            return $this->render('KartographerzCartographyBundle:Element:addElementType.html.twig', array("typeElement" => $elementType, "form" => $form->createView()));
        }
        return $this->render('KartographerzCartographyBundle:Element:addElementType.html.twig', array("form" => $form->createView()));
    }

}
