<?php
// src/AppBundle/Entity/User.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Toern", mappedBy="OwningUser", orphanRemoval=true)
     */
    private $toerns;

    public function __construct()
    {
        parent::__construct();
        $this->toerns = new ArrayCollection();
        // your own logic
    }

    /**
     * @return Collection|Toern[]
     */
    public function getToerns(): Collection
    {
        return $this->toerns;
    }

    public function addToern(Toern $toern): self
    {
        if (!$this->toerns->contains($toern)) {
            $this->toerns[] = $toern;
            $toern->setOwningUser($this);
        }

        return $this;
    }

    public function removeToern(Toern $toern): self
    {
        if ($this->toerns->contains($toern)) {
            $this->toerns->removeElement($toern);
            // set the owning side to null (unless already changed)
            if ($toern->getOwningUser() === $this) {
                $toern->setOwningUser(null);
            }
        }

        return $this;
    }
}

?>
