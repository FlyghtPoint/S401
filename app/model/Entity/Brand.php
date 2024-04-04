<?php
// src/Entity/Brand.php
namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Entity\Product;

/**
 * @ORM\Entity
 * @ORM\Table(name="brands")
 */
class Brand
{
    /** @var int */
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="brand_id")
     */
    private int $brandId;

    /** @var string */
    /**
     * @ORM\Column(type="string", length=255, name="brand_name")
     */
    private string $brandName;

    /** @var Collection */
    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="brand")
     */
    private Collection $brandProducts;

    public function __construct()
    {
        $this->brandProducts = new ArrayCollection();
    }

    /**
     * Get brandId
     * 
     * @return int
     */
    public function getBrandId(): ?int
    {
        return $this->brandId;
    }
    /**
     * Set brandId
     * 
     * @param int $brandId
     * 
     * @return Brand
     */
    /**
     * Get brandName
     * 
     * @return string
     */
    public function getBrandName(): ?string
    {
        return $this->brandName;
    }
    /**
     * Set brandName
     * 
     * @param string $brandName
     * 
     * @return Brand
     */
    public function setBrandName(string $brandName): self
    {
        $this->brandName = $brandName;

        return $this;
    }
    /**
     * Get products
     * 
     * @return Collection
     */
    public function getProducts(): Collection
    {
        return $this->brandProducts;
    }

    // -------------------------------------
    public function __toString()
    {
        return "{$this->brandId}: {$this->brandName}\n";
    }
}
