<?php namespace VS\UsersSubscriptionsBundle\Model\Interfaces;

use Sylius\Component\Resource\Model\ResourceInterface;

interface PackagePlanInterface extends ResourceInterface
{
    public function getPrice();
    public function getCurrency();
}
