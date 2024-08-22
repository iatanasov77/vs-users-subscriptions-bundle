<?php namespace Vankosoft\UsersSubscriptionsBundle\Model\Interfaces;

use Vankosoft\UsersBundle\Model\Interfaces\UserInterface;
use Doctrine\Common\Collections\Collection;

interface SubscribedUserInterface extends UserInterface
{
    public function getNewsletterSubscriptions(): Collection;
}
