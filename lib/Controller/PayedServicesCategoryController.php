<?php namespace Vankosoft\UsersSubscriptionsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Vankosoft\ApplicationBundle\Controller\AbstractCrudController;
use Vankosoft\ApplicationBundle\Controller\TaxonomyHelperTrait;

use App\Entity\Application\Taxon;

class PayedServicesCategoryController extends AbstractCrudController
{
    use TaxonomyHelperTrait;
    
    protected function prepareEntity( &$entity, &$form, Request $request )
    {
        $translatableLocale = $form['currentLocale']->getData();
        $categoryName       = $form['name']->getData();
        
        $parentGroup        = null;
        $entity->setName( $categoryName );
        
        if ( $entity->getTaxon() ) {
            $entityTaxon    = $entity->getTaxon();
            
            $entityTaxon->setCurrentLocale( $translatableLocale );
            $entityTaxon->setName( $categoryName );
            $entityTaxon->setCode( $this->get( 'vs_application.slug_generator' )->generate( $categoryName ) );
            
            if ( $parentGroup ) {
                $entityTaxon->setParent( $parentGroup->getTaxon() );
            }
        } else {
            $taxonomy   = $this->get( 'vs_application.repository.taxonomy' )->findByCode(
                $this->getParameter( 'vs_users_subscriptions.paid-service-categories.taxonomy_code' )
            );
            
            $entityTaxon    = $this->createTaxon(
                $categoryName,
                $translatableLocale,
                $parentGroup ? $parentGroup->getTaxon() : null,
                $taxonomy->getId()
            );
        }
        
        $entity->setTaxon( $entityTaxon );
        $entity->setParent( $parentGroup );
        
        $this->getDoctrine()->getManager()->persist( $entityTaxon );
    }
    
    protected function customData( Request $request, $entity = NULL ): array
    {
        $taxonomy   = $this->get( 'vs_application.repository.taxonomy' )->findByCode(
            $this->getParameter( 'vs_users_subscriptions.paid-service-categories.taxonomy_code' )
        );
        
        return [
            'taxonomyId'    => $taxonomy->getId()
        ];
    }
}
