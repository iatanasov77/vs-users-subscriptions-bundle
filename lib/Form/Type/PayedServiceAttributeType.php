<?php namespace Vankosoft\UsersSubscriptionsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PayedServiceAttributeType extends AbstractType
{
    protected $dataClass;
    
    public function __construct( string $dataClass ) {
        $this->dataClass    = $dataClass;
    }
    
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $builder
            ->add( 'name', TextType::class, [
                'required'              => true,
                'label'                 => 'vs_users_subscriptions.form.paid_service.attribute_name',
                'placeholder'           => 'vs_users_subscriptions.form.paid_service.attribute_name_placeholder',
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
            ])
            ->add( 'value', TextType::class, [
                'required'              => true,
                'label'                 => 'vs_users_subscriptions.form.paid_service.attribute_value',
                'placeholder'           => 'vs_users_subscriptions.form.paid_service.attribute_value_placeholder',
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
        return 'PayedServiceAttributeField';
    }
}
