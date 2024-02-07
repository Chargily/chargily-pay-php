<?php

namespace Chargily\ChargilyPay\Api;

use Chargily\ChargilyPay\Core\Abstracts\ApiClassesAbstract;
use Chargily\ChargilyPay\Core\Helpers\Carbon;
use Chargily\ChargilyPay\Core\Helpers\Str;
use Chargily\ChargilyPay\Core\Interfaces\ApiClassesInterface;
use Chargily\ChargilyPay\Core\Traits\GuzzleHttpTrait;
use Chargily\ChargilyPay\Elements\WebhookElement;

final class Webhook extends ApiClassesAbstract implements ApiClassesInterface
{
    use GuzzleHttpTrait;
    /**
     * get webhook data
     *
     * @return WebhookElement|null
     */
    public function get(): ?WebhookElement
    {
        $headers = getallheaders();
        $signature = isset($headers['signature']) ? $headers['signature'] : "";
        $payload = file_get_contents('php://input');
        $computed = hash_hmac('sha256', $payload, $this->credentials->secret);

        if (hash_equals($signature, $computed)) {
            $event = json_decode($payload, true);

            return $this->newElement($event);
        }
        return null;
    }
    /**
     * Create new Element
     *
     * @param array $data
     * @return WebhookElement
     */
    public function newElement(array $event): WebhookElement
    {
        $event_type = $event['type'];
        $data = null;
        if (Str::startsWith($event_type, "checkout.")) {
            $data = (new Checkouts($this->credentials))->newElement($event['data']);
        }
        return (new WebhookElement())
            ->setId($event['id'])
            ->setType($event['type'])
            ->setData($data)
            ->setCreatedAt(Carbon::parse($event['created_at']))
            ->setUpdatedAt(Carbon::parse($event['updated_at']));
    }
}
