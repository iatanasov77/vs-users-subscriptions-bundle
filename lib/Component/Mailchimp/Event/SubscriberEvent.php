<?php namespace Vankosoft\UsersSubscriptionsBundle\Component\Mailchimp\Event;

use Symfony\Contracts\EventDispatcher\Event;
use Vankosoft\UsersSubscriptionsBundle\Component\Mailchimp\Subscriber\Subscriber;

/**
 * Event for User unit sync
 */
class SubscriberEvent extends Event
{
    /**
     * Event to subscribe a User
     * @var string
     */
    const EVENT_SUBSCRIBE = 'vs_users_subscriptions.mailchimp.subscribe';

    /**
     * Event to unsubscribe a User
     * @var string
     */
    const EVENT_UNSUBSCRIBE = 'vs_users_subscriptions.mailchimp.unsubscribe';

    /**
     * Event to pending a User
     * @var string
     */
    const EVENT_PENDING = 'vs_users_subscriptions.mailchimp.pending';

    /**
     * Event to clean a User
     * @var string
     */
    const EVENT_CLEAN = 'vs_users_subscriptions.mailchimp.clean';

    /**
     * Event to update a User
     * @var string
     */
    const EVENT_UPDATE = 'vs_users_subscriptions.mailchimp.update';

    /**
     * Event to change email of a User
     * @var string
     */
    const EVENT_CHANGE_EMAIL = 'vs_users_subscriptions.mailchimp.change_email';

    /**
     * Event to delete a User
     * @var string
     */
    const EVENT_DELETE = 'vs_users_subscriptions.mailchimp.delete';

    /**
     * MailChimp ListId
     * @var string
     */
    protected $listId;

    /**
     * User as Subscriber
     * @var Subscriber
     */
    protected $subscriber;

    /**
     * Subscriber's oldEmail (used for EVENT_CHANGE_EMAIL)
     * @var string
     */
    protected $oldEmail;

    /**
     *
     * @param string     $listId
     * @param Subscriber $subscriber
     * @param string     $oldEmail
     */
    public function __construct($listId, Subscriber $subscriber, $oldEmail = null)
    {
        $this->listId = $listId;
        $this->subscriber = $subscriber;
        $this->oldEmail = $oldEmail;
    }

    /**
     * Get MailChimp listId
     * @return string
     */
    public function getListId()
    {
        return $this->listId;
    }

    /**
     * Get the User as Subscriber
     * @return Subscriber
     */
    public function getSubscriber()
    {
        return $this->subscriber;
    }

    /**
     * Get Subscriber's oldEmail (used for EVENT_CHANGE_EMAIL)
     * @return string
     */
    public function getOldEmail()
    {
        return $this->oldEmail;
    }
}
