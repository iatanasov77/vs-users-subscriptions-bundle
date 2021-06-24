<?php namespace VS\UsersSubscriptionsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Component\Resource\Factory\Factory;

use VS\UsersSubscriptionsBundle\Controller\MailchimpAudienceController;
use VS\UsersSubscriptionsBundle\Model\Interfaces\MailchimpAudienceInterface;
use VS\UsersSubscriptionsBundle\Model\MailchimpAudience;
use VS\UsersSubscriptionsBundle\Form\MailchimpAudienceForm;

//use VS\UsersSubscriptionsBundle\Controller\SubscriptionController;
use VS\UsersSubscriptionsBundle\Model\Interfaces\NewsletterSubscriptionInterface;
use VS\UsersSubscriptionsBundle\Model\NewsletterSubscription;
use VS\UsersSubscriptionsBundle\Form\NewsletterSubscriptionForm;

use VS\UsersSubscriptionsBundle\Model\PaymentPlanSubscription;
use VS\UsersSubscriptionsBundle\Model\Interfaces\PaymentPlanSubscriptionInterface;
use VS\UsersSubscriptionsBundle\Repository\PaymentPlanSubscriptionRepository;

use VS\UsersSubscriptionsBundle\Model\PackagePlan;
use VS\UsersSubscriptionsBundle\Model\Interfaces\PackagePlanInterface;

use VS\UsersSubscriptionsBundle\Model\Package;
use VS\UsersSubscriptionsBundle\Model\Interfaces\PackageInterface;

use VS\UsersSubscriptionsBundle\Model\Plan;
use VS\UsersSubscriptionsBundle\Model\Interfaces\PlanInterface;

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
                        ->arrayNode( 'payment_plan_subscriptions' )
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode( 'options' )->end()
                                ->arrayNode( 'classes' )
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode( 'model' )->defaultValue( PaymentPlanSubscription::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'interface' )->defaultValue( PaymentPlanSubscriptionInterface::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'repository' )->defaultValue( PaymentPlanSubscriptionRepository::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'factory' )->defaultValue( Factory::class )->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode( 'package_plan' )
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode( 'options' )->end()
                                ->arrayNode( 'classes' )
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode( 'model' )->defaultValue( PackagePlan::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'interface' )->defaultValue( PackagePlanInterface::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'repository' )->defaultValue( EntityRepository::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'factory' )->defaultValue( Factory::class )->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode( 'package' )
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode( 'options' )->end()
                                ->arrayNode( 'classes' )
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode( 'model' )->defaultValue( Package::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'interface' )->defaultValue( PackageInterface::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'repository' )->defaultValue( EntityRepository::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'factory' )->defaultValue( Factory::class )->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode( 'plan' )
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode( 'options' )->end()
                                ->arrayNode( 'classes' )
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode( 'model' )->defaultValue( Plan::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'interface' )->defaultValue( PlanInterface::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'repository' )->defaultValue( EntityRepository::class )->cannotBeEmpty()->end()
                                        ->scalarNode( 'factory' )->defaultValue( Factory::class )->cannotBeEmpty()->end()
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
