<?php namespace Vankosoft\UsersSubscriptionsBundle\Model\Traits;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\SubscriptionInterface;

trait SubscribedUserTrait
{
    /**
     * @var Collection|SubscriptionInterface[]
     */
    protected $subscriptions;
    
    /**
     * @return Collection|SubscriptionInterface[]
     */
    public function getSubscriptions(): Collection
    {
        return $this->subscriptions;
    }
    
    public function setSubscriptions( Collection $subscriptions ): self
    {
        $this->subscriptions  = $subscriptions;
        
        return $this;
    }
    
    public function addSubscription( SubscriptionInterface $subscription ): self
    {
        if ( ! $this->subscriptions->contains( $subscription ) ) {
            $this->subscriptions[]    = $subscription;
        }
        
        return $this;
    }
    
    public function removeSubscription( SubscriptionInterface $subscription ): self
    {
        if ( $this->subscriptions->contains( $subscription ) ) {
            $this->subscriptions->removeElement( $subscription );
        }
        
        return $this;
    }
}
