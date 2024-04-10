<?php
namespace Entity;

use JsonSerializable;
use Doctrine\ORM\Mapping as ORM;
use Entity\Store;

/**
 * @ORM\Entity
 * @ORM\Table(name="employees")
 */
class Employee implements JsonSerializable
{
    /** @var int */
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="employee_id")
     */
    private int $employeeId;

    /** @var Store */
    /**
     * @ORM\ManyToOne(targetEntity=Store::class, inversedBy="storeEmployees")
     * @ORM\JoinColumn(name="store_id", referencedColumnName="store_id")
     */
    private Store $store;    

    /** @var string */
    /**
     * @ORM\Column(type="string", length=255, name="employee_name")
     */
    private string $employeeName;

    /** @var string */
    /**
     * @ORM\Column(type="string", length=255, name="employee_email")
     */
    private string $employeeEmail;

    /** @var string */
    /**
     * @ORM\Column(type="string", length=255, name="employee_password")
     */
    private string $employeePassword;

    /** @var string */
    /**
     * @ORM\Column(type="string", length=255, name="employee_role")
     */
    private string $employeeRole;

    /**
     * Get employeeId
     * 
     * @return int
     */
    public function getEmployeeId(): ?int
    {
        return $this->employeeId;
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
     * @return Employee
     */
    public function setStore(Store $store): self
    {
        $this->store = $store;
        return $this;
    }
    /**
     * Get employeeName
     * 
     * @return string
     */
    public function getEmployeeName(): ?string
    {
        return $this->employeeName;
    }
    /**
     * Set employeeName
     * 
     * @param string $employeeName
     * 
     * @return Employee
     */
    public function setEmployeeName(string $employeeName): self
    {
        $this->employeeName = $employeeName;

        return $this;
    }
    /**
     * Get employeeEmail
     * 
     * @return string
     */
    public function getEmployeeEmail(): ?string
    {
        return $this->employeeEmail;
    }
    /**
     * Set employeeEmail
     * 
     * @param string $employeeEmail
     * 
     * @return Employee
     */
    public function setEmployeeEmail(string $employeeEmail): self
    {
        $this->employeeEmail = $employeeEmail;

        return $this;
    }
    /**
     * Get employeePassword
     * 
     * @return string
     */
    public function getEmployeePassword(): ?string
    {
        return $this->employeePassword;
    }
    /**
     * Set employeePassword
     * 
     * @param string $employeePassword
     * 
     * @return Employee
     */
    public function setEmployeePassword(string $employeePassword): self
    {
        $this->employeePassword = $employeePassword;

        return $this;
    }
    /**
     * Get employeeRole
     * 
     * @return string
     */
    public function getEmployeeRole(): ?string
    {
        return $this->employeeRole;
    }
    /**
     * Set employeeRole
     * 
     * @param string $employeeRole
     * 
     * @return Employee
     */
    public function setEmployeeRole(string $employeeRole): self
    {
        $this->employeeRole = $employeeRole;

        return $this;
    }
    // -------------------------------------

    public function __toString()
    {
        return "{$this->employeeId}: {$this->employeeName}, {$this->employeeEmail}, {$this->employeePassword}, {$this->employeeRole}. Store ID: {$this->storeId}.\n";
    }

    public function jsonSerialize(): mixed
    {
        return [
            'employeeId' => $this->employeeId,
            'employeeName' => $this->employeeName,
            // 'employeeEmail' => $this->employeeEmail,
            // 'employeeRole' => $this->employeeRole,
            // 'storeId' => $this->store->getStoreId()
        ];
    }
}
