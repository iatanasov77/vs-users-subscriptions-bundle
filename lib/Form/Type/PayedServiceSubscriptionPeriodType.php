<?php namespace Vankosoft\UsersSubscriptionsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

use Vankosoft\UsersSubscriptionsBundle\Component\PayedService\SubscriptionPeriod;

class PayedServiceSubscriptionPeriodType extends AbstractType
{
    /** @var string */
    protected $dataClass;
    
    /** @var ContainerInterface */
    protected $container;
    
    public function __construct( string $dataClass, ContainerInterface $container )
    {
        $this->dataClass    = $dataClass;
        
        $this->container    = $container;
    }
    
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $builder
            ->add( 'id', HiddenType::class, ['mapped' => false] )
            
            ->add( 'title', TextType::class, [
                'required'              => true,
                'attr'                  => ['placeholder'   => 'vs_users_subscriptions.template.title'],
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
            ])
            ->add( 'subscriptionPeriod', ChoiceType::class, [
                'required'              => true,
                'choices'               => \array_flip( SubscriptionPeriod::periods() ),
                'placeholder'           => 'vs_users_subscriptions.form.subscription_period_placeholder',
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
            ])
            ->add( 'price', NumberType::class, [
                'required'              => true,
                'attr'                  => ['placeholder'   => 'vs_payment.form.price'],
                'translation_domain'    => 'VSPaymentBundle',
            ])
        ;
        
        $installedBundles   = $this->container->getParameter( 'kernel.bundles' );
        if ( \array_key_exists( 'VSPaymentBundle', $installedBundles ) ) {
            $builder->add( 'currencyCode', EntityType::class, [
                'label'                 => 'vs_payment.form.currency_label',
                'required'              => true,
                'class'                 => $this->container->getParameter( 'vs_payment.model.currency.class' ),
                'choice_label'          => 'code',
                'placeholder'           => 'vs_payment.form.currency_placeholder',
                'translation_domain'    => 'VSPaymentBundle',
            ]);
        } else {
            $builder->add( 'currencyCode', ChoiceType::class, [
                'required'              => true,
                'choices'               => \array_flip( SubscriptionPeriod::currencies() ),
                'placeholder'           => 'vs_users_subscriptions.form.currency_placeholder',
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
            ]);
        }
    }
    
    public function configureOptions( OptionsResolver $resolver )
    {
        $resolver->setDefaults([
            'data_class' => $this->dataClass
        ]);
    }
    
    public function getName()
    {
        return 'PayedServiceSubscriptionPeriodField';
    }
}
