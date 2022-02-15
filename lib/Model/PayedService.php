<?php namespace Vankosoft\UsersSubscriptionsBundle\Model;

use Sylius\Component\Resource\Model\ToggleableTrait;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PayedServiceInterface;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\CheckoutOrderInterface;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\SubscriptionPeriodInterface;

class PayedService implements PayedServiceInterface, CheckoutOrderInterface
{
    use ToggleableTrait;

    /** @var integer */
    protected $id;
    
    /**
     * @var SubscriptionPeriodInterface
     */
    protected $subscriptionPeriod;
    
    /** @var string */
    protected $title;
    
    /** @var string */
    protected $description;
    
    /** @var float */
    protected $price;
    
    /** @var string */
    protected $currency;
    
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get SubscriptionPeriod
     *
     * @return SubscriptionPeriod
     */
    public function getSubscriptionPeriod()
    {
        return $this->subscriptionPeriod;
    }
    
    /**
     * Set plan
     *
     * @param SubscriptionPeriod $subscriptionPeriod
     * @return PayedService
     */
    public function setSubscriptionPeriod(SubscriptionPeriod $subscriptionPeriod)
    {
        $this->subscriptionPeriod = $subscriptionPeriod;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }
    
    public function setTitle($title)
    {
        $this->title = $title;
        
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
    
    public function getBillingPeriod()
    {
        return $this->subscriptionPeriod ? $this->subscriptionPeriod->getSubscriptionPeriod() : null;
    }
    
    public function getBillingFrequency()
    {
        return 1;
    }

}
