<?php

namespace Chargily\ChargilyPay\Api;

use Chargily\ChargilyPay\Core\Abstracts\ApiClassesAbstract;
use Chargily\ChargilyPay\Core\Helpers\Collection;
use Chargily\ChargilyPay\Core\Helpers\Number;
use Chargily\ChargilyPay\Core\Interfaces\ApiClassesInterface;
use Chargily\ChargilyPay\Core\Traits\GuzzleHttpTrait;
use Chargily\ChargilyPay\Elements\WalletElement;
use Chargily\ChargilyPay\Exceptions\InvalidHttpResponse;

final class Balance extends ApiClassesAbstract implements ApiClassesInterface
{
    use GuzzleHttpTrait;
    /**
     * get balance
     *
     * @return Collection
     */
    public function get(): ?Collection
    {
        $headers = [
            "Authorization" => "Bearer {$this->credentials->getAuthorizationToken()}",
        ];
        $options = [];

        $response = $this->__request($this->credentials->test_mode, "GET", "balance", $headers, $options);

        $status_code = $response->getStatusCode();
        $content = $response->getBody()->getContents();
        $content_array = json_decode($content, true);

        if ($status_code === 200) {
            $collection = new Collection();
            foreach ($content_array['wallets'] as $key => $value) {
                $collection->push($this->newElement($value));
            }
            return $collection;
        }

        InvalidHttpResponse::message($response, $status_code);

        return null;
    }
    /**
     * Create new Element
     *
     * @param array $data
     * @return WalletElement
     */
    public function newElement(array $data): WalletElement
    {
        return (new WalletElement())
            ->setBalance(Number::format($data['balance'], 2))
            ->setReadyForPayout(Number::format($data['ready_for_payout'], 2))
            ->setOnHold(Number::format($data['on_hold'], 2))
            ->setCurrency($data['currency']);
    }
}
