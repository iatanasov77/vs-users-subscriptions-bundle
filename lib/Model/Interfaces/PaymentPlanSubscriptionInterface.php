<?php namespace VS\UsersSubscriptionsBundle\Model\Interfaces;

use Sylius\Component\Resource\Model\ResourceInterface;
use VS\UsersBundle\Model\SubscriptionInterface;

interface PaymentPlanSubscriptionInterface extends ResourceInterface, SubscriptionInterface
{
    public function getPlan();
    public function getPaymentDetails();
}
