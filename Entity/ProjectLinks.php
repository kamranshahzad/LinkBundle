<?php

namespace Kamran\LinkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections;


/**
 *
 * @ORM\Table(name="projectlinks")
 * @ORM\Entity
 */
class ProjectLinks
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
     * @ORM\ManyToMany(targetEntity="Kamran\ProjectsBundle\Entity\Projects")
     * @ORM\JoinTable(name="projects_projectlinks",
     *      joinColumns={@ORM\JoinColumn(name="link_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="project_id", referencedColumnName="id")}
     *      )
     */
    private $projects;

    

    public function __construct(){
        $this->projects = new ArrayCollection();
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
    public function addProjects(\Kamran\ProjectsBundle\Entity\Projects $projects){
        $this->projects[] = $projects;
    }

    public function getProjects(){
        return $this->projects;
    }


}
