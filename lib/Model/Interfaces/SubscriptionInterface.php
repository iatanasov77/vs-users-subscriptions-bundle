<?php namespace Vankosoft\UsersSubscriptionsBundle\Model\Interfaces;

interface SubscriptionInterface
{
    public function getUser();
    public function getExpiresAt();
}
