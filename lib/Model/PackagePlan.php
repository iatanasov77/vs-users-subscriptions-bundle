<?php namespace VS\UsersSubscriptionsBundle\Model;

use Sylius\Component\Resource\Model\ToggleableTrait;
use VS\UsersSubscriptionsBundle\Model\Interfaces\PackagePlanInterface;
use VS\UsersSubscriptionsBundle\Model\Interfaces\CheckoutOrderInterface;
use VS\UsersSubscriptionsBundle\Model\Interfaces\PackageInterface;
use VS\UsersSubscriptionsBundle\Model\Interfaces\PlanInterface;

class PackagePlan implements PackagePlanInterface, CheckoutOrderInterface
{
    use ToggleableTrait;

    /** @var integer */
    protected $id;
    
    /**
     * Relation to the Package entity
     *
     * @var PackageInterface
     */
    protected $package;
    
    /**
     * Relation to the Plan entity
     *
     * @var PlanInterface
     */
    protected $plan;
    
    /** @var float */
    protected $price;
    
    /** @var string */
    protected $currency;
    
    /** @var string */
    protected $description;
    
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Get package
     *
     * @return Package
     */
    public function getPackage()
    {
        return $this->package;
    }
    
    /**
     * Set package
     *
     * @param Package $package
     * @return PackagePlan
     */
    public function setPackage(Package $package)
    {
        $this->package = $package;

        return $this;
    }

    /**
     * Get plan
     *
     * @return PackagePlan
     */
    public function getPlan()
    {
        return $this->plan;
    }
    
    /**
     * Set plan
     *
     * @param Plan $plan
     * @return PackagePlan
     */
    public function setPlan(Plan $plan)
    {
        $this->plan = $plan;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        
        return $this;
    }

    public function getCurrency()
    {
        return $this->currency;
    }
    
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        
        return $this;
    }
    
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        
        return $this;
    }
    
    public function getBillingPeriod()
    {
        return $this->plan ? $this->plan->getSubscriptionPeriod() : null;
    }
    
    public function getBillingFrequency()
    {
        return 1;
    }

}
