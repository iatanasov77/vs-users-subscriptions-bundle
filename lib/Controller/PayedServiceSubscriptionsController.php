<?php namespace Vankosoft\UsersSubscriptionsBundle\Controller;

use Vankosoft\ApplicationBundle\Controller\AbstractCrudController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Intl\Currencies;

class PayedServiceSubscriptionsController extends AbstractCrudController
{
    protected function customData( Request $request, $entity = null ): array
    {
        $currencies = [];
        
        if ( $this->resources ) {
            foreach ( $this->resources as $subscription ) {
                $currencies[$subscription->getCurrencyCode()]   = [
                    'symbol'    => Currencies::getSymbol( $subscription->getCurrencyCode() ),
                    'name'      => Currencies::getName( $subscription->getCurrencyCode() ),
                ];
            }
        }
        
        return [
            'intlCurrencies'    => $currencies,
        ];
    }
}