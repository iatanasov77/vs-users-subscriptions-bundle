<?php namespace Vankosoft\UsersSubscriptionsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Regex;

class PayedServiceAttributeType extends AbstractType
{
    /** @var string */
    protected $dataClass;
    
    public function __construct( string $dataClass ) {
        $this->dataClass    = $dataClass;
    }
    
    public function buildForm( FormBuilderInterface $builder, array $options ): void
    {
        $builder
            ->add( 'name', TextType::class, [
                'required'              => true,
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
                'label'                 => 'vs_users_subscriptions.form.paid_service.attribute_name',
                'attr'                  => [
                    'placeholder'   => 'vs_users_subscriptions.form.paid_service.attribute_name_placeholder',
                ],
                'constraints'           => [
                    new Regex([
                        'pattern' => '/^[a-z0-9-_]+$/i',
                        'message' => "Attribute Name Should Contain Only Alphanumeric Characters and '_' , '-' Symbols.",
                    ]),
                    new Regex([
                        'pattern' => '/^[^0-9].*$/i',
                        'message' => "Attribute Name Cannot Start With Digit.",
                    ])
                ],
            ])
            ->add( 'value', TextType::class, [
                'required'              => true,
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
                'label'                 => 'vs_users_subscriptions.form.paid_service.attribute_value',
                'attr'                  => [
                    'placeholder'   => 'vs_users_subscriptions.form.paid_service.attribute_value_placeholder',
                ],
            ])
        ;
    }
    
    public function configureOptions( OptionsResolver $resolver ): void
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
