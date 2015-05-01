<?php

namespace Kamran\LinkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections;


/**
 *
 * @ORM\Table(name="links")
 * @ORM\Entity
 */
class Links
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
     * @ORM\OneToMany(targetEntity="Accounts", mappedBy="link", cascade={"persist"})
     * @var type
     */
    private $accounts;

    

    public function __construct(){
        $this->accounts = new ArrayCollection();
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

    public function getAccounts(){
        return $this->accounts;
    }

    public function addAccounts(Account $account){
        $this->accounts[] = $account;
        $account->setLink($account);
    }

    public function setAccount(Account $account){
        $this->accounts = $account;
        foreach ($account as $acc){
            $acc->setLink($this);
        }
    }

    public function addAccount(Account $account){
        $this->accounts[] = $account;
        return $this;
    }

    public function removeAccount(Account $account)
    {
        $this->accounts->removeElement($account);
    }

}
