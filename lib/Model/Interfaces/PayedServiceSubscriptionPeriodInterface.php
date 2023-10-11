<?php namespace Vankosoft\UsersSubscriptionsBundle\Model\Interfaces;

use Sylius\Component\Resource\Model\ResourceInterface;

interface PayedServiceSubscriptionPeriodInterface extends ResourceInterface
{
    public function getSubscriptionPeriod();
    public function getPayedService();
    
    public function getTitle();
    public function getDescription();
}
