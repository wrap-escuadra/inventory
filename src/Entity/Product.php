<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $product_code;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     */
    private $supplier_id;

    /**
     * @ORM\Column(type="float")
     */
    private $supplier_price;

    /**
     * @ORM\Column(type="float")
     */
    private $interest_rate;

    /**
     * @ORM\Column(type="float")
     */
    private $computed_price;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $online_price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $img;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $product_status;



    public function __construct()
    {
        $this->created_at = new \DateTime();
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getProductCode(): ?string
    {
        return $this->product_code;
    }

    public function setProductCode(string $product_code): self
    {
        $this->product_code = $product_code;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSupplierId(): ?int
    {
        return $this->supplier_id;
    }

    public function setSupplierId( $supplier_id): self
    {
        $this->supplier_id = $supplier_id;
//        $this->supplier_id = $supplier_id instanceof Product ? $supplier_id->getId() : $supplier_id;

        return $this;
    }

    public function getSupplierPrice(): ?float
    {
        return $this->supplier_price;
    }

    public function setSupplierPrice(?float $supplier_price): self
    {
        $this->supplier_price = $supplier_price;

        return $this;
    }

    public function getInterestRate(): ?float
    {
        return $this->interest_rate;
    }

    public function setInterestRate(float $interest_rate): self
    {
        $this->interest_rate = $interest_rate;

        return $this;
    }

    public function getComputedPrice(): ?float
    {
        return $this->computed_price;
    }

    public function setComputedPrice(float $computed_price): self
    {
        $this->computed_price = $computed_price;

        return $this;
    }

    public function getOnlinePrice(): ?float
    {
        return $this->online_price;
    }

    public function setOnlinePrice(?float $online_price): self
    {
        $this->online_price = $online_price;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getProductStatus(): ?int
    {
        return $this->product_status;
    }

    public function setProductStatus(?int $product_status): self
    {
        $this->product_status = $product_status;

        return $this;
    }


//-----

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Supplier", inversedBy="products", fetch="EAGER")
     * @ORM\JoinColumn(name="supplier_id", referencedColumnName="id")
     */
    private $supplier;

    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    public function setSupplier(?Supplier $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }






}
