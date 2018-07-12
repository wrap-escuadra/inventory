<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SupplierStatusRepository")
 */
class SupplierStatus
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    public $status_desc;


    public function __construct()
    {

    }
    public function getId()
    {
        return $this->id;
    }

    public function getStatusDesc(): ?string
    {
        return $this->status_desc;
    }

    public function setStatusDesc(string $status_desc): self
    {
        $this->status_desc = $status_desc;

        return $this;
    }





}
