<?php namespace Vankosoft\UsersSubscriptionsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Resource\Factory\Factory;

use Vankosoft\UsersSubscriptionsBundle\Controller\MailchimpAudienceController;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\MailchimpAudienceInterface;
use Vankosoft\UsersSubscriptionsBundle\Model\MailchimpAudience;
use Vankosoft\UsersSubscriptionsBundle\Form\MailchimpAudienceForm;

//use Vankosoft\UsersSubscriptionsBundle\Controller\SubscriptionController;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\NewsletterSubscriptionInterface;
use Vankosoft\UsersSubscriptionsBundle\Model\NewsletterSubscription;
use Vankosoft\UsersSubscriptionsBundle\Form\NewsletterSubscriptionForm;

use Vankosoft\UsersSubscriptionsBundle\Model\PayedService;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PayedServiceInterface;

use Vankosoft\UsersSubscriptionsBundle\Model\PayedServiceSubscription;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PayedServiceSubscriptionInterface;
use Vankosoft\UsersSubscriptionsBundle\Repository\PayedServiceSubscriptionRepository;
use Vankosoft\UsersSubscriptionsBundle\Model\PayedServiceCategory;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PayedServiceCategoryInterface;
use Vankosoft\UsersSubscriptionsBundle\Model\PaymentDetails;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PaymentDetailsInterface;
use Vankosoft\UsersSubscriptionsBundle\Model\PayedServiceSubscriptionPeriod;
use Vankosoft\UsersSubscriptionsBundle\Model\Interfaces\PayedServiceSubscriptionPeriodInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder    = new TreeBuilder( 'vs_users_subscriptions' );
        $rootNode       = $treeBuilder->getRootNode();
        
        $rootNode
            ->children()
                ->scalarNode( 'mailchimp_api_key' )
                    ->isRequired()
                ->end()
                ->scalarNode( 'orm_driver' )
                    ->defaultValue( SyliusResourceBundle::DRIVER_DOCTRINE_ORM )->cannotBeEmpty()
                ->end()
            ->end()
        ;
        $this->addResourcesSection( $rootNode );

        return $treeBuilder;
    }

    private function addResourcesSection( ArrayNodeDefinition $node ): void
    {
        $node
            ->children()
                ->arrayNode( 'resources' )
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode( 'mailchimp_audiences' )
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode( 'options' )->end()
                                ->arrayNode( 'classes' )
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode( 'model' )->defaultValue( MailchimpAudience::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'interface' )->defaultValue( MailchimpAudienceInterface::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'controller' )->defaultValue( MailchimpAudienceController::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'repository' )->defaultValue( EntityRepository::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'factory' )->defaultValue( Factory::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'form' )->defaultValue( MailchimpAudienceForm::class )->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode( 'newsletter_subscriptions' )
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode( 'options' )->end()
                                ->arrayNode( 'classes' )
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode( 'model' )->defaultValue( NewsletterSubscription::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'interface' )->defaultValue( NewsletterSubscriptionInterface::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'repository' )->defaultValue( EntityRepository::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'factory' )->defaultValue( Factory::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'form' )->defaultValue( NewsletterSubscriptionForm::class )->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode( 'payed_service_category' )
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode( 'options' )->end()
                                ->arrayNode( 'classes' )
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode( 'model' )->defaultValue( PayedServiceCategory::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'interface' )->defaultValue( PayedServiceCategoryInterface::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'repository' )->defaultValue( EntityRepository::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'factory' )->defaultValue( Factory::class )->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode( 'payed_service' )
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode( 'options' )->end()
                                ->arrayNode( 'classes' )
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode( 'model' )->defaultValue( PayedService::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'interface' )->defaultValue( PayedServiceInterface::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'repository' )->defaultValue( EntityRepository::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'factory' )->defaultValue( Factory::class )->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode( 'payed_service_subscription_period' )
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode( 'options' )->end()
                                ->arrayNode( 'classes' )
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode( 'model' )->defaultValue( PayedServiceSubscriptionPeriod::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'interface' )->defaultValue( PayedServiceSubscriptionPeriodInterface::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'repository' )->defaultValue( EntityRepository::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'factory' )->defaultValue( Factory::class )->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode( 'payed_service_subscriptions' )
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode( 'options' )->end()
                                ->arrayNode( 'classes' )
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode( 'model' )->defaultValue( PayedServiceSubscription::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'interface' )->defaultValue( PayedServiceSubscriptionInterface::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'repository' )->defaultValue( PayedServiceSubscriptionRepository::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'factory' )->defaultValue( Factory::class )->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode( 'payment_details' )
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode( 'options' )->end()
                                ->arrayNode( 'classes' )
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode( 'model' )->defaultValue( PaymentDetails::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'interface' )->defaultValue( PaymentDetailsInterface::class )->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
