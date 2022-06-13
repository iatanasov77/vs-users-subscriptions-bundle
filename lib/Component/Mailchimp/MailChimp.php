<?php namespace Vankosoft\UsersSubscriptionsBundle\Component\Mailchimp;

use DrewM\MailChimp\MailChimp as BaseMailChimp;

/**
 * This Wrapper Class Is Used To Can Disable Initialization of The MailChimp API If Not Needed
 */
class MailChimp extends BaseMailChimp
{
    public function __construct( bool $enableMailChimp, string $apiKey, $apiEndpoint = null )
    {
        if ( $enableMailChimp ) {
            parent::__construct( $apiKey, $apiEndpoint );
        }
    }
}
