<?php

namespace Chargily\ChargilyPay\Validation\Api;

use Chargily\ChargilyPay\Core\Abstracts\Validation;
use Chargily\ChargilyPay\Core\Interfaces\ValidationInterface;

final class PaymentLinkCreateValidation extends Validation implements ValidationInterface
{
    /**
     * Rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "name" => "required|min:1",
            "items" => "required|array",
            "items.*.price" => "required",
            "items.*.quantity" => "required|integer",
            "items.*.adjustable_quantity" => "nullable|boolean",
            "after_completion_message" => "nullable|min:1",
            "pass_fees_to_customer" => "nullable|boolean",
            "locale" => "nullable|min:2|max:2",
            "metadata" => "nullable|array",
        ];
    }
}
