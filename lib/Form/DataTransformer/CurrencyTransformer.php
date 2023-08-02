<?php namespace Vankosoft\UsersSubscriptionsBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Sylius\Component\Resource\Repository\RepositoryInterface;

class CurrencyTransformer implements DataTransformerInterface
{
    /** @var RepositoryInterface */
    private $currenciesRepository;
    
    public function __construct( RepositoryInterface $currenciesRepository )
    {
        $this->currenciesRepository = $currenciesRepository;
    }
    
    /**
     * Transforms a string (currencyCode) to an object (Currency).
     *
     * @param  string $currencyCode
     * @throws TransformationFailedException if object (Currency) is not found.
     */
    public function transform( $currencyCode )
    {
        if ( $currencyCode == '' ) {
            return null;
        }
        
        $currency = $this->currenciesRepository->findOneBy( ['code' => $currencyCode] );
        
        if ( null === $currency ) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException( \sprintf( 'A currency with code "%s" does not exist !', $currencyCode ) );
        }
        
        return $currency;
    }
    
    /**
     * Transforms an object (Currency) to a string (currencyCode).
     *
     * @param  Currency|null $issue
     */
    public function reverseTransform( $currency )
    {
        return $currency->getCode();
    }
}