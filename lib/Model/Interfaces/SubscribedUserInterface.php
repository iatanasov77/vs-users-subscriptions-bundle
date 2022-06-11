<?php namespace Vankosoft\UsersSubscriptionsBundle\Model\Interfaces;

use Symfony\Component\Security\Core\User\UserInterface as BaseUserInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Doctrine\Common\Collections\Collection;

interface SubscribedUserInterface extends BaseUserInterface, ResourceInterface
{
    const SUBSCRIPTION_TYPE_NEWSLETTER  = 'newsletter_subscriptions';
    const SUBSCRIPTION_TYPE_PAID        = 'paid_service_subscriptions';
    
    public function getSubscriptions( string $type ): Collection;
}
