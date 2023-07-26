<?php namespace Vankosoft\UsersSubscriptionsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Vankosoft\ApplicationBundle\Controller\AbstractCrudController;
use Vankosoft\UsersSubscriptionsBundle\Component\Exception\MissingTaxonomyException;

class PayedServicesController extends AbstractCrudController
{
    protected function customData( Request $request, $entity = NULL ): array
    {
        $taxonomy   = $this->get( 'vs_application.repository.taxonomy' )->findByCode(
            $this->getParameter( 'vs_users_subscriptions.paid-service-categories.taxonomy_code' )
        );
        
        if ( ! $taxonomy ) {
            $exceptioMessage = <<<ANYTHING
Missing Taxonomy For Paid Services Categories OR
The Parameter 'vs_users_subscriptions.paid-service-categories.taxonomy_code' has wrong  value. 
The default value for this parameter is 'paid-service-categories'.
ANYTHING; 
            throw new MissingTaxonomyException( $exceptioMessage );    
        }
        
        return [
            'categories'    => $this->get( 'vs_users_subscriptions.repository.payed_service_category' )->findAll(),
            'taxonomyId'    => $taxonomy->getId(),
        ];
    }
    
    protected function prepareEntity( &$entity, &$form, Request $request )
    {
        
    }
}
