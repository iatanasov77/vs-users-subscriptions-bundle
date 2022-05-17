<?php namespace Vankosoft\UsersSubscriptionsBundle\Model\Traits;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

trait SubscribedUserPaymentsTrait
{
    /**
     * @var Collection
     */
    protected $payments;
    
    /**
     * @return Collection
     */
    public function getPayments(): Collection
    {
        return $this->payments;
    }
}
