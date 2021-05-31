<?php namespace VS\UsersSubscriptionsBundle\Model\Interfaces;

use Sylius\Component\Resource\Model\ResourceInterface;

interface PaymentDetailsInterface extends ResourceInterface
{
    public function getType();
    public function getPaymentMethod();
}
