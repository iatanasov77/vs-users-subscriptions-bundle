<?php namespace Vankosoft\UsersSubscriptionsBundle\Form;

use Vankosoft\ApplicationBundle\Form\AbstractForm;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\RequestStack;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class PayedServiceSubscriptionPeriodForm extends AbstractForm
{
    protected $requestStack;
    
    public function __construct(
        string $dataClass,
        RequestStack $requestStack
    ) {
        parent::__construct( $dataClass );
        
        $this->requestStack = $requestStack;
    }
    
    public function buildForm( FormBuilderInterface $builder, array $options ): void
    {
        parent::buildForm( $builder, $options );
        
        $entity         = $builder->getData();
        $currentLocale  = $entity->getLocale() ?: $this->requestStack->getCurrentRequest()->getLocale();
        
        $builder
            ->add( 'locale', ChoiceType::class, [
                'label'                 => 'vs_users_subscriptions.form.locale',
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
                'choices'               => \array_flip( \Vankosoft\ApplicationBundle\Component\I18N::LanguagesAvailable() ),
                'data'                  => $currentLocale,
                'mapped'                => false,
            ])
            
            ->add( 'title', TextType::class, [
                'label'                 => 'vs_users_subscriptions.template.title',
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
                'required'              => false
            ])
            
            ->add( 'description', CKEditorType::class, [
                'label'                 => 'vs_users_subscriptions.form.description',
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
                'required'              => false,
                'config'                => [
                    'uiColor'                           => $options['ckeditor_uiColor'],
                    'extraAllowedContent'               => $options['ckeditor_extraAllowedContent'],
                    
                    'toolbar'                           => $options['ckeditor_toolbar'],
                    'extraPlugins'                      => array_map( 'trim', explode( ',', $options['ckeditor_extraPlugins'] ) ),
                    'removeButtons'                     => $options['ckeditor_removeButtons'],
                ],
            ])
        ;
    }
    
    public function configureOptions( OptionsResolver $resolver ): void
    {
        parent::configureOptions( $resolver );
        
        $resolver
            ->setDefaults([
                'csrf_protection'   => false,
                
                // CKEditor Options
                'ckeditor_uiColor'              => '#ffffff',
                'ckeditor_extraAllowedContent'  => '*[*]{*}(*)',
                
                'ckeditor_toolbar'              => 'full',
                'ckeditor_extraPlugins'         => '',
                'ckeditor_removeButtons'        => ''
            ])
        
            ->setDefined([
                // CKEditor Options
                'ckeditor_uiColor',
                'ckeditor_extraAllowedContent',
                'ckeditor_toolbar',
                'ckeditor_extraPlugins',
                'ckeditor_removeButtons',
            ])
            
            ->setAllowedTypes( 'ckeditor_uiColor', 'string' )
            ->setAllowedTypes( 'ckeditor_extraAllowedContent', 'string' )
            ->setAllowedTypes( 'ckeditor_toolbar', 'string' )
            ->setAllowedTypes( 'ckeditor_extraPlugins', 'string' )
            ->setAllowedTypes( 'ckeditor_removeButtons', 'string' )
        ;
    }
    
    public function getName()
    {
        return 'vs_users_subscriptions.payed_service_subscription_period';
    }
}
