<?php namespace VS\UsersSubscriptionsBundle\Model\Interfaces;

use Sylius\Component\Resource\Model\ResourceInterface;
use VS\UsersBundle\Model\SubscriptionInterface;

interface NewsletterSubscriptionInterface extends ResourceInterface, SubscriptionInterface
{
    public function getMailchimpAudience();
}
