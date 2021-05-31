<?php namespace VS\UsersSubscriptionsBundle\Model\Interfaces;

use Sylius\Component\Resource\Model\ResourceInterface;

interface PackageInterface extends ResourceInterface
{
    public function getTitle();
    public function getPlans();
}
