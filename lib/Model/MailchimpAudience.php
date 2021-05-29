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
    
    /** @var string */
    protected $locale;
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getAudienceId()
    {
        return $this->audienceId;
    }
    
    public function setAudienceId($audienceId)
    {
        $this->audienceId   = $audienceId;
        
        return $this;
    }
    
    public function getDescription()
    {
        return $this->description;
    }
    
    public function setDescription($description)
    {
        $this->description  = $description;
        
        return $this;
    }
    
    public function getTranslatableLocale() : ?string
    {
        return $this->locale;
    }
    
    public function setTranslatableLocale($locale) : PageInterface
    {
        $this->locale = $locale;
        
        return $this;
    }
}

