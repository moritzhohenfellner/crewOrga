<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShareRepository")
 */
class Share
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="shares")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Toern", inversedBy="shares")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Toern;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getToern(): ?Toern
    {
        return $this->Toern;
    }

    public function setToern(?Toern $Toern): self
    {
        $this->Toern = $Toern;

        return $this;
    }
}
