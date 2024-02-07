<?php

namespace Chargily\ChargilyPay\Validation\Auth;

use Chargily\ChargilyPay\Core\Abstracts\Validation;
use Chargily\ChargilyPay\Core\Interfaces\ValidationInterface;

final class CredentialsValidation extends Validation implements ValidationInterface
{
    /**
     * Rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "mode" => "required|in:test,live",
            "public" => "required|min:16",
            "secret" => "required|min:16",
        ];
    }
}
