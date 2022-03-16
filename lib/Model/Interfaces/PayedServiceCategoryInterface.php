<?php namespace Vankosoft\UsersSubscriptionsBundle\Model\Interfaces;

use Sylius\Component\Resource\Model\ResourceInterface;

interface PayedServiceCategoryInterface extends ResourceInterface
{
    public function getName();
    public function getServices();
}
