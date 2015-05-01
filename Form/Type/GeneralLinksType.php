<?php

namespace Kamran\LinkBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;
use Symfony\Component\Form\Extension\Core\View\ChoiceView;




class GeneralLinksType extends AbstractType
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


      /*  $tagsField = $builder->create('tags', new GroupChoiceType() , array(
            'choice_list' => $this->em->getRepository('KamranTagsBundle:Tags')->findByGroup()
            ))->addModelTransformer( new ChoiceTagsTransformer($this->em));


        $builder->add(
            $tagsField
        );
*/

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
            'data_class' => 'Kamran\LinkBundle\Entity\GeneralLinks',
        ));
    }

    public function getName()
    {
        return 'generallinks_form';
    }

}