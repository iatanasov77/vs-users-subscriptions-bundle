<?php namespace VS\UsersSubscriptionsBundle\Model\Interfaces;

use Sylius\Component\Resource\Model\ResourceInterface;

interface NewsletterSubscriptionInterface extends ResourceInterface
{
    public function getName();
    public function getDescription();
}
