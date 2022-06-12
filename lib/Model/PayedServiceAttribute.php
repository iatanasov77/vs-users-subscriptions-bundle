<?php namespace Vankosoft\UsersSubscriptionsBundle\Model;

use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PayedServiceAttributeInterface;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PayedServiceInterface;

class PayedServiceAttribute implements PayedServiceAttributeInterface
{
    /**
     * @var integer
     */
    protected $id;
    
    /**
     * @var PayedServiceInterface
     */
    protected $payedService;
    
    /**
     * @var string
     */
    protected $name;
    
    /**
     * @var string
     */
    protected $value;
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getPayedService()
    {
        return $this->payedService;
    }
    
    public function setPayedService( $payedService )
    {
        $this->payedService = $payedService;
        
        return $this;
    }
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getValue(): string
    {
        return $this->value;
    }
    
    public function setValue($value)
    {
        $this->value = $value;
    }
}