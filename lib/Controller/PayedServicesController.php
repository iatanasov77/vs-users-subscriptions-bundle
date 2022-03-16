<?php namespace Vankosoft\UsersSubscriptionsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Vankosoft\ApplicationBundle\Controller\AbstractCrudController;

class PayedServicesController extends AbstractCrudController
{
    protected function customData( Request $request, $entity = NULL ): array
    {
        $taxonomy   = $this->get( 'vs_application.repository.taxonomy' )->findByCode(
            $this->getParameter( 'vs_users_subscriptions.paid-service-categories.taxonomy_code' )
        );
        
        return [
            'categories'    => $this->get( 'vs_users_subscriptions.repository.payed_service_category' )->findAll(),
            'taxonomyId'    => $taxonomy->getId(),
        ];
    }
    
    protected function prepareEntity( &$entity, &$form, Request $request )
    {
        
    }
}
