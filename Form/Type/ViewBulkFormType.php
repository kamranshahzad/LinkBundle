<?php

namespace Kamran\LinkBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormError;

class ViewBulkFormType extends AbstractType
{

    private $list = array();

    public function __construct($listItems){
        $this->list = $listItems;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('list', 'choice' , array(
            'choices'   => $this->list,
            'label' => 'Bulk Links List',
            'required'  => false,
            'empty_value' => 'Choose a Link List',
            'attr'=>array(
                'class'=> 'form-control',
                'style' => 'width:300px;'
             )
        ));


        /*
        Checkbox , Radiobutton lists
        $builder->add('type','choice',array('choices' => self::getJobTypes(),'required' => false, 'expanded' => true,'multiple'  => true,));
        */


        /*
         * this working fine , but the field will show in start ... just set the values
        $listModifierEvent = function (FormEvent $event) {
            $User = $event->getData();
            $form = $event->getForm()->getParent();
            $form->add('title', 'text', array('required' => false));
        };

        $builder->get('list')
            ->addEventListener(FormEvents::POST_SET_DATA, $listModifierEvent, 900)
            ->addEventListener(FormEvents::POST_SUBMIT, $listModifierEvent, 900);
        */







        /*$refreshField = function(FormInterface $form){
            $form->add('title', 'text', array('required' => false));
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($refreshField) {
                $form = $event->getForm();
                $data = $event->getData();
            }
        );

        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) use ($refreshField) {
                $form = $event->getForm();
                $data = $event->getData();

                if (isset($data['list']) && !empty($data['list']))
                    $refreshField($form);

               if(array_key_exists('country', $data)) {
                    $refreshStates($form, $data['country']);
                }
            }
        );*/


    }

    public function getName()
    {
        return 'view_bulklinks_form';
    }


    static public function getJobTypes()
    {
        return array(
            'full-time' => 'Full time',
            'part-time' => 'Part time',
            'freelance' => 'Freelance',
        );
    }

}