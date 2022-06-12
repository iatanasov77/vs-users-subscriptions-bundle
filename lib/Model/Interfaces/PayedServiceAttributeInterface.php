<?php namespace Vankosoft\UsersSubscriptionsBundle\Model\Interfaces;

use Sylius\Component\Resource\Model\ResourceInterface;

interface PayedServiceAttributeInterface extends ResourceInterface
{
    public function getPayedService();
    public function getName(): string;
    public function getValue(): string;
}
