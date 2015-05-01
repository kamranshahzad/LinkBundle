<?php

namespace Kamran\LinkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


use Kamran\LinkBundle\Form\Type\ProjectLinksType;
use Kamran\LinkBundle\Entity\ProjectLinks;

/**
 * Project Links controller.
 * @Route("/projectlinks")
 */

class ProjectLinksController extends Controller
{


    /**
     * @Route("/", name="links_projectlinks")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine();
        return array();
    }


    /**
     * @Route("/add", name="links_project_add")
     * @Template()
     */
    public function addAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $entity = new ProjectLinks();
        $form = $this->createForm(new ProjectLinksType($em) ,$entity);

        if ($request->getMethod() === 'POST'){
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
                echo "Data Saved";
            }

        }
        return array(
            'form'   => $form->createView()
        );
    }

    

}//@

