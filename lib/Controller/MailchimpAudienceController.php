<?php namespace Vankosoft\UsersSubscriptionsBundle\Controller;

use Vankosoft\ApplicationBundle\Controller\AbstractCrudController;
use Symfony\Component\HttpFoundation\Request;

class MailchimpAudienceController extends AbstractCrudController
{
    protected function prepareEntity( &$entity, &$form, Request $request )
    {
        //$entity->setPreferedLocale( $request->getLocale() );
        $formPost   = $request->request->get( 'mailchimp_audience_form' );
        if ( isset( $formPost['locale'] ) ) {
            $entity->setTranslatableLocale( $formPost['locale'] );
        }
    }
}
