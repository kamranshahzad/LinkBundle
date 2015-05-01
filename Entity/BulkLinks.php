<?php

namespace Kamran\LinkBundle\Entity;


use Doctrine\ORM\Mapping as ORM;


/**
 *  Kamran\LinkBundle\Entity\BulkLinks
 *
 * @ORM\Table(name="link_bulk")
 * @ORM\Entity(repositoryClass="Kamran\LinkBundle\Entity\Repository\BulkLinksRepository")
*/
class BulkLinks
{

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var text $link
     *
     * @ORM\Column(type="text", length=2000, nullable=true)
     */
    protected $link = '';

    /**
     * @var text $name
     *
     * @ORM\Column(type="text", length=200, nullable=true)
     */
    protected $name;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function setLink($link)
    {
        $this->link = $link;
        return $this;
    }

    public function getLink()
    {
        return $this->link;
    }


    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }


} //@

