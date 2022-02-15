<?php namespace Vankosoft\UsersSubscriptionsBundle\Model\Interfaces;

use Sylius\Component\Resource\Model\ResourceInterface;

interface MailchimpAudienceInterface extends ResourceInterface
{
    public function getAudienceId();
    public function getDescription();
}
