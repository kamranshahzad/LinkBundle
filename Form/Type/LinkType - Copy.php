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



class LinkType extends AbstractType
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


        $tagsField = $builder->create('tags', new GroupChoiceType() , array(
            'choice_list' => $this->em->getRepository('KamranTagsBundle:Tags')->findByGroup()
            ))->addModelTransformer( new ChoiceTagsTransformer($this->em));


        $builder->add(
            $tagsField
        );


/*        $builder->add('tags', 'choice', array(
            'choices' => $optionArray ,
            'multiple' => true,
            'expanded' => true,
        ));*/ 


/*        $optionArray = array(
            'morning'   => 'Morning',
            'afternoon' => 'Afternoon',
            'evening'   => 'Evening',
        );
        $builder->add('tags', 'entity', array(
            'class' => 'KamranTagsBundle:Tags',
            //'choice_list' => new SimpleChoiceList($optionArray),
            'multiple' => true,
            'expanded' => true,
        ));*/


       /* $builder->add('tags', 'choice', array(
            'choices'   => array(
                'morning'   => 'Morning',
                'afternoon' => 'Afternoon',
                'evening'   => 'Evening',
            ),
            'multiple'  => true,
        ));*/

/*        $builder->add('tags', new TestFieldType(),array(
            'class' => 'KamranTagsBundle:Tags',
        ));*/




        /*$builder->add('tags', new GroupType() , array(
            'class' => 'KamranTagsBundle:Tags',
            'multiple' => true,
            'choice_list' => new SimpleChoiceList($array),
            'choice_list'=>new GroupChoiceList(),
            'expanded' => true,
        ));*/


        //$transformer = new ChoiceToGroupTransformer();

        /*$builder->add('tags', 'entity', array(
            'class' => 'KamranTagsBundle:Tags',
            //'empty_value' => 'Choose Tag Type',
            'multiple' => true,
            'expanded' => true,
            'group_by'=> 'type_id',
        ));*/
         //   ->addViewTransformer($transformer);
        //buildViewBottomUp$transformer);

    }


    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kamran\LinkBundle\Entity\Links',
        ));
    }

    public function getName()
    {
        return 'links_form';
    }

}