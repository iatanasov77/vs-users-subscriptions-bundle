<?php namespace VS\UsersSubscriptionsBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Sylius\Component\Resource\Model\ToggleableTrait;

use VS\UsersSubscriptionsBundle\Model\Interfaces\PackageInterface;
use VS\UsersSubscriptionsBundle\Model\Interfaces\PackagePlanInterface;

class Package implements PackageInterface
{
    use ToggleableTrait;

    /** @var integer */
    protected $id;
    
    /** @var string */
    protected $title;
    
    /**
     * Relation to the PackagePlan entity
     *
     * @var PackagePlanInterface
     */
    protected $plans;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->plans = new ArrayCollection();
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
     * @return Package
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getPlans() 
    {
        return $this->plans->toArray();
    }
    
    public function addPlan(PackagePlan $plan)
    {
        if(!$this->plans->contains($plan)) {
            $plan->setPackage($this);
            $this->plans->add($plan);
        }
        
        return $this;
    }
    
    public function removePlan(PackagePlan $plan)
    {
        if ($this->plans->contains($plan)) {
            $this->plans->removeElement($plan);
        }
        
        return $this;
    }
}
