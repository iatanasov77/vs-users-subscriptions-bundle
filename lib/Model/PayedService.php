<?php namespace Vankosoft\UsersSubscriptionsBundle\Model;

use Sylius\Component\Resource\Model\ToggleableTrait;
use Sylius\Component\Resource\Model\TranslatableTrait;

use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PayedServiceInterface;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PayedServiceSubscriptionPeriodInterface;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PayedServiceCategoryInterface;

class PayedService implements PayedServiceInterface
{
    use ToggleableTrait;
    use TranslatableTrait;

    /** @var integer */
    protected $id;
    
    /**
     * @var PayedServiceCategoryInterface
     */
    protected $category;
    
    /**
     * @var PayedServiceSubscriptionPeriodInterface
     */
    protected $subscriptionPeriods;
    
    /** @var string */
    protected $title;
    
    /** @var string */
    protected $description;
    
    
    
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
     * @return SubscriptionPeriod
     */
    public function getSubscriptionPeriods()
    {
        return $this->subscriptionPeriods;
    }
    
    /**
     * @param SubscriptionPeriod $subscriptionPeriod
     * @return PayedService
     */
    public function setSubscriptionPeriods(SubscriptionPeriod $subscriptionPeriod)
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
    
    public function getTranslatableLocale(): ?string
    {
        return $this->locale;
    }
    
    public function setTranslatableLocale($locale): PageInterface
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
