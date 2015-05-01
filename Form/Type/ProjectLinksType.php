<?php

namespace Kamran\LinkBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;




class ProjectLinksType extends AbstractType
{

    private $em;

    public function __construct($_em){
        $this->em = $_em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('url','text', array(
            'attr' => array(
                'class' => 'form-control',
                'placeholder'=>'Url Text',
                'required' => false,
            ),
        ));

        $builder->add('description','textarea', array(
            'attr' => array(
                'class' => 'form-control',
                'placeholder'=>'Link Description',
                'required' => false,
            ),
        ));

       $builder->add('technology', 'entity', array(
            'class' => 'KamranTechnologyBundle:TechnologyTools',
            'empty_value' => 'Choose Technology Tool',
            'multiple' => false,
            'mapped' => false,
            'attr' => array(
                'class' => 'form-control',
            ),
        ));

        $builder->add('project_type', 'entity', array(
            'class' => 'KamranProjectsBundle:ProjectTypes',
            'empty_value' => 'Choose Project Type',
            'multiple' => false,
            'mapped' => false,
            'attr' => array(
                'class' => 'form-control',
            ),
        ));




        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $data = $event->getData();
            $form = $event->getForm();

            /*$tech_id = 1;
            if( $data->getTechnology() && $data->getTechnology()->getId()){
                $tech_id = $data->getTechnology()->getId();
            }

            $form->add('tags', 'entity', array(
                'class' => 'KamranTagsBundle:TechnologyTags',
                'query_builder' => function(EntityRepository $er) use ($tech_id) {
                        return $er->createQueryBuilder('tt')
                            ->where('tt.tool = :id')
                            ->setParameter('id', $tech_id);
                    },
                'multiple' => true,
                'expanded' => true,
            ));*/


        });



    }


    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kamran\LinkBundle\Entity\ProjectLinks',
        ));
    }

    public function getName()
    {
        return 'articlelinks_form';
    }

}