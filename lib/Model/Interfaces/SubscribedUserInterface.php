<?php namespace Vankosoft\UsersSubscriptionsBundle\Model\Interfaces;

use Symfony\Component\Security\Core\User\UserInterface as BaseUserInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface SubscribedUserInterface extends BaseUserInterface, ResourceInterface
{

}
