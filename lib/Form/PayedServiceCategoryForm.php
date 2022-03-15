<?php namespace Vankosoft\UsersSubscriptionsBundle\Form;

use Vankosoft\ApplicationBundle\Form\AbstractForm;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Vankosoft\ApplicationBundle\Component\I18N;

class PayedServiceCategoryForm extends AbstractForm
{
    protected $requestStack;
    
    public function __construct(
        string $dataClass,
        RequestStack $requestStack
    ) {
        parent::__construct( $dataClass );
        
        $this->requestStack = $requestStack;
    }
    
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        parent::buildForm( $builder, $options );
        
        $entity         = $builder->getData();
        $currentLocale  = $entity->getLocale() ?: $this->requestStack->getCurrentRequest()->getLocale();
        
        $builder
            ->add( 'currentLocale', ChoiceType::class, [
                'choices'               => \array_flip( I18N::LanguagesAvailable() ),
                'data'                  => $currentLocale,
                'mapped'                => false,
                'label'                 => 'vs_users_subscriptions.form.locale',
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
            ])
            ->add( 'name', TextType::class, [
                'label'                 => 'vs_users_subscriptions.form.name',
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
            ])
        ;
    }
    
    public function configureOptions( OptionsResolver $resolver ): void
    {
        parent::configureOptions( $resolver );
    }
    
    public function getName()
    {
        return 'vs_users_subscriptions.payed_service_category';
    }
}
