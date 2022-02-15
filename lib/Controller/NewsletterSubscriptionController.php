<?php namespace Vankosoft\UsersSubscriptionsBundle\Controller;

use Vankosoft\ApplicationBundle\Controller\AbstractCrudController;
use Symfony\Component\HttpFoundation\Request;

class NewsletterSubscriptionController extends AbstractCrudController
{
    protected function prepareEntity( &$entity, &$form, Request $request )
    {
        $entity->setPreferedLocale( $request->getLocale() );
    }
}
