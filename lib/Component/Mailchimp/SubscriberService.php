<?php namespace VS\UsersSubscriptionsBundle\Component\Mailchimp;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

use Welp\MailchimpBundle\Event\SubscriberEvent;
use Welp\MailchimpBundle\Subscriber\Subscriber;
use Welp\MailchimpBundle\Exception\MailchimpException;

class SubscriberService
{
    /** @var ContainerInterface */
    protected $container;
    
    /** @var EventDispatcherInterface */
    protected $dispatcher;
    
    public function __construct( ContainerInterface $container, EventDispatcherInterface $dispatcher )
    {
        $this->container    = $container;
        $this->dispatcher   = $dispatcher;
    }
    
    public function subscribe( $audienceId, $email, $fields = [], $options = [] ) : bool
    {
        $subscriber = new Subscriber( $email, $fields, $options );
        
        try {
            $this->dispatcher->dispatch(
                new SubscriberEvent( $audienceId, $subscriber ),
                SubscriberEvent::EVENT_SUBSCRIBE
            );
        } catch ( MailchimpException $e ) {
            die( 'MailchimpException: ' . $e->getMessage() );
        }
        
        return true;
    }
    
    public function unsubscribe( $audienceId, $email ) : bool
    {
        $subscriber = new Subscriber( $email );
        
        try {
            $this->dispatcher->dispatch(
                SubscriberEvent::EVENT_UNSUBSCRIBE,
                new SubscriberEvent( $audienceId, $subscriber )
            );
        } catch ( MailchimpException $e ) {
            die( 'MailchimpException: ' . $e->getMessage() );
        }
        
        return true;
    }
}
