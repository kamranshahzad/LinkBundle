<?php

namespace Kamran\LinkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;


use Kamran\LinkBundle\Entity\Document;
use Kamran\LinkBundle\Entity\BulkLinks;
use Kamran\LinkBundle\Form\Type\ViewBulkFormType;
use Kamran\LinkBundle\Entity\GeneralLinks;
use Kamran\LinkBundle\Form\Type\GeneralLinksType;


/**
 * Bulk links controller.
*/

class BulkLinksController extends Controller
{


    /**
     * @Route("/bulklinks", name="links_bulklinks")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine();
        return array();
    }


    /**
     * read text files and saved as bulks.
     *
     * @Route("/bulklinks/upload", name="links_bulklinks_upload")
     * @Template()
     */
    public function uploadbulkAction(Request $request){

        $document = new Document();
        $form = $this->createFormBuilder($document)
            ->add('name','text',array('label'=>false, 'attr'=>array('placeholder'=>'Bulk List Name','class'=>'form-control')))
            ->add('file','file', array('attr'=>array('placeholder'=>'Bulk List Name','class'=>'form-control')))
            ->getForm()
        ;

        $countUrls = 0;
        if ($this->getRequest()->getMethod() === 'POST'){
            $form->bind($this->getRequest());
            if ($form->isValid()){
                $document->upload();
                $listName = $document->getName();
                $em = $this->getDoctrine()->getManager();
                $targetFile = $this->container->getParameter('kernel.root_dir')."/../web/_uploads/_tmp/".$document->path;
                if(file_exists($targetFile)){
                    $file = fopen($targetFile , "r");
                    while(!feof($file)){
                        $line = fgets($file);
                        $url = trim($line);
                        if($url != ''){
                            if(filter_var($url, FILTER_VALIDATE_URL)){
                                $bulkEntity = new BulkLinks();
                                $bulkEntity->setLink($url);
                                $bulkEntity->setName($listName);
                                $em->persist($bulkEntity);
                                $em->flush();
                                unset($bulkEntity);
                                $countUrls++;
                            }
                        }
                    }
                    fclose($file);
                    unlink($targetFile);
                    return $this->redirect($this->generateUrl('links_bulklinks_succes' , array('urlcounts'=>$countUrls)));
                    //echo "Total links:".$countUrls;
                }
            }
        }

        return array('form' => $form->createView());
    }

    /**
     * Displays a form to create a new Links entity.
     *
     * @Route("/bulklinks/bulksucces/{urlcounts}", name="links_bulklinks_succes")
     * @Template()
     */
    public function bulksuccessAction($urlcounts){
        return array();
    }


    /**
     * View Bulk Links
     *
     * @Route("/bulklinks/viewlinks", name="links_bulklinks_view")
     * @Template()
     */
    public function viewbulkAction(){

        $em = $this->getDoctrine()->getManager();
        $listItems = $em->getRepository('KamranLinkBundle:BulkLinks')->getItemList();


        $form = $this->createForm(new ViewBulkFormType($listItems));

        return array(
            'form'   => $form->createView()
        );
    }


    /**
     * View Bulk Links by listname
     *
     * @Route("/bulklinks/viewlistlinks", name="links_bulklinks_viewbylist")
     * @Template()
     */
    public function viewlistlinksAction(Request $request){

        $listValue = $request->get('listname');
        $em = $this->getDoctrine()->getManager();
        $listItems = $em->getRepository('KamranLinkBundle:BulkLinks')->findLinkByListname($listValue);

        return array('name'=>$listValue , 'items'=> $listItems );
    }


    /**
     * View Bulk Links by listname
     *
     * @Route("/bulklinks/remove/{id}", name="links_bulklinks_remove" , options={"expose":true})
     * @Template()
     */
    public function removeAction(Request $request , $id){

        //$listValue = $request->get('listname');
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('KamranLinkBundle:BulkLinks')->find($id);
        $em->remove($entity);
        $em->flush();
        $response = new JsonResponse();
        $response->setData(array(
            'msg' => 'ok'
        ));
        return $response;
    }

    /**
     *
     * @Route("/bulklinks/add/{id}", name="links_bulklinks_add" )
     * @Template()
     */
    public function addAction(Request $request , $id){
        $em = $this->getDoctrine()->getManager();

        $entity = new GeneralLinks();
        $form = $this->createForm(new GeneralLinksType($em) ,$entity);

        $bulkEntity = $em->getRepository('KamranLinkBundle:BulkLinks')->find($id);

        $form->get('url')->setData($bulkEntity->getLink());

        if ($request->getMethod() === 'POST'){
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();

                $em->remove($bulkEntity);
                $em->flush();
                return $this->redirect($this->generateUrl('links_bulklinks_view'));
            }

        }

        return array(
            'id' => $id,
            'form'   => $form->createView()
        );
    }





    /**
     * @Route("/bulklinks/filter", name="links_bulklinks_filter")
     * @Template()
    */
    public function filterAction(Request $request)
    {
        $search = array();

        $form = $this->get('form.factory')->createNamedBuilder('abc', 'form', $search, array(
            'csrf_protection' => false,
        ))->setMethod('GET')
            ->add('q', 'text')
            ->add('search', 'submit')
            ->getForm();

       /* $form->handleRequest($request);
        if ($form->isValid()) {

            $all = $request->query->all();
            echo('<pre>');
            print_r($request->query->all());
            echo('</pre>');
        }*/

        return array('form'=>$form->createView());
    }



}//@

