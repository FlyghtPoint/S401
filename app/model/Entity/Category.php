<?php
// src/Entity/Category.php
namespace Entity;

use JsonSerializable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Entity\Product;

/**
 * @ORM\Entity
 * @ORM\Table(name="categories")
 */
class Category implements JsonSerializable
{
    /** @var int */
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="category_id")
     */
    private int $categoryId;

    /** @var string */
    /**
     * @ORM\Column(type="string", length=255, name="category_name")
     */
    private string $categoryName;

    /** @var Collection */
    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="category")
     */
    private Collection $categoryProducts;

    public function __construct()
    {
        $this->categoryProducts = new ArrayCollection();
    }

    /**
     * Get categoryId
     * 
     * @return int
     */
    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }
    /**
     * Get categoryName
     * 
     * @return string
     */
    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }
    /**
     * Set categoryName
     * 
     * @param string $categoryName
     * 
     * @return Category
     */
    public function setCategoryName(string $categoryName): self
    {
        $this->categoryName = $categoryName;

        return $this;
    }
    /**
     * Get products
     * 
     * @return Collection
     */
    public function getProducts(): Collection
    {
        return $this->categoryProducts;
    }

    // -------------------------------------

    public function __toString()
    {
        return "{$this->categoryId}: {$this->categoryName}\n";
    }

    public function jsonSerialize(): mixed
    {
        return [
            'name' => $this->categoryName,
        ];
    }
}
