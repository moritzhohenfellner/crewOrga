<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ToernRepository")
 */
class Toern
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="toerns")
     * @ORM\JoinColumn(nullable=false)
     */
    private $OwningUser;

    /**
     * @ORM\Column(type="date")
     */
    private $fromDate;

    /**
     * @ORM\Column(type="date")
     */
    private $toDate;

    /**
     * @ORM\Column(type="text")
     */
    private $Destination;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Share", mappedBy="Toern", orphanRemoval=true)
     */
    private $shares;

    public function __construct()
    {
        $this->shares = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwningUser(): ?User
    {
        return $this->OwningUser;
    }

    public function setOwningUser(?User $OwningUser): self
    {
        $this->OwningUser = $OwningUser;

        return $this;
    }

    public function getFromDate(): ?\DateTimeInterface
    {
        return $this->fromDate;
    }

    public function setFromDate(\DateTimeInterface $fromDate): self
    {
        $this->fromDate = $fromDate;

        return $this;
    }

    public function getToDate(): ?\DateTimeInterface
    {
        return $this->toDate;
    }

    public function setToDate(\DateTimeInterface $toDate): self
    {
        $this->toDate = $toDate;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->Destination;
    }

    public function setDestination(string $Destination): self
    {
        $this->Destination = $Destination;

        return $this;
    }

    public function checkPermission(string $task, User $user){
      switch($task){


        case 'delete':
          if($user == $this->OwningUser){
            return true;
          }else{
            return false;
          }
          break;


        case 'edit-core-data':
        if($user == $this->OwningUser){
          return true;
        }else{
          return false;
        }
        break;

        case 'view-crew-list':
        if($user == $this->OwningUser){
          return true;
        }else{
          return false;
        }
        break;


      }
      return false;
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
            $share->setToern($this);
        }

        return $this;
    }

    public function removeShare(Share $share): self
    {
        if ($this->shares->contains($share)) {
            $this->shares->removeElement($share);
            // set the owning side to null (unless already changed)
            if ($share->getToern() === $this) {
                $share->setToern(null);
            }
        }

        return $this;
    }
}
