<?php

namespace Chargily\ChargilyPay\Validation\Api;

use Chargily\ChargilyPay\Core\Abstracts\Validation;
use Chargily\ChargilyPay\Core\Interfaces\ValidationInterface;

final class CheckoutCreateValidation extends Validation implements ValidationInterface
{
    /**
     * Rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "collect_shipping_address" => "nullable|boolean",
            "locale" => "nullable|min:2|max:2",
            "description" => "nullable|min:1",
            "customer_id" => "nullable|min:1",
            "failure_url" => "nullable|url",
            "success_url" => "nullable|url",
            "webhook_endpoint" => "nullable|url",
            "metadata" => "nullable|array",
        ];
    }
}
