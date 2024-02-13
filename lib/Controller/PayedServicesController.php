<?php namespace Vankosoft\UsersSubscriptionsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Vankosoft\ApplicationBundle\Controller\AbstractCrudController;
use Vankosoft\UsersSubscriptionsBundle\Component\Exception\MissingTaxonomyException;

class PayedServicesController extends AbstractCrudController
{
    protected function customData( Request $request, $entity = NULL ): array
    {
        return [
            
        ];
    }
    
    protected function prepareEntity( &$entity, &$form, Request $request )
    {
        $paidServiceSlug    = $this->get( 'vs_application.slug_generator' )->generate( $entity->getTitle() );
        
        foreach ( $entity->getSubscriptionPeriods() as $period ) {
            
            $paidServicePeriodCode  = $paidServiceSlug . '-' . \strtolower( $period->getSubscriptionPeriod() );
            
            $period->setPaidServicePeriodCode( $paidServicePeriodCode );
        }
    }
}
