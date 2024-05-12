<?php namespace Vankosoft\UsersSubscriptionsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Gregwar\CaptchaBundle\Type\CaptchaType;

class NewsletterSubscriptionForm extends AbstractType
{
    public function buildForm( FormBuilderInterface $builder, array $options ): void
    {
        $builder
            ->add( 'tags', HiddenType::class, [
                'data' => 'VankoSoft_Site',
            ])
            
            ->add( 'email', EmailType::class, [
                'constraints'           => [
                    new NotBlank([
                        'message' => 'vankosoft_org.form.newsletter_subscription.email_validation_message',
                    ]),
                ],
                'label'                 => 'vankosoft_org.form.newsletter_subscription.email',
                'attr'                  => [
                    'placeholder' => 'vankosoft_org.form.newsletter_subscription.email_placeholder',
                ],
                'translation_domain'    => 'VankoSoftOrg',
            ])

            ->add( 'btnSave', SubmitType::class, [
                'label'                 => 'vankosoft_org.form.newsletter_subscription.submit',
                'translation_domain'    => 'VankoSoftOrg',
            ])
            
            ->add( 'captcha', CaptchaType::class, [
                'width' => 100,
                'height' => 40,
                'length' => 5,
            ])
        ;
    }
}
