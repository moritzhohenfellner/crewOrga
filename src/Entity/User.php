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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Share", mappedBy="User", orphanRemoval=true)
     */
    private $shares;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $surName;

    public function __construct()
    {
        parent::__construct();
        $this->toerns = new ArrayCollection();
        $this->shares = new ArrayCollection();
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

    /**
     * @return Collection|Share[]
     */
    public function getShares(): Collection
    {
        return $this->shares;
    }

    public function addShare(Share $share): self
    {
        if (!$this->shares->contains($share)) {
            $this->shares[] = $share;
            $share->setUser($this);
        }

        return $this;
    }

    public function removeShare(Share $share): self
    {
        if ($this->shares->contains($share)) {
            $this->shares->removeElement($share);
            // set the owning side to null (unless already changed)
            if ($share->getUser() === $this) {
                $share->setUser(null);
            }
        }

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getSurName(): ?string
    {
        return $this->surName;
    }

    public function setSurName(string $surName): self
    {
        $this->surName = $surName;

        return $this;
    }
}

?>
