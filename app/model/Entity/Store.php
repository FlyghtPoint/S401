<?php
namespace Entity;

use JsonSerializable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Entity\Stock;
use Entity\Employee;

/**
 * @ORM\Entity(repositoryClass="Repository\StoreRepository")
 * @ORM\Table(name="stores")
 */
class Store implements JsonSerializable
{
    /** @var int */
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="store_id")
     */
    private int $storeId;

    /** @var string */
    /**
     * @ORM\Column(type="string", length=255, name="store_name")
     */
    private string $storeName;

    /** @var string */
    /**
     * @ORM\Column(type="string", length=25, name="phone")
     */
    private string $phone;

    /** @var string */
    /**
     * @ORM\Column(type="string", length=255, name="email")
     */
    private string $email;

    /** @var string */
    /**
     * @ORM\Column(type="string", length=255, name="street")
     */
    private string $street;

    /** @var string */
    /**
     * @ORM\Column(type="string", length=255, name="city")
     */
    private string $city;

    /** @var string */
    /**
     * @ORM\Column(type="string", length=10, name="state")
     */
    private string $state;

    /** @var string */
    /**
     * @ORM\Column(type="string", length=5, name="zip_code")
     */
    private string $zipCode;

    /** @var Collection */
    /**
     * @ORM\OneToMany(targetEntity=Stock::class, mappedBy="store")
     */
    private Collection $storeStocks;

    /** @var Collection */
    /**
     * @ORM\OneToMany(targetEntity=Employee::class, mappedBy="store")
     */
    private Collection $storeEmployees;

    public function __construct()
    {
        $this->storeStocks = new ArrayCollection();
        $this->storeEmployees = new ArrayCollection();
    }

    /**
     * Get storeId
     * 
     * @return int
     */
    public function getStoreId(): ?int
    {
        return $this->storeId;
    }
    /**
     * Get storeName
     * 
     * @return string
     */
    public function getStoreName(): ?string
    {
        return $this->storeName;
    }
    /**
     * Set storeName
     * 
     * @param string $storeName
     * 
     * @return Store
     */
    public function setStoreName(string $storeName): self
    {
        $this->storeName = $storeName;

        return $this;
    }
    /**
     * Get phone
     * 
     * @return string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }
    /**
     * Set phone
     * 
     * @param string $phone
     * 
     * @return Store
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
    /**
     * Get email
     * 
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }
    /**
     * Set email
     * 
     * @param string $email
     * 
     * @return Store
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    /**
     * Get street
     * 
     * @return string
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }
    /**
     * Set street
     * 
     * @param string $street
     * 
     * @return Store
     */
    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }
    /**
     * Get city
     * 
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }
    /**
     * Set city
     * 
     * @param string $city
     * 
     * @return Store
     */
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }
    /**
     * Get state
     * 
     * @return string
     */
    public function getState(): ?string
    {
        return $this->state;
    }
    /**
     * Set state
     * 
     * @param string $state
     * 
     * @return Store
     */
    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }
    /**
     * Get zipCode
     * 
     * @return string
     */
    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }
    /**
     * Set zipCode
     * 
     * @param string $zipCode
     * 
     * @return Store
     */
    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }
    /**
     * Get stocks
     * 
     * @return Collection
     */
    public function getStocks(): Collection
    {
        return $this->storeStocks;
    }
    /**
     * Get employees
     * 
     * @return Collection
     */
    public function getEmployees(): Collection
    {
        return $this->storeEmployees;
    }

    // -------------------------------------

    public function __toString()
    {
        return "{$this->storeId}: {$this->storeName}. Phone: {$this->phone}, email: {$this->email}, street: {$this->street}, city: {$this->city}, state: {$this->state}, zip code: {$this->zipCode}\n";
    }

    public function jsonSerialize(): mixed
    {
        return [
            'name' => $this->storeName,
        ];
    }
}
