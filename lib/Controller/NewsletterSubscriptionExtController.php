<?php namespace VS\UsersSubscriptionsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

use VS\UsersSubscriptionsBundle\Component\Mailchimp\Event\SubscriberEvent;
use VS\UsersSubscriptionsBundle\Component\Mailchimp\Subscriber\Subscriber;
use VS\UsersSubscriptionsBundle\Component\Mailchimp\Exception\MailchimpException;

use App\Form\NewsletterSubscribeFormType;


class NewsletterSubscriptionExtController extends Controller
{
    /**
     * @Route("/newsletter/subscribe", name="app_newsletter_subscribe")
     */
    public function subscribe( Request $request, EventDispatcherInterface $dispatcher ): Response
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
    
    /**
     * @Route("/newsletter/unsubscribe", name="app_newsletter_unsubscribe")
     */
    public function unsubscribe( Request $request ): Response
    {
        $subscriber = new Subscriber( $user->getEmail());
        
        $this->container->get( 'event_dispatcher')->dispatch(
            SubscriberEvent::EVENT_UNSUBSCRIBE,
            new SubscriberEvent( self::MAILCHIMP_LIST_ID, $subscriber )
        );
    }
}

