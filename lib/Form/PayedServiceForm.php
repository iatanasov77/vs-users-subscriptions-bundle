<?php namespace Vankosoft\UsersSubscriptionsBundle\Form;

use Vankosoft\ApplicationBundle\Form\AbstractForm;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Vankosoft\ApplicationBundle\Component\I18N;
use Vankosoft\UsersSubscriptionsBundle\Form\Type\PayedServiceSubscriptionPeriodType;

class PayedServiceForm extends AbstractForm
{
    protected $categoryClass;
    
    protected $requestStack;
    
    public function __construct(
        string $dataClass,
        string $categoryClass,
        RequestStack $requestStack
    ) {
        parent::__construct( $dataClass );
        
        $this->requestStack     = $requestStack;
        $this->categoryClass    = $categoryClass;
    }
    
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        parent::buildForm( $builder, $options );
        
        $entity         = $builder->getData();
        $currentLocale  = $entity->getLocale() ?: $this->requestStack->getCurrentRequest()->getLocale();
        
        $builder
            ->add( 'enabled', CheckboxType::class, [
                'label'                 => 's_users_subscriptions.form.active',
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
            ])
            
            ->add( 'locale', ChoiceType::class, [
                'label'                 => 'vs_users_subscriptions.form.locale',
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
                'choices'               => \array_flip( \Vankosoft\ApplicationBundle\Component\I18N::LanguagesAvailable() ),
                'data'                  => $currentLocale,
                'mapped'                => false,
            ])
            
            ->add( 'category', EntityType::class, [
                'class'                 => $this->categoryClass,
                'choice_label'          => 'name',
                'required'              => true,
                'label'                 => 'vs_users_subscriptions.template.category',
                'placeholder'           => 'vs_users_subscriptions.template.category_placeholder',
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
            ])
            
            ->add( 'title', TextType::class, [
                'label'                 => 'vs_users_subscriptions.form.name',
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
                'required'              => true
            ])
            
            ->add( 'description', TextType::class, [
                'label'                 => 'vs_users_subscriptions.form.description',
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
            ])
            
            ->add( 'subscriptionPeriods', CollectionType::class, [
                'entry_type'   => PayedServiceSubscriptionPeriodType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false
            ])
        ;
    }
    
    public function configureOptions( OptionsResolver $resolver ): void
    {
        parent::configureOptions( $resolver );
    }
    
    public function getName()
    {
        return 'vs_users_subscriptions.payed_service';
    }
}

