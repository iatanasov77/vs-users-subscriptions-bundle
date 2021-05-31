<?php namespace VS\UsersSubscriptionsBundle\Model\Interfaces;

interface CheckoutOrderInterface
{
    public function getPrice();
    
    public function getDescription();
    
    public function getCurrency();
    
    public function getBillingPeriod();
    
    public function getBillingFrequency();
}
    
