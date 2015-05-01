<?php

namespace Kamran\LinkBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class TestFieldType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        /*
        $builder->add('0', 'checkbox', array(
            'label'     => 'Show this entry publicly?',
            'value'   => '1',
            'required'  => false,
        ));
        $builder->add('1', 'checkbox', array(
            'label'     => 'Twoooo',
            'value'   => '2',
            'required'  => false,
        ));
        */

        $arrayOptions = array(
            array('value'=>0,'label'=>'Zero','required'=>''),
            array('value'=>1,'label'=>'One','required'=>'')
        );

        foreach($arrayOptions as $key=>$options){
            $builder->add($key,'checkbox',$options);
        }


    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->parent->vars['link_group'] = $options['link_group'];
        //echo $options['link_group'];
        $view->vars['myitems'] = 'Yes , go ahead';
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
       //$view->vars['link_group'] = $options['link_group'];
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setOptional(array(
            'data',
        ));

        $resolver->setDefaults(array(
            'class' => null,
            'link_group'=> 'abc',
        ));

        /*
        $resolver->setNormalizers(array(
            'empty_value' => $emptyValueNormalizer,
        ));
        $resolver->setAllowedTypes(array(
            'choice_list' => array('null', 'Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceListInterface'),
        ));
        $resolver->addAllowedTypes(array('contest' => 'Incenteev\WebBundle\Entity\Contest'));
        $resolver->setRequired(array('contest'));
        */

    }

    public function getName()
    {
        return 'testfieldtypes';
    }

}



