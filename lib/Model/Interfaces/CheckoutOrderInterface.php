<?php namespace Vankosoft\UsersSubscriptionsBundle\Model\Interfaces;

interface CheckoutOrderInterface
{
    public function getDescription();
    
    public function getPrice();
    
    public function getCurrency();
    
    public function getBillingPeriod();
    
    public function getBillingFrequency();
}
    
