<?php namespace VS\UsersSubscriptionsBundle\Component\Mailchimp;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

use Welp\MailchimpBundle\Event\SubscriberEvent;
use Welp\MailchimpBundle\Subscriber\Subscriber;
use Welp\MailchimpBundle\Exception\MailchimpException;
use VS\UsersSubscriptionsBundle\Component\Exception\SubscriberException;

/**
 * 
 * 
 * @author ivan.atanasov
 * @doc https://welpdev.github.io/mailchimp-bundle/usage/
 */
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
            throw new SubscriberException( $e->getMessage() );
            return false;
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
            throw new SubscriberException( $e->getMessage() );
            return false;
        }
        
        return true;
    }
    
    public function update( $audienceId, $email, $fields = [], $options = [] ) : bool
    {
        $subscriber = new Subscriber( $email, $fields, $options );
        
        try {
            $this->dispatcher->dispatch(
                SubscriberEvent::EVENT_UPDATE,
                new SubscriberEvent( $audienceId, $subscriber )
                );
        } catch ( MailchimpException $e ) {
            throw new SubscriberException( $e->getMessage() );
            return false;
        }
        
        return true;
    }
    
    public function delete( $audienceId, $email ) : bool
    {
        $subscriber = new Subscriber( $email );
        
        try {
            $this->dispatcher->dispatch(
                SubscriberEvent::EVENT_DELETE,
                new SubscriberEvent( $audienceId, $subscriber )
                );
        } catch ( MailchimpException $e ) {
            throw new SubscriberException( $e->getMessage() );
            return false;
        }
        
        return true;
    }
    
    // Not Tested
    public function sendCapaign( $campaignId, $tags = [] ) : bool
    {
        $MailChimp  = $this->container->get( 'welp_mailchimp.mailchimp_master' );
        $result     = $MailChimp->post( "campaigns/{$campaignId}/actions/send", [
            //'user' => "anystring:{$apikey}",
        ]);
        
        if ( ! $MailChimp->success() ) {
            throw new SubscriberException( $MailChimp->getLastError() );
            return false;
        }
        
        return true;
    }
}
