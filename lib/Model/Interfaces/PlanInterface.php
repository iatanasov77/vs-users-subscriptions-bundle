<?php namespace VS\UsersSubscriptionsBundle\Model\Interfaces;

use Sylius\Component\Resource\Model\ResourceInterface;

interface PlanInterface extends ResourceInterface
{
    public function getTitle();
    public function getPlans();
    public function getSubscriptionPeriod();
}
