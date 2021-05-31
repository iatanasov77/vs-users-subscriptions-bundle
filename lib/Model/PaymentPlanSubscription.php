<?php namespace VS\UsersSubscriptionsBundle\Model;

use VS\UsersSubscriptionsBundle\Model\Interfaces\PaymentPlanSubscriptionInterface;
use VS\UsersBundle\Model\UeserInterface;
use VS\UsersSubscriptionsBundle\Model\Interfaces\PaymentDetailsInterface;

class PaymentPlanSubscription implements PaymentPlanSubscriptionInterface
{
    /** @var integer */
    protected $id;

    /**
     * Relation to the User entity
     *
     * @var UserInterface
     */
    protected $user;

    /**
     * Relation to the PackagePlan entity
     *
     * @var PackagePlanInterface
     */
    protected $plan;

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

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
        
        return $this;
    }
    
    public function getPlan()
    {
        return $this->plan;
    }

    public function setPlan($plan)
    {
        $this->plan = $plan;
        
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
