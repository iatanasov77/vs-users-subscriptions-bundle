<?php namespace Vankosoft\UsersSubscriptionsBundle\Model\Interfaces;

use Sylius\Component\Resource\Model\ResourceInterface;

interface PayedServiceInterface extends ResourceInterface
{
    public function getDescription();
    public function getPrice();
    public function getCurrency();
}
