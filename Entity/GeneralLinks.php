<?php

namespace Kamran\LinkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections;


/**
 *
 * @ORM\Table(name="generallinks")
 * @ORM\Entity(repositoryClass="Kamran\LinkBundle\Entity\Repository\GeneralLinksRepository")
 */
class GeneralLinks
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;


    /**
     * @ORM\ManyToMany(targetEntity="Kamran\TechnologyBundle\Entity\TechnologyTools")
     * @ORM\JoinTable(name="technologytools_generallinks",
     *      joinColumns={@ORM\JoinColumn(name="link_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tool_id", referencedColumnName="id")}
     *      )
    */
    private $technologies;


    /**
     * @ORM\ManyToMany(targetEntity="Kamran\TagsBundle\Entity\Tags")
     * @ORM\JoinTable(name="tags_generallinks",
     *      joinColumns={@ORM\JoinColumn(name="link_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     *      )
     */
    private $tags;

    /**
     * @ORM\ManyToMany(targetEntity="Kamran\ActivityBundle\Entity\Countries")
     * @ORM\JoinTable(name="countries_generallinks",
     *      joinColumns={@ORM\JoinColumn(name="link_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="country_id", referencedColumnName="id")}
     *      )
     */
    private $countries;

    

    public function __construct(){
        $this->tags = new ArrayCollection();
        $this->technologies = new ArrayCollection();
        $this->countries = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId(){
        return $this->id;
    }

    public function setUrl($url){
        $this->url = $url;
        return $this;
    }

    public function getUrl(){
        return $this->url;
    }

    public function setDescription($des){
        $this->description = $des;
        return $this;
    }

    public function getDescription(){
        return $this->description;
    }



    /*
     * Relationships
     * */

    public function setTechnologies($tools){
        $this->technologies = $tools;
        return $this;
    }

    public function addTechnologies(\Kamran\TechnologyBundle\Entity\TechnologyTools $tools){
        $this->technologies[] = $tools;
    }

    public function getTechnologies(){
        return $this->technologies;
    }

    public function setCountries($country){
        $this->countries = $country;
        return $this;
    }

    public function addCountries(\Kamran\ActivityBundle\Entity\Countries $countries){
        $this->countries[] = $countries;
    }

    public function getCountries(){
        return $this->countries;
    }


    public function setTags($tags){
        $this->tags = $tags;
        return $this;
    }

    public function addTag(\Kamran\TagsBundle\Entity\Tags $tags){
        $this->tags[] = $tags;
    }

    public function getTags(){
        return $this->tags;
    }

    public function removeTag(\Kamran\TagsBundle\Entity\Tags $tags){
        $this->tags->removeElement($tags);
    }


}
