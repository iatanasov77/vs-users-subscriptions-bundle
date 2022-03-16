<?php namespace Vankosoft\UsersSubscriptionsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Vankosoft\UsersSubscriptionsBundle\Component\PayedService\SubscriptionPeriod;
use Vankosoft\UsersSubscriptionsBundle\Model\PayedServiceSubscriptionPeriod;

class PayedServiceSubscriptionPeriodType extends AbstractType
{
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $builder
            ->add( 'subscriptionPeriod', ChoiceType::class, [
                'required'              => true,
                'choices'               => \array_flip( SubscriptionPeriod::periods() ),
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
