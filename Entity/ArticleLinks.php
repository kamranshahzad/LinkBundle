<?php

namespace Kamran\LinkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections;


/**
 *
 * @ORM\Table(name="articlelinks")
 * @ORM\Entity
 */
class ArticleLinks
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
     * @ORM\ManyToOne(targetEntity="Kamran\TechnologyBundle\Entity\TechnologyTools")
     * @ORM\JoinColumn(name="tool_id", referencedColumnName="id")
     */
    private $technology;


    /**
     * @ORM\ManyToMany(targetEntity="Kamran\TagsBundle\Entity\TechnologyTags")
     * @ORM\JoinTable(name="technologytags_articlelinks",
     *      joinColumns={@ORM\JoinColumn(name="link_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     *      )
     */
    private $tags;

    

    public function __construct(){
        $this->tags = new ArrayCollection();
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
    public function addTags(\Kamran\TagsBundle\Entity\TechnologyTags $tags){
        $this->tags[] = $tags;
    }

    public function getTags(){
        return $this->tags;
    }

    public function setTechnology($technology){
        $this->technology = $technology;
        return $this;
    }

    public function getTechnology(){
        return $this->technology;
    }
    
  /*  public function setTags($tags){
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
*/

}
