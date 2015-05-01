<?php

namespace Kamran\LinkBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;

 
/**
 * @ORM\Entity
 * @ORM\Table(name="link_accounts")
 */
class Accounts
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
     * @ORM\Column(name="username", type="string", length=50)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=50)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=80)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="comments", type="string", length=200)
    */
    private $comments;


    /**
     * @ORM\ManyToOne(targetEntity="Links", inversedBy="accounts")
     * @ORM\JoinColumn(name="link_id", referencedColumnName="id")
     * @var type
     */
    private $link;



    public function getId(){
        return $this->id;
    }


    public function setUsername($username){
        $this->username = $username;
        return $this;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setPassword($password){
        $this->password = $password;
        return $this;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setEmail($email){
        $this->email = $email;
        return $this;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setComments($comments){
        $this->comments = $comments;
        return $this;
    }

    public function getComments(){
        return $this->comments;
    }


    /*
    Relationship
    */
    public function setLink(Links $link)
    {
        $this->link = $link;
        return $this;
    }

    public function getLink()
    {
        return $this->link;
    }

}