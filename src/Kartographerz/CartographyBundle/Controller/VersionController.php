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

class VersionController extends Controller {

    public function linkListAction($versionCartography) {
        $conn = $this->get('database_connection');
        $list = $conn->fetchAll('SELECT *, '
                . '(select name from element where id= element_1_id) as element_1_label, '
                . '(select name from element where id= element_2_id) as element_2_label '
                . 'FROM Link '
                . 'WHERE version_id='.$versionCartography);
        return new Response(json_encode(array('data' => $list)));
    }

}
