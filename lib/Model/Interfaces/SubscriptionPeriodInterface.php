<?php namespace Vankosoft\UsersSubscriptionsBundle\Model\Interfaces;

use Sylius\Component\Resource\Model\ResourceInterface;

interface SubscriptionPeriodInterface extends ResourceInterface
{
    public function getTitle();
    public function getSubscriptionPeriod();
}
