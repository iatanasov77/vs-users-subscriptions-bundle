<?php namespace Vankosoft\UsersSubscriptionsBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Resource\Model\ToggleableTrait;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Sylius\Component\Resource\Model\TranslationInterface;

use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PayedServiceInterface;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PayedServiceSubscriptionPeriodInterface;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PayedServiceCategoryInterface;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PayedServiceAttributeInterface;

class PayedService implements PayedServiceInterface
{
    use ToggleableTrait;
    use TranslatableTrait;

    /** @var integer */
    protected $id;
    
    /** @var string */
    protected $locale;
    
    /**
     * @var PayedServiceCategoryInterface
     */
    protected $category;
    
    /**
     * @var Collection|PayedServiceSubscriptionPeriodInterface[]
     */
    protected $subscriptionPeriods;
    
    /** @var string */
    protected $title;
    
    /** @var string */
    protected $description;
    
    /** @var string */
    protected $subscriptionCode;
    
    /** @var integer */
    protected $subscriptionPriority;
    
    /**
     * @var PayedServiceAttributeInterface
     */
    protected $attributes;
    
    public function __construct()
    {
        $this->subscriptionPeriods  = new ArrayCollection();
        $this->subscriptionPriority = 0;
        $this->attributes           = new ArrayCollection();
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getCategory()
    {
        return $this->category;
    }
    
    public function setCategory( PayedServiceCategoryInterface $category ): self
    {
        $this->category = $category;
        
        return $this;
    }
    
    /**
     * @return Collection|PayedServiceSubscriptionPeriodInterface[]
     */
    public function getSubscriptionPeriods()
    {
        return $this->subscriptionPeriods;
    }
    
    public function addSubscriptionPeriod( PayedServiceSubscriptionPeriodInterface $subscriptionPeriod )
    {
        if( ! $this->subscriptionPeriods->contains( $subscriptionPeriod ) ) {
            $this->subscriptionPeriods->add( $subscriptionPeriod );
            $subscriptionPeriod->setPayedService( $this );
            
        }
    }
    
    public function removeSubscriptionPeriod( PayedServiceSubscriptionPeriodInterface $subscriptionPeriod )
    {
        if( $this->subscriptionPeriods->contains( $subscriptionPeriod ) ) {
            $this->subscriptionPeriods->removeElement( $subscriptionPeriod );
            $subscriptionPeriod->setPayedService( null );
        }
    }
    
    /**
     * @param SubscriptionPeriod $subscriptionPeriod
     * @return PayedService
     */
    public function setSubscriptionPeriods(Collection $subscriptionPeriods)
    {
        $this->subscriptionPeriods = $subscriptionPeriods;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }
    
    public function setTitle($title)
    {
        $this->title = $title;
        
        return $this;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function setDescription($description)
    {
        $this->description = $description;
        
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
    
    public function getSubscriptionCode(): ?string
    {
        return $this->subscriptionCode;
    }
    
    public function setSubscriptionCode($subscriptionCode): self
    {
        $this->subscriptionCode = $subscriptionCode;
        
        return $this;
    }
    
    public function getSubscriptionPriority(): ?int
    {
        return $this->subscriptionPriority;
    }
    
    public function setSubscriptionPriority($subscriptionPriority): self
    {
        $this->subscriptionPriority = $subscriptionPriority;
        
        return $this;
    }

    public function getAttribute( string $name)
    {
        return $this->attributes[$name];
    }
    
    /**
     * @return Collection|PayedServiceAttributeInterface[]
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
    
    public function addAttribute( PayedServiceAttributeInterface $attribute )
    {
        if( ! $this->attributes->contains( $attribute ) ) {
            $this->attributes->add( $attribute );
            $attribute->setPayedService( $this );
        }
    }
    
    public function removeAttribute( PayedServiceAttributeInterface $attribute )
    {
        if( $this->attributes->contains( $attribute ) ) {
            $this->attributes->removeElement( $attribute );
            $attribute->setPayedService( null );
        }
    }
    
    /**
     * @param SubscriptionPeriod $subscriptionPeriod
     * @return PayedService
     */
    public function setAttributes(Collection $attributes)
    {
        $this->attributes = $attributes;
        
        return $this;
    }
    
    /*
     * @NOTE: Decalared abstract in TranslatableTrait
     */
    protected function createTranslation(): TranslationInterface
    {
        
    }
}
