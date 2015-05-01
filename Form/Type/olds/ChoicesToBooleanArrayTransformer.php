<?php

namespace Kamran\LinkBundle\Form\Type;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;


use Kamran\TagsBundle\Entity\Tags;
use Kamran\LinkBundle\Entity\Links;


class ChoicesToBooleanArrayTransformer implements DataTransformerInterface
{
    
    public function transform($array)
    {


        /*
        $newArray = $array->toArray();
        

        if (null === $newArray) {
            return array();
        }

        if (!is_array($newArray)) {
            throw new TransformationFailedException('Expected an array.');
        }

        try {
            //$values = $this->choiceList->getValues();
            $values = $newArray;
        } catch (\Exception $e) {
            throw new TransformationFailedException('Can not get the choice list', $e->getCode(), $e);
        }

        //$valueMap = array_flip($this->choiceList->getValuesForChoices($array));

        foreach ($values as $i => $value) {
            //$values[$i] = isset($valueMap[$value]);
        }

        return $values;
        */
    }


    public function reverseTransform($values)
    {

        if (!is_array($values)) {
            throw new TransformationFailedException('Expected an array.');
        }

        $result = array();

        foreach($values as $i => $selected){
            if($selected){
               // $result[] = $i;
                $obj = new Tags();
                $obj->setId($i);
                //$result[] = $obj;
                

            }
        }

        return $result;

        /*
        

        try {
            $choices = $this->choiceList->getChoices();
        } catch (\Exception $e) {
            throw new TransformationFailedException('Can not get the choice list', $e->getCode(), $e);
        }

        $result = array();
        $unknown = array();

        foreach ($values as $i => $selected) {
            if ($selected) {
                if (isset($choices[$i])) {
                    $result[] = $choices[$i];
                } else {
                    $unknown[] = $i;
                }
            }
        }

        if (count($unknown) > 0) {
            throw new TransformationFailedException(sprintf('The choices "%s" were not found', implode('", "', $unknown)));
        }
        */
        //return $result;
    }
}
