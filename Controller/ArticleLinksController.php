<?php

namespace Kamran\LinkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections;

use Kamran\LinkBundle\Form\Type\ArticleLinksType;
use Kamran\LinkBundle\Entity\ArticleLinks;
use Kamran\TechnologyBundle\Entity\TechnologyTools;


/**
 * Links Index controller.
 * @Route("/articlelinks")
 */

class ArticleLinksController extends Controller
{


    /**
     * @Route("/", name="links_articlelinks")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine();
        return array();
    }


    /**
     * @Route("/add", name="links_article_add")
     * @Template()
     */
    public function addAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $entity = new ArticleLinks();
        $form = $this->createForm(new ArticleLinksType($em) ,$entity);

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
     * @Route("/edit/{id}", name="links_article_edit")
     * @Template()
     */
    public function editAction(Request $request , $id){

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('KamranLinkBundle:ArticleLinks')->find($id);

        $form = $this->createForm(new ArticleLinksType($em) ,$entity);

        if ($request->getMethod() === 'POST'){
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
                echo "Data Saved";
            }else{
                echo($form->getErrorsAsString());
            }
        }
        return array(
            'id'=>$id,
            'form'   => $form->createView()
        );

    }

    /**
     * @Route("/edittags/{tech_id}/{tool}", name="links_article_tags_edit", options={"expose"=true})
     * @Template()
     */
    public function edittagsAction(Request $request, $tech_id ,$tool)
    {
        $form = $this->get('form.factory')->createNamedBuilder('articlelinks_form' , 'form' )
            ->add('tags', 'entity', array(
                'class' => 'KamranTagsBundle:TechnologyTags',
                'query_builder' => function(EntityRepository $er) use ($tool) {
                        return $er->createQueryBuilder('tt')
                                    ->where('tt.tool = :id')
                                        ->setParameter('id', $tool);
                 },
                'multiple' => true,
                'expanded' => true,
            ))
            ->getForm();
        if($tech_id == $tool){
/*            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('KamranLinkBundle:ArticleLinks')->find($tech_id);
            $tags = new ArrayCollection();
            foreach($entity as $object){
                $tags->add($object);
            }
            $form->get('tags')->setData($tags);*/
        }
        return array('form'=>$form->createView());
    }


    /**
     * @Route("/list/{tool}", name="links_article_dynamic", options={"expose"=true})
     * @Template()
     */
    public function listAction(Request $request, $tool)
    {
        $defaultData = array();
        $form = $this->get('form.factory')->createNamedBuilder('articlelinks_form' , 'form', $defaultData)
            ->add('tags', 'entity', array(
                'class' => 'KamranTagsBundle:TechnologyTags',
                'query_builder' => function(EntityRepository $er) use ($tool) {
                        return $er->createQueryBuilder('tt')
                            ->where('tt.tool = :id')
                            ->setParameter('id', $tool);
                    },
                'multiple' => true,
                'expanded' => true,
            ))
            ->getForm();

        return array('form'=>$form->createView());
    }



   



}//@

