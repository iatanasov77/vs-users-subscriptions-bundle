<?php namespace Vankosoft\UsersSubscriptionsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Vankosoft\UsersSubscriptionsBundle\Model\PayedServiceSubscriptionPeriod;

class PayedServiceSubscriptionPeriodType extends AbstractType
{
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $builder
            ->add( 'subscriptionPeriod', ChoiceType::class, [
                'required'              => true,
                'choices'               => [
                    PayedServiceSubscriptionPeriod::SUBSCRIPTION_PERIOD_DAY         => 'vs_users_subscriptions.form.period.day',
                    PayedServiceSubscriptionPeriod::SUBSCRIPTION_PERIOD_WEEK        => 'vs_users_subscriptions.form.period.week',
                    PayedServiceSubscriptionPeriod::SUBSCRIPTION_PERIOD_SEMIMONTH   => 'vs_users_subscriptions.form.period.semimonth',
                    PayedServiceSubscriptionPeriod::SUBSCRIPTION_PERIOD_MONTH       => 'vs_users_subscriptions.form.period.month',
                    PayedServiceSubscriptionPeriod::SUBSCRIPTION_PERIOD_YEAR        => 'vs_users_subscriptions.form.period.year',
                ],
                'placeholder'           => 'vankosoft_org.form.project.attribute_placeholder',
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
            ])
            ->add( 'price', TextType::class, [
                'required'              => true,
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
            ])
            ->add( 'currency', TextType::class, [
                'required'              => true,
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
            ])
        ;
    }
    
    public function configureOptions( OptionsResolver $resolver )
    {
        $resolver->setDefaults(array(
            'data_class' => PayedServiceSubscriptionPeriod::class
        ));
    }
    
    public function getName()
    {
        return 'FormFieldsetField';
    }
}
