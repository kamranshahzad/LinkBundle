<?php

namespace Kamran\LinkBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;


class GroupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$builder->setAttribute('prototypes', $prototypes);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        /*echo '<pre>';
        print_r($options['choice_list']->getRemainingViews());
        echo '</pre>';*/

        $name = $form->getName();

        //echo $options['class'];





        /*
        $class_methods = get_class_methods($form);
        foreach ($class_methods as $method_name) {
            echo "$method_name <br/>";
        }
        */

        //var_dump(array_keys(get_object_vars($form)));

        if ($view->parent) {
            //$view->parent->vars['full_name']
            //$view->parent->vars['id']
            //$view->parent->vars['unique_block_prefix']
        }

        /*$view->vars = array_replace($view->vars, array(
            'form'                => $view,
            'id'                  => $id,
        ));*/

        //$view->vars['choices'] = array(1=>'One',2=>'Two');


    }
    public function finishView(FormView $view, FormInterface $form, array $options)
    {


        //echo gettype($view->vars);

        // Translate Choice labels
        if (!empty($view->vars['choices'])) {
            foreach ($view->vars['choices'] as $key => $choiceView) {
                //echo $choiceView->value;
                //echo $choiceView->label;
                //$view->vars['choices'][$key] = $choiceView;
            }
        }


        if (array_key_exists('class', $view->vars['attr'])) {
            $view->vars['attr']['class'] = "test";
        }

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        /*$resolver->setDefaults(array(
            'choices' => array(
                'm' => 'Male',
                'f' => 'Female',
            )
        ));*/

        /*$resolver->setAllowedTypes(array(
            'attr'       => 'array',
        ));*/
    }



    public function getParent()
    {
        return 'entity';
    }

    public function getName()
    {
        return 'group';
    }
}