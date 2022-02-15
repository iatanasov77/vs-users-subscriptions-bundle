<?php namespace Vankosoft\UsersSubscriptionsBundle\Model;

use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\NewsletterSubscriptionInterface;

class NewsletterSubscription implements NewsletterSubscriptionInterface
{
    /** @var integer */
    protected $id;
    
    /**
     * Relation to the User entity
     *
     * @var Interfaces\SubscribedUserInterface
     */
    protected $user;
    
    /**
     * User Email
     *
     * @var string
     */
    protected $userEmail;
    
    /**
     * Relation to the MailchimpAudience entity
     *
     * @var Interfaces\MailchimpAudienceInterface
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
    
    function getUserEmail()
    {
        return $this->userEmail;
    }
    
    function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;
        
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
