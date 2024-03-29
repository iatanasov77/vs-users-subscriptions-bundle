<?php namespace Vankosoft\UsersSubscriptionsBundle\Model\Interfaces;

use Sylius\Component\Resource\Model\ResourceInterface;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\SubscriptionInterface;

interface NewsletterSubscriptionInterface extends ResourceInterface, SubscriptionInterface
{
    public function getMailchimpAudience();
}
