<?php namespace VS\UsersSubscriptionsBundle\Repository;

use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use VS\UsersBundle\Model\SubscriptionInterface;

class PaymentPlanSubscriptionRepository extends EntityRepository
{
    public function isActive( $subscription )
    {
        if ( ! $subscription instanceof SubscriptionInterface ) {
            return false;
        }
        
        $payment    = $subscription->getPaymentDetails();
        $details    = $payment->getDetails();

        switch ( $payment->getPaymentMethod() ) {
            case 'paypal_express_checkout_recurring_payment':
                $isActive   = $details["STATUS"] === "Active";
                break;
            case 'paypal_express_checkout_NOT_recurring_payment':
                $isActive   = $details["CHECKOUTSTATUS"] === "PaymentActionCompleted";
                break;
            case 'paypal_pro_checkout_credit_card';
                $isActive   = false;
                break;
            case 'stripe':
                $isActive   = $details["status"] === "succeeded";
                break;
            default:
                $isActive   = false;     
        }
        
       return $isActive;    
    }
}
