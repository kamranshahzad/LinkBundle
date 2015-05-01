<?php

namespace Kamran\LinkBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;

class ChoiceToGroupTransformer implements DataTransformerInterface
{
    public function transform($object)
    {
        //echo get_class($object);


        return $object;
    }

    public function reverseTransform($value)
    {
        return $value;
    }

}