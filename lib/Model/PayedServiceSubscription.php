<?php namespace Vankosoft\UsersSubscriptionsBundle\Model;

use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PayedServiceSubscriptionInterface;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PayedServiceInterface;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\SubscribedUserInterface;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PaymentDetailsInterface;

class PayedServiceSubscription implements PayedServiceSubscriptionInterface
{
    /** @var integer */
    protected $id;

    /**
     * Relation to the PayedService entity
     *
     * @var PayedServiceInterface
     */
    protected $payedService;
    
    /**
     * Relation to the User entity
     *
     * @var SubscribedUserInterface
     */
    protected $user;

    /**
     * Relation to the PaymentDetails entity
     * Need Vanksoft/Payment Bundle and need to be mapped to PaymentDetails entity
     *
     * @var PaymentDetailsInterface
     */
    protected $paymentDetails;
    
    /** @var datetime */
    protected $date;

    public function getId()
    {
        return $this->id;
    }

    public function getPayedService()
    {
        return $this->payedService;
    }
    
    public function setPayedService($payedService)
    {
        $this->payedService = $payedService;
        
        return $this;
    }
    
    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
        
        return $this;
    }
    
    public function getPaymentDetails()
    {
        return $this->paymentDetails;
    }
    
    public function setPaymentDetails(Payment $paymentDetails)
    {
        $this->paymentDetails = $paymentDetails;
        
        return $this;
    }
    
    public function getDate()
    {
        return $this->date;
    }
    
    public function setDate($date)
    {
        $this->date = $date;
        
        return $this;
    }

    public function getPaymentMethod()
    {
        return $this->paymentDetails->getPaymentMethod();
    }
}
