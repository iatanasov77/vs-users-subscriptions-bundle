<?php namespace VS\UsersSubscriptionsBundle\Form;

use VS\ApplicationBundle\Form\AbstractForm;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use VS\ApplicationBundle\Component\I18N;

class MailchimpAudienceForm extends AbstractForm
{
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        parent::buildForm( $builder, $options );
        
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
        ;
    }

    public function configureOptions( OptionsResolver $resolver ): void
    {
        parent::configureOptions( $resolver );
    }
    
    public function getName()
    {
        return 'vs_users_subscriptions.mailchimp_audience';
    }
}
