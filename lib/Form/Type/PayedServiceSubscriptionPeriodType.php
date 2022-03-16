<?php namespace Vankosoft\UsersSubscriptionsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Vankosoft\UsersSubscriptionsBundle\Component\PayedService\SubscriptionPeriod;

class PayedServiceSubscriptionPeriodType extends AbstractType
{
    protected $dataClass;
    
    public function __construct( string $dataClass ) {
        $this->dataClass    = $dataClass;
    }
    
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $builder
            ->add( 'subscriptionPeriod', ChoiceType::class, [
                'required'              => true,
                'choices'               => \array_flip( SubscriptionPeriod::periods() ),
                'placeholder'           => 'vs_users_subscriptions.form.subscription_period_placeholder',
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
            ])
            ->add( 'price', TextType::class, [
                'required'              => true,
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
            ])
            ->add( 'currency', ChoiceType::class, [
                'required'              => true,
                'choices'               => \array_flip( SubscriptionPeriod::currencies() ),
                'placeholder'           => 'vs_users_subscriptions.form.currency_placeholder',
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
            ])
        ;
    }
    
    public function configureOptions( OptionsResolver $resolver )
    {
        $resolver->setDefaults([
            'data_class' => $this->dataClass
        ]);
    }
    
    public function getName()
    {
        return 'FormFieldsetField';
    }
}
