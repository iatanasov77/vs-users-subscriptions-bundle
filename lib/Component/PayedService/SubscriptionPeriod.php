<?php namespace Vankosoft\UsersSubscriptionsBundle\Component\PayedService;

class SubscriptionPeriod
{
    public static function periods()
    {
        return [
            'DAY'       => 'Daily',
            'MOTH'      => 'Monthly',
            'ANNUAL'    => 'Annual',
        ];
    }
}
