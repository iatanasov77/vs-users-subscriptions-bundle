<?php namespace VS\UsersSubscriptionsBundle\Model;

use VS\UsersSubscriptionsBundle\Model\Interfaces\MailchimpAudienceInterface;

class MailchimpAudience implements MailchimpAudienceInterface
{
    /** @var integer */
    protected $id;
    
    /**
     * Relation to the NewsletterSubscription entity
     *
     * @var NewsletterSubscriptionInterface
     */
    protected $newsletterSubscriptions;
    
    /** @var string */
    protected $audienceId;
    
    /** @var string */
    protected $description;
    
    function getId()
    {
        return $this->id;
    }
    
    function getAudienceId()
    {
        return $this->audienceId;
    }
    
    function setAudienceId($audienceId)
    {
        $this->audienceId   = $audienceId;
        
        return $this;
    }
    
    function getDescription()
    {
        return $this->description;
    }
    
    function setDescription($description)
    {
        $this->description  = $description;
        
        return $this;
    }
}

