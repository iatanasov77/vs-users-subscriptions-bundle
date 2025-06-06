<?php namespace Vankosoft\UsersSubscriptionsBundle\Model\Traits;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\SubscriptionInterface;

trait SubscribedUserEntity
{
    /** @var Collection|SubscriptionInterface[] */
    #[ORM\OneToMany(targetEntity: "Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\NewsletterSubscriptionInterface", mappedBy: "user", cascade: ["persist", "remove"], orphanRemoval: true)]
    protected $newsletterSubscriptions;
    
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
}
