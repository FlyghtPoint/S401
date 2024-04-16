<?php
namespace Entity;

use JsonSerializable;
use Doctrine\ORM\Mapping as ORM;
use Entity\Product;
use Entity\Store;

/**
 * @ORM\Entity
 * @ORM\Table(name="stocks")
 */
class Stock implements JsonSerializable
{
    /** @var int */
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="stock_id")
     */
    private int $stockId;

    /** @var Store */
    /**
     * @ORM\ManyToOne(targetEntity=Store::class, inversedBy="storeStocks")
     * @ORM\JoinColumn(name="store_id", referencedColumnName="store_id")
     */
    private Store $store;

    /** @var Product */
    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="productStocks")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="product_id")
     */
    private Product $product;

    /** @var int */
    /**
     * @ORM\Column(type="integer", name="quantity")
     */
    private int $quantity;

    /**
     * Get stockId
     * 
     * @return int
     */
    public function getStockId(): ?int
    {
        return $this->stockId;
    }
    /**
     * Get store
     * 
     * @return Store
     */
    public function getStore(): ?Store
    {
        return $this->store;
    }
    /**
     * Set store
     * 
     * @param Store $store
     * 
     * @return Stock
     */
    public function setStore(Store $store): self
    {
        $this->store = $store;
        return $this;
    }
    /**
     * Get product
     * 
     * @return Product
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }
    /**
     * Set product
     * 
     * @param Product $product
     * 
     * @return Stock
     */
    public function setProduct(Product $product): self
    {
        $this->product = $product;
        return $this;
    }
    /**
     * Get quantity
     * 
     * @return int
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }
    /**
     * Set quantity
     * 
     * @param int $quantity
     * 
     * @return Stock
     */
    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }
    // -------------------------------------

    public function __toString()
    {
        return "{$this->stockId}. Store ID: {$this->storeId}. Product ID: {$this->product->product_id}, quantity: {$this->quantity}\n";
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->stockId,
            'store' => [
                'id' => $this->store->getStoreId(),
                'name' => $this->store->getStoreName(),
            ],
            'quantity' => $this->quantity,
        ];
    }
}
