<?php namespace Vankosoft\UsersSubscriptionsBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\ToggleableTrait;

/**
 * SubscriptionPeriod
 *
 */
class SubscriptionPeriod implements ResourceInterface
{
    use ToggleableTrait;
    
    /** @var integer */
    protected $id;

    /** @var string */
    protected $title;
    
    /** @var string */
    protected $subscriptionPeriod;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Set title
     *
     * @param string $title
     * @return SubscriptionPeriod
     */
    public function setTitle($title)
    {
        $this->title = $title;

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
    
    public function __toString()
    {
        return $this->title;
    }
}
