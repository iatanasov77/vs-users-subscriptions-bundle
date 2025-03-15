<?php namespace Vankosoft\UsersSubscriptionsBundle\Form;

use Vankosoft\ApplicationBundle\Form\AbstractForm;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\RequestStack;
use Sylius\Resource\Doctrine\Persistence\RepositoryInterface;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use Vankosoft\UsersSubscriptionsBundle\Form\Type\PayedServiceSubscriptionPeriodType;
use Vankosoft\UsersSubscriptionsBundle\Form\Type\PayedServiceAttributeType;

class PayedServiceForm extends AbstractForm
{
    /** @var string */
    protected $categoryClass;
    
    public function __construct(
        string $dataClass,
        RequestStack $requestStack,
        RepositoryInterface $localesRepository
    ) {
        parent::__construct( $dataClass );
        
        $this->requestStack         = $requestStack;
        $this->localesRepository    = $localesRepository;
    }
    
    public function buildForm( FormBuilderInterface $builder, array $options ): void
    {
        parent::buildForm( $builder, $options );
        
        $entity         = $builder->getData();
        $currentLocale  = $entity->getLocale() ?: $this->requestStack->getCurrentRequest()->getLocale();
        
        $builder
            ->add( 'enabled', CheckboxType::class, [
                'label'                 => 'vs_users_subscriptions.form.active',
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
            ])
            
            ->add( 'locale', ChoiceType::class, [
                'label'                 => 'vs_users_subscriptions.form.locale',
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
                'choices'               => \array_flip( $this->fillLocaleChoices() ),
                'data'                  => $currentLocale,
                'mapped'                => false,
            ])
            
            ->add( 'title', TextType::class, [
                'label'                 => 'vs_users_subscriptions.form.name',
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
                'required'              => true
            ])
            
            ->add( 'description', CKEditorType::class, [
                'label'                 => 'vs_users_subscriptions.form.description',
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
                'config'                => [
                    'uiColor'                           => $options['ckeditor_uiColor'],
                    'extraAllowedContent'               => $options['ckeditor_extraAllowedContent'],
                    
                    'toolbar'                           => $options['ckeditor_toolbar'],
                    'extraPlugins'                      => array_map( 'trim', explode( ',', $options['ckeditor_extraPlugins'] ) ),
                    'removeButtons'                     => $options['ckeditor_removeButtons'],
                ],
            ])
            
            ->add( 'subscriptionPeriods', CollectionType::class, [
                'entry_type'   => PayedServiceSubscriptionPeriodType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false
            ])
            
            ->add( 'attributes', CollectionType::class, [
                'entry_type'   => PayedServiceAttributeType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false
            ])
            
            ->add( 'subscriptionCode', TextType::class, [
                'label'                 => 'vs_users_subscriptions.form.paid_service.subscription_code',
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
                'required'              => true,
                'help'                  => 'vs_users_subscriptions.form.paid_service.subscription_code_help'
            ])
            
            ->add( 'subscriptionPriority', IntegerType::class, [
                'label'                 => 'vs_users_subscriptions.form.paid_service.subscription_priority',
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
                'required'              => true,
                'attr'                  => ['min' => 0, 'max' => 100, 'step' => 1],
                'help'                  => 'vs_users_subscriptions.form.paid_service.subscription_priority_help'
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
        return 'vs_users_subscriptions.payed_service';
    }
}

