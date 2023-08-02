<?php namespace Vankosoft\UsersSubscriptionsBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\ToggleableTrait;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Sylius\Component\Resource\Model\TranslationInterface;

use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PayedServiceSubscriptionInterface;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PayedServiceSubscriptionPeriodInterface;

/**
 * SubscriptionPeriod
 *
 */
class PayedServiceSubscriptionPeriod implements PayedServiceSubscriptionPeriodInterface
{
    use ToggleableTrait;
    use TranslatableTrait;
    
    /** @var integer */
    protected $id;
    
    /** @var string */
    protected $locale;

    /** @var PayedService */
    protected $payedService;
    
    /** @var string */
    protected $subscriptionPeriod;
    
    /** @var float */
    protected $price;
    
    /** @var string */
    protected $currencyCode;
    
    /** @var Collection|PayedServiceSubscriptionInterface[] */
    protected $subscriptions;
    
    /** @var string */
    protected $title;
    
    /** @var string */
    protected $description;
    
    /** @var string */
    protected $paidServicePeriodCode;
    
    public function __construct()
    {
        $this->subscriptions    = new ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    public function getPayedService()
    {
        return $this->payedService;
    }
    
    public function setPayedService($payedService)
    {
        $this->payedService = $payedService;
        
        return $this;
    }
    
    public function getSubscriptionPeriod()
    {
        return $this->subscriptionPeriod;
    }

    public function setSubscriptionPeriod($subscriptionPeriod)
    {
        $this->subscriptionPeriod = $subscriptionPeriod;
        
        return $this;
    }
    
    public function getPrice()
    {
        return $this->price;
    }
    
    public function setPrice($price)
    {
        $this->price = $price;
        
        return $this;
    }
    
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }
    
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;
        
        return $this;
    }
    
    /**
     * @return Collection|PayedServiceSubscriptionInterface[]
     */
    public function getSubscriptions(): Collection
    {
        return $this->subscriptions;
    }
    
    public function addSubscription( PayedServiceSubscriptionInterface $subscription ): self
    {
        if ( ! $this->subscriptions->contains( $subscription ) ) {
            $this->subscriptions[] = $subscription;
            $subscription->setPayedService( $this );
        }
        
        return $this;
    }
    
    public function removeSubscription( PayedServiceSubscriptionInterface $subscription ): self
    {
        if ( $this->subscriptions->contains( $subscription ) ) {
            $this->subscriptions->removeElement( $subscription );
            $subscription->setPayedService( null );
        }
        
        return $this;
    }
    
    public function getTitle()
    {
        if( ! $this->title && ! $this->payedService ) {
            return null;
        }
        
        return $this->title ?: $this->payedService->getTitle();
    }
    
    public function setTitle($title)
    {
        $this->title = $title;
        
        return $this;
    }
    
    public function getDescription()
    {
        if( ! $this->description && ! $this->payedService ) {
            return null;
        }
        
        return $this->description ?: $this->payedService->getDescription();
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
        
        return $this;
    }
    
    public function getPaidServicePeriodCode()
    {
        return $this->paidServicePeriodCode;
    }
    
    public function setPaidServicePeriodCode($paidServicePeriodCode)
    {
        $this->paidServicePeriodCode = $paidServicePeriodCode;
        
        return $this;
    }
    
    public function getLocale()
    {
        return $this->locale;
    }
    
    public function getTranslatableLocale(): ?string
    {
        return $this->locale;
    }
    
    public function setTranslatableLocale($locale): self
    {
        $this->locale = $locale;
        
        return $this;
    }
    
    /*
     * @NOTE: Decalared abstract in TranslatableTrait
     */
    protected function createTranslation(): TranslationInterface
    {
        
    }
}
