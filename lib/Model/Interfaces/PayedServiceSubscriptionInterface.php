<?php namespace Vankosoft\UsersSubscriptionsBundle\Model\Interfaces;

use Sylius\Component\Resource\Model\ResourceInterface;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\SubscriptionInterface;

interface PayedServiceSubscriptionInterface extends ResourceInterface, SubscriptionInterface
{
    public function getPayedService();
}
