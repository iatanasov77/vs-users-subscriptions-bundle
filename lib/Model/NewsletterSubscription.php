<?php namespace VS\UsersSubscriptionsBundle\Model;

use VS\UsersSubscriptionsBundle\Model\Interfaces\NewsletterSubscriptionInterface;

class NewsletterSubscription implements NewsletterSubscriptionInterface
{
    /** @var integer */
    protected $id;
    
    /**
     * Relation to the User entity
     *
     * @var UserInterface
     */
    protected $user;
    
    /**
     * Relation to the MailchimpAudience entity
     *
     * @var MailchimpListInterface
     */
    protected $mailchimpAudience;
    
    /** @var \DateTimeInterface */
    protected $date;
    
    function getId()
    {
        return $this->id;
    }
    
    function getUser()
    {
        return $this->user;
    }
    
    function setUser($user)
    {
        $this->user = $user;
        
        return $this;
    }
    
    function getMailchimpAudience()
    {
        return $this->mailchimpAudience;
    }
    
    function setMailchimpAudience($mailchimpAudience)
    {
        $this->mailchimpAudience = $mailchimpAudience;
        
        return $this;
    }
    
    function getDate()
    {
        return $this->date;
    }
    
    function setDate($date)
    {
        $this->date = $date;
        
        return $this;
    }
}
