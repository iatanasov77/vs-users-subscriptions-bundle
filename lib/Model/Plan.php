<?php namespace VS\UsersSubscriptionsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\ToggleableTrait;

/**
 * Plan
 *
 */
class Plan implements ResourceInterface
{
    use ToggleableTrait;
    
    /** @var integer */
    protected $id;

    /** @var string */
    protected $title;
    
    /** @var string */
    protected $subscriptionPeriod;
    
    /**
     * Relation to the PackagePlan entity
     *
     * @var PackagePlanInterface
     */
    protected $plans;
    
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
     * @return Plan
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

    public function getFields() 
    {
        return $this->packagePlans->toArray();
    }
    
    public function addField(PackagePlan $packagePlan)
    {
        if($packagePlan->getTitle() 
                && !$this->packagePlans->contains($packagePlan)) {
            $packagePlan->setPlan($this);
            $this->packagePlans->add($packagePlan);
        }
        
        return $this;
    }
    
    public function removeField(PackagePlan $packagePlan)
    {
        if ($this->packagePlans->contains($packagePlan)) {
            $this->packagePlans->removeElement($packagePlan);
        }
        
        return $this;
    }
    
    public function getPlans() 
    {
        return $this->plans->toArray();
    }
    
    public function __toString()
    {
        return $this->title;
    }
}
