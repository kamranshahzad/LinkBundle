<?php

namespace Kamran\LinkBundle\Form\ChoiceList;

use Symfony\Component\Form\Extension\Core\ChoiceList\LazyChoiceList;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;

class GroupChoiceList extends LazyChoiceList {

    protected function loadChoiceList() {


        $choices = array(
            'es' => array('a'=>'España','b'=>'Yammi'),
            'gb' => array('a2'=>'Reino Unido','b2'=>'Black Jack'),
        );

        $labels = array(
            'es' => array('a'=>'España','b'=>'Yammi'),
            'gb' => array('a2'=>'Reino Unido','b2'=>'Black Jack'),
        );


        /*$choices = array(
            'es' => 'España',
            'gb' => 'Reino Unido',
        );

        $labels = array(
            'es' => 'España',
            'gb' => 'Reino Unido',
        );*/

        return new ChoiceList($choices, $labels);
    }

}
