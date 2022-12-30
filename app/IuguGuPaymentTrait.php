<?php
namespace App;

use Potelo\GuPayment\GuPaymentTrait;
use App\IuguSubscriptionBuilder;

trait IuguGuPaymentTrait
{
    use GuPaymentTrait;

    public function newSubscription($subscription, $plan, $additionalData = [], $options = [])
    {
       return new IuguSubscriptionBuilder($this, $subscription, $plan, $additionalData, $options);
    }
}