<?php namespace VS\UsersSubscriptionsBundle\Component\Mailchimp;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

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
    
    public function subscribe( $email, $fields, $options )
    {
        $form   = $this->createForm( NewsletterSubscribeFormType::class );
        
        $form->handleRequest( $request );
        if( $form->isSubmitted() ) {
            $post   = $form->getData();
            
            $subscriber = new Subscriber( $post['email'],
                [
                    'FNAME' => 'UNDEFINED-2',
                    'LNAME' => 'LAST-UNDEFINED-2',
                ],
                [
                    'language' => 'bg',
                    'tags'      => ['VS_SymfonyBlogExample']
                ]
                );
            
            try {
                $dispatcher->dispatch(
                    new SubscriberEvent( self::MAILCHIMP_LIST_ID, $subscriber ),
                    SubscriberEvent::EVENT_SUBSCRIBE
                    );
                
            } catch ( MailchimpException $e ) {
                die( 'MailchimpException: ' . $e->getMessage() );
            }
        }
        
        return $this->redirect( $this->generateUrl( 'app_home' ) );
    }
    
    public function unsubscribe( Request $request ): Response
    {
        $subscriber = new Subscriber( $user->getEmail());
        
        $this->container->get( 'event_dispatcher')->dispatch(
            SubscriberEvent::EVENT_UNSUBSCRIBE,
            new SubscriberEvent( self::MAILCHIMP_LIST_ID, $subscriber )
            );
    }
}
