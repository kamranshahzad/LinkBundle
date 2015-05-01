<?php

namespace Kamran\LinkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

use Kamran\LinkBundle\Entity\GeneralLinks;
use Kamran\LinkBundle\Form\Type\GeneralLinksType;


/**
 * Dashboard controller.
 * @Route("/generallinks")
 */

class GeneralLinksController extends Controller
{


    /**
     * @Route("/", name="links_generallinks")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine();



        /*
    	$repository = $this->getDoctrine()->getRepository('KamranProjectsBundle:Projects');
    	$projects = $repository->findAllQuery();

    	return array('projects'=>$projects);
        */
        return array();
    }


    /**
     * @Route("/add", name="links_general_add")
     * @Template()
     */
    public function addAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $entity = new GeneralLinks();
        $form = $this->createForm(new GeneralLinksType($em) ,$entity);

        if ($request->getMethod() === 'POST'){
            $form->handleRequest($request);

            /*echo '<pre>';
            print_r($entity->getTags());
            echo '</pre>';*/

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


    /**
     * @Route("/edit/{id}", name="links_general_edit")
     * @Template()
     */
    public function editAction(Request $request , $id){

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('KamranLinkBundle:GeneralLinks')->find($id);

        $form = $this->createForm(new GeneralLinksType($em), $entity);

        if ($request->getMethod() === 'POST'){
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
                echo "Data Updated successfully";
            }

        }

        return array(
            'id' => $id,
            'form'   => $form->createView()
        );

    }


    

}//@

