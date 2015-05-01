<?php

namespace Kamran\LinkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\HttpFoundation\JsonResponse;

use Kamran\LinkBundle\Entity\GeneralLinks;
use Kamran\LinkBundle\Form\Type\LinkFilterType;

/**
 * Links Index controller.
 */

class IndexController extends Controller
{






    /**
     * @Route("/", name="links_index")
     * @Template("KamranLinkBundle:Layout:_index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine();

        $entity = new GeneralLinks();
        $form = $this->createForm(new LinkFilterType($em) ,$entity);




        /*
    	$repository = $this->getDoctrine()->getRepository('KamranProjectsBundle:Projects');
    	$projects = $repository->findAllQuery();

    	return array('projects'=>$projects);
        */
        return array( 'form'=>$form->createView());
    }


    /**
     * @Route("/filterlinks", name="links_filterlinks" ,options={"expose"=true})
     * @Template()
     */
    public function filterlinksAction(Request $request ){
        $data = $request->query->get('tagItems');
        $em = $this->getDoctrine();
        $array = $em->getRepository('KamranLinkBundle:GeneralLinks')->findGeneralLinks($data);

        return $this->jsonResponse($array);
    }



    protected function jsonResponse($object){
        return new JsonResponse($this->getSerializer()->normalize($object, 'json'));
    }

    protected function getSerializer()
    {
        return new Serializer(
            array(new GetSetMethodNormalizer()),
            array(new JsonEncoder())
        );
    }



}//@

