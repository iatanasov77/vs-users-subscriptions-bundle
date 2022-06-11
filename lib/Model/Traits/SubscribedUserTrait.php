<?php namespace Vankosoft\UsersSubscriptionsBundle\Model\Traits;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\SubscriptionInterface;

trait SubscribedUserTrait
{
    /**
     * @var Collection|SubscriptionInterface[]
     *
     * @ORM\OneToMany(targetEntity="Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\NewsletterSubscriptionInterface", mappedBy="user")
     */
    protected $newsletterSubscriptions;
    
    /**
     * @var Collection|SubscriptionInterface[]
     * 
     * @ORM\OneToMany(targetEntity="Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PayedServiceSubscriptionInterface", mappedBy="user")
     */
    protected $paidSubscriptions;
    
    /**
     * @return Collection|SubscriptionInterface[]
     */
    public function getSubscriptions( string $type ): Collection
    {
        switch ( $type ) {
            case self::SUBSCRIPTION_TYPE_NEWSLETTER:
                return $this->newsletterSubscriptions;
                break;
            case self::SUBSCRIPTION_TYPE_PAID:
                return $this->paidSubscriptions;
                break;
            default:
                throw new \Exception( 'Undefined Subscription Type !!!' );
        }
    }
    
    /**
     * @return Collection|SubscriptionInterface[]
     */
    public function getNewsletterSubscriptions(): Collection
    {
        return $this->newsletterSubscriptions;
    }
    
    public function setNewsletterSubscriptions( Collection $newsletterSubscriptions ): self
    {
        $this->newsletterSubscriptions  = $newsletterSubscriptions;
        
        return $this;
    }
    
    public function addNewsletterSubscription( SubscriptionInterface $newsletterSubscription ): self
    {
        if ( ! $this->newsletterSubscriptions->contains( $newsletterSubscription ) ) {
            $this->newsletterSubscriptions[]    = $newsletterSubscription;
        }
        
        return $this;
    }
    
    public function removeNewsletterSubscription( SubscriptionInterface $newsletterSubscription ): self
    {
        if ( $this->newsletterSubscriptions->contains( $newsletterSubscription ) ) {
            $this->newsletterSubscriptions->removeElement( $newsletterSubscription );
        }
        
        return $this;
    }
    
    /**
     * @return Collection|SubscriptionInterface[]
     */
    public function getPaidSubscriptions(): Collection
    {
        return $this->paidSubscriptions;
    }
    
    public function setPaidSubscriptions( Collection $paidSubscriptions ): self
    {
        $this->paidSubscriptions  = $paidSubscriptions;
        
        return $this;
    }
    
    public function addPaidSubscription( SubscriptionInterface $paidSubscription ): self
    {
        if ( ! $this->paidSubscriptions->contains( $paidSubscription ) ) {
            $this->paidSubscriptions[]    = $paidSubscription;
        }
        
        return $this;
    }
    
    public function removePaidSubscription( SubscriptionInterface $paidSubscription ): self
    {
        if ( $this->paidSubscriptions->contains( $paidSubscription ) ) {
            $this->paidSubscriptions->removeElement( $paidSubscription );
        }
        
        return $this;
    }
}
