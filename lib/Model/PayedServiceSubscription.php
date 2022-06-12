<?php namespace Vankosoft\UsersSubscriptionsBundle\Model;

use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PayedServiceSubscriptionInterface;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PayedServiceInterface;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\SubscribedUserInterface;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PayedServiceSubscriptionPeriodInterface;
use Vankosoft\UsersSubscriptionsBundle\Component\PayedService\SubscriptionPeriod;

class PayedServiceSubscription implements PayedServiceSubscriptionInterface
{
    /** @var integer */
    protected $id;

    /**
     * Relation to the PayedServiceSubscriptionPeriod entity
     *
     * @var PayedServiceSubscriptionPeriodInterface
     */
    protected $payedService;
    
    /**
     * Relation to the User entity
     *
     * @var SubscribedUserInterface
     */
    protected $user;
    
    /** @var \DateTimeInterface */
    protected $date;
    
    /** @var string */
    protected $subscriptionCode;
    
    /** @var integer */
    protected $subscriptionPriority;

    public function getId()
    {
        return $this->id;
    }

    public function getPayedService(): PayedServiceSubscriptionPeriodInterface
    {
        return $this->payedService;
    }
    
    public function setPayedService( PayedServiceSubscriptionPeriodInterface $payedService )
    {
        $this->payedService = $payedService;
        
        return $this;
    }
    
    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
        
        return $this;
    }
    
    public function getDate()
    {
        return $this->date;
    }
    
    public function setDate($date)
    {
        $this->date = $date;
        
        return $this;
    }
    
    public function isActive(): bool
    {
        $active     = false;
        $thisDate   = clone $this->date;
        switch( $this->payedService->getSubscriptionPeriod() ) {
            case SubscriptionPeriod::SUBSCRIPTION_PERIOD_YEAR:
                $active = ( $thisDate->add( new \DateInterval( 'P1Y' ) ) ) > ( new \DateTime() );
                break;
            case SubscriptionPeriod::SUBSCRIPTION_PERIOD_MONTH:
                $active = ( $thisDate->add( new \DateInterval( 'P1M' ) ) ) > ( new \DateTime() );
                break;
            case SubscriptionPeriod::SUBSCRIPTION_PERIOD_SEMIMONTH:
                $active = ( $thisDate->add( new \DateInterval( 'P15D' ) ) ) > ( new \DateTime() );
                break;
            case SubscriptionPeriod::SUBSCRIPTION_PERIOD_WEEK:
                $active = ( $thisDate->add( new \DateInterval( 'P1W' ) ) ) > ( new \DateTime() );
                break;
            case SubscriptionPeriod::SUBSCRIPTION_PERIOD_DAY:
                $active = ( $thisDate->add( new \DateInterval( 'P1D' ) ) ) > ( new \DateTime() );
                break;
            default:
                $active = false;
        }
        
        return $active;
    }
    
    public function getExpireAt(): ?\DateTime
    {
        $expireAt   = null;
        $thisDate   = clone $this->date;
        switch( $this->payedService->getSubscriptionPeriod() ) {
            case SubscriptionPeriod::SUBSCRIPTION_PERIOD_YEAR:
                $expireAt   = $thisDate->add( new \DateInterval( 'P1Y' ) );
                break;
            case SubscriptionPeriod::SUBSCRIPTION_PERIOD_MONTH:
                $expireAt   = $thisDate->add( new \DateInterval( 'P1M' ) );
                break;
            case SubscriptionPeriod::SUBSCRIPTION_PERIOD_SEMIMONTH:
                $expireAt   = $thisDate->add( new \DateInterval( 'P15D' ) );
                break;
            case SubscriptionPeriod::SUBSCRIPTION_PERIOD_WEEK:
                $expireAt   = $thisDate->add( new \DateInterval( 'P1W' ) );
                break;
            case SubscriptionPeriod::SUBSCRIPTION_PERIOD_DAY:
                $expireAt   = $thisDate->add( new \DateInterval( 'P1D' ) );
                break;
            default:
                $expireAt   = null;
        }
        
        return $expireAt;
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
}
