<?php
namespace Entity;

use JsonSerializable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Entity\Brand;
use Entity\Category;
use Entity\Stock;

/**
 * @ORM\Entity(repositoryClass="Repository\ProductRepository")
 * @ORM\Table(name="products")
 */
class Product implements JsonSerializable
{
    /** @var int */
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="product_id")
     */
    private int $productId;

    /** @var string */
    /**
     * @ORM\Column(type="string", length=255, name="product_name")
     */
    private string $productName;

    /** @var Brand */
    /**
     * @ORM\ManyToOne(targetEntity=Brand::class, inversedBy="brandProducts")
     * @ORM\JoinColumn(name="brand_id", referencedColumnName="brand_id")
     */
    private Brand $brand;

    /** @var Category */
    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="categoryProducts")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="category_id")
     */
    private Category $category;

    /** @var int */
    /**
     * @ORM\Column(type="smallint", name="model_year")
     */
    private int $modelYear;

    /** @var string */
    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, name="list_price")
     */
    private string $listPrice;

    /** @var Collection */
    /**
     * @ORM\OneToMany(targetEntity=Stock::class, mappedBy="product")
     */
    private Collection $productStocks;

    public function __construct()
    {
        $this->productStocks = new ArrayCollection();
    }

    /**
     * Get productId
     * 
     * @return int
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }
    /**
     * Get productName
     * 
     * @return string
     */
    public function getProductName(): ?string
    {
        return $this->productName;
    }
    /**
     * Set productName
     * 
     * @param string $productName
     * 
     * @return Product
     */
    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }
    /**
     * Get brand
     * 
     * @return Brand
     */
    public function getBrand(): ?Brand
    {
        return $this->brand;
    }
    /**
     * Set brand
     * 
     * @param Brand $brand
     * 
     * @return Product
     */
    public function setBrand(Brand $brand): self
    {
        $this->brand = $brand;
        return $this;
    }
    /**
     * Get category
     * 
     * @return Category
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }
    /**
     * Set category
     * 
     * @param Category $category
     * 
     * @return Product
     */
    public function setCategory(Category $category): self
    {
        $this->category = $category;
        return $this;
    }
    /**
     * Get modelYear
     * 
     * @return int
     */
    public function getModelYear(): ?int
    {
        return $this->modelYear;
    }
    /**
     * Set modelYear
     * 
     * @param int $modelYear
     * 
     * @return Product
     */
    public function setModelYear(int $modelYear): self
    {
        $this->modelYear = $modelYear;

        return $this;
    }
    /**
     * Get listPrice
     * 
     * @return string
     */
    public function getListPrice(): ?string
    {
        return $this->listPrice;
    }
    /**
     * Set listPrice
     * 
     * @param string $listPrice
     * 
     * @return Product
     */
    public function setListPrice(string $listPrice): self
    {
        $this->listPrice = $listPrice;

        return $this;
    }
    /**
     * Get stocks
     * 
     * @return Collection
     */
    public function getStocks(): Collection
    {
        return $this->productStocks;
    }

    // -------------------------------------

    public function __toString()
    {
        return "{$this->productId} : {$this->productName}. Brand: {$this->brandId}. Category: {$this->categoryId}. Model Year: {$this->modelYear}. List Price: {$this->listPrice}\n";
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->productId,
            'name' => $this->productName,
            'brand' => $this->brand,
            'category' => $this->category,
            'year' => $this->modelYear,
            'price' => $this->listPrice,
            'stock' => $this->productStocks,
        ];
    }
}
