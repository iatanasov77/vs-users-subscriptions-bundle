<?php namespace VS\UsersSubscriptionsBundle\Form;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;

use VS\ApplicationBundle\Component\I18N;

class MailchimpAudienceForm extends AbstractResourceType
{
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $builder
            ->add( 'locale', ChoiceType::class, [
                'label'                 => 'vs_users_subscriptions.form.locale',
                'translation_domain'    => 'VSUsersSubscriptionsBundle',
                'choices'               => \array_flip( I18N::LanguagesAvailable() ),
                'data'                  => \Locale::getDefault(),
                'mapped'                => false,
            ])
        
            ->add( 'audienceId', TextType::class, ['label' => 'vs_users_subscriptions.form.audienceId', 'translation_domain' => 'VSUsersSubscriptionsBundle',] )
            ->add( 'description', TextType::class, ['label' => 'vs_users_subscriptions.form.description', 'translation_domain' => 'VSUsersSubscriptionsBundle',] )
                
            ->add( 'btnSave', SubmitType::class, ['label' => 'vs_users_subscriptions.form.save', 'translation_domain' => 'VSUsersSubscriptionsBundle',] )
            ->add( 'btnCancel', ButtonType::class, ['label' => 'vs_users_subscriptions.form.cancel', 'translation_domain' => 'VSUsersSubscriptionsBundle',] )
        ;
    }

    public function configureOptions( OptionsResolver $resolver ): void
    {
        parent::configureOptions( $resolver );
    }

}

