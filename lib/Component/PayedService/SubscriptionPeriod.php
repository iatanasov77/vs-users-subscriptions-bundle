<?php namespace Vankosoft\UsersSubscriptionsBundle\Component\PayedService;

class SubscriptionPeriod
{
    const SUBSCRIPTION_PERIOD_DAY           = 'Day';
    
    const SUBSCRIPTION_PERIOD_WEEK          = 'Week';
    
    /**
     * For SemiMonth, billing is done on the 1st and 15th of each month.
     */
    const SUBSCRIPTION_PERIOD_SEMIMONTH     = 'SemiMonth';
    
    const SUBSCRIPTION_PERIOD_MONTH         = 'Month';
    
    const SUBSCRIPTION_PERIOD_QUARTERYEAR   = 'QuarterYear';
    
    const SUBSCRIPTION_PERIOD_HALFYEAR      = 'HalfYear';
    
    const SUBSCRIPTION_PERIOD_YEAR          = 'Year';
    
    const SUBSCRIPTION_PERIOD_UNLIMITED     = 'Unlimited';
    
    const SUBSCRIPTION_PERIOD_CUSTOM        = 'Custom';
    
    public static function periods()
    {
        return [
            self::SUBSCRIPTION_PERIOD_DAY           => 'vs_users_subscriptions.form.period.day',
            self::SUBSCRIPTION_PERIOD_WEEK          => 'vs_users_subscriptions.form.period.week',
            self::SUBSCRIPTION_PERIOD_SEMIMONTH     => 'vs_users_subscriptions.form.period.semimonth',
            self::SUBSCRIPTION_PERIOD_MONTH         => 'vs_users_subscriptions.form.period.month',
            self::SUBSCRIPTION_PERIOD_QUARTERYEAR   => 'vs_users_subscriptions.form.period.quarteryear',
            self::SUBSCRIPTION_PERIOD_HALFYEAR      => 'vs_users_subscriptions.form.period.halfyear',
            self::SUBSCRIPTION_PERIOD_YEAR          => 'vs_users_subscriptions.form.period.year',
            
            self::SUBSCRIPTION_PERIOD_UNLIMITED     =>  'vs_users_subscriptions.form.period.unlimited',
            self::SUBSCRIPTION_PERIOD_CUSTOM        =>  'vs_users_subscriptions.form.period.custom',
        ];
    }
    
    public static function currencies()
    {
        return [
            'USD'   => 'USD',
            'EUR'   => 'EUR',
            'BGN'   => 'BGN',
        ];
    }
}
