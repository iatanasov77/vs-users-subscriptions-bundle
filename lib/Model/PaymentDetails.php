<?php namespace Vankosoft\UsersSubscriptionsBundle\Model;

use Payum\Core\Model\ArrayObject;

use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PaymentDetailsInterface;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\SubscribedUserInterface;


class PaymentDetails extends ArrayObject implements PaymentDetailsInterface
{
    const TYPE_AGREEMENT    = 'agreement';
    const TYPE_PAYMENT      = 'payment';
    
    protected $id;
    
    protected $user;
    
    protected $paymentMethod;
    
    protected $type;
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getUser()
    {
        return $this->user;
    }
    
    public function setUser( SubscribedUserInterface $user ): self
    {
        $this->user = $user;
        
        return $this;
    }
    
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }
    
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }
    
    /*
     * @NOTE Not need i think but see more on Payum\Core\Model\ArrayObject
     */
    public function getDetails()
    {
        return $this->details;
    }
    
    /*
     * @NOTE Not need i think but see more on Payum\Core\Model\ArrayObject
     */
    public function setDetails($details)
    {
        $this->details = $details;
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function setType($type)
    {
        $this->type = $type;
        
        return $this;
    }
}