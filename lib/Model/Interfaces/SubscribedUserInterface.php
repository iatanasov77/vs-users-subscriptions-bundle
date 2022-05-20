<?php namespace Vankosoft\UsersSubscriptionsBundle\Model\Interfaces;

use Symfony\Component\Security\Core\User\UserInterface as BaseUserInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Doctrine\Common\Collections\Collection;

interface SubscribedUserInterface extends BaseUserInterface, ResourceInterface
{
    public function getSubscriptions(): Collection;
}
