<?php namespace Vankosoft\UsersSubscriptionsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Vankosoft\UsersBundle\Entity\UserActivity;
use Vankosoft\UsersSubscriptionsBundle\Entity\PlanSubscription;
use Vankosoft\UsersSubscriptionsBundle\Entity\PackagePlan;

class PayedServiceSubscriptionController extends AbstractController
{
    public function subscribeAction( $planId, Request $request )
    {
        return $this->redirect($this->generateUrl('a_payment_paypal_express_checkout_prepare_recurring_payment_agreement', array(
            'planId' => $planId,
        )));
    }
    
    public function createAction( $paymentId, Request $request )
    {
        $pdr = $this->getDoctrine()->getRepository( Payment::class );
        $paymentDetails = $pdr->find($paymentId);
        if(!$paymentDetails) {
            throw new Exception('Error with payment.');
        }
        
        $subscription = new UserSubscription();
        $subscription->setPaymentDetails($paymentDetails);
        $subscription->setDate( new \DateTime() );
        $subscription->setPlan( $this->getDoctrine()->getRepository( PackagePlan::class )->find( $paymentId ) );
        
        $activity   = new UserActivity();
        $activity->setUser( $this->getUser() );
        $activity->setDate( new \DateTime() );
        $activity->setActivity(
            sprintf( 'User subscribed to the "%s". Payed with "%s"',
                $paymentDetails->getPackagePlan()->getDescription(),
                $paymentDetails->getPaymentMethod()
                )
            );
        
        $user = $this->getUser();
        $user->setSubscription( $subscription );
        
        $em = $this->getDoctrine()->getManager();
        $em->persist( $subscription );
        $em->persist( $activity );
        $em->flush();
        
        return $this->redirect($this->generateUrl('ia_users_profile_show'));
    }
    
    public function cancelAction( $subscriptionId, Request $request )
    {
        
    }
}
