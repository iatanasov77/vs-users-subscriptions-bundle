<?php namespace VS\UsersSubscriptionsBundle\Controller;

use VS\ApplicationBundle\Controller\AbstractCrudController;
use Symfony\Component\HttpFoundation\Request;

class MailchimpAudienceController extends AbstractCrudController
{
    protected function prepareEntity( &$entity, &$form, Request $request )
    {
        $entity->setPreferedLocale( $request->getLocale() );
    }
}