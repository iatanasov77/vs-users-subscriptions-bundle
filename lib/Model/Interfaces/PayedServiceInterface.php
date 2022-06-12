<?php namespace Vankosoft\UsersSubscriptionsBundle\Model\Interfaces;

use Sylius\Component\Resource\Model\ResourceInterface;

interface PayedServiceInterface extends ResourceInterface
{
    public function getTitle();
    public function getDescription();
    public function getCategory();
    public function getSubscriptionPeriods();
    
    public function getAttribute( string $name);
    public function getAttributes();
}
