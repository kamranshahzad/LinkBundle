<?php

namespace Kamran\LinkBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;
use Symfony\Component\Form\Extension\Core\View\ChoiceView;

use Kamran\LinkBundle\Form\ChoiceList\GroupChoiceList;
use Kamran\LinkBundle\Form\DataTransformer\ChoiceToGroupTransformer;



class LinkFilterType extends AbstractType
{

    private $em;

    public function __construct($_em){
        $this->em = $_em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('keyword','text', array(
            'mapped' => false,
            'attr' => array(
                'class' => 'form-control',
                'placeholder'=>'Search Keyword...',
                'required' => false,
            ),
        ));

        $builder->add('technologies','groupchoicelist',array(
            'label'=>'Technology Tools',
            'choice_list' => $this->em->getRepository('KamranTechnologyBundle:TechnologyTools')->findByGroup(),
            'entity_class' => 'KamranTechnologyBundle:TechnologyTools'
        ));

        $builder->add('tags','groupchoicelist',array(
            'label'=>'Tags',
            'choice_list' => $this->em->getRepository('KamranTagsBundle:Tags')->findByGroup(),
            'entity_class' => 'KamranTagsBundle:Tags'
        ));

        $builder->add('countries', 'entity', array(
            'class' => 'KamranActivityBundle:Countries',
            //'choice_list' => new SimpleChoiceList($optionArray),
            'multiple' => true,
            'expanded' => true,
        ));

    }


    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kamran\LinkBundle\Entity\GeneralLinks',
        ));
    }

    public function getName()
    {
        return 'linksfilter_form';
    }

}