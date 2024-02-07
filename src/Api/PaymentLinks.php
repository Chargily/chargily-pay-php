<?php

namespace Chargily\ChargilyPay\Api;

use Chargily\ChargilyPay\Core\Abstracts\ApiClassesAbstract;
use Chargily\ChargilyPay\Core\Helpers\Carbon;
use Chargily\ChargilyPay\Core\Helpers\Collection;
use Chargily\ChargilyPay\Core\Interfaces\ApiClassesInterface;
use Chargily\ChargilyPay\Core\Traits\GuzzleHttpTrait;
use Chargily\ChargilyPay\Elements\PaginationElement;
use Chargily\ChargilyPay\Elements\PaymentLinkElement;
use Chargily\ChargilyPay\Exceptions\InvalidHttpResponse;
use Chargily\ChargilyPay\Exceptions\ValidationException;
use Chargily\ChargilyPay\Relation\PaymentLinkHasManyPricesRelation;
use Chargily\ChargilyPay\Validation\Api\PaymentLinkCreateValidation;
use Chargily\ChargilyPay\Validation\Api\PaymentLinkUpdateValidation;

final class PaymentLinks extends ApiClassesAbstract implements ApiClassesInterface
{
    use GuzzleHttpTrait;
    /**
     * Get all items
     *
     * @param integer $per_page
     * @param integer $page
     * @return Collection
     */
    public function all($per_page = 10, $page = 1): ?PaginationElement
    {
        $query = http_build_query([
            "per_page" => $per_page,
            "page" => $page,
        ]);
        $headers = [
            "Authorization" => "Bearer {$this->credentials->getAuthorizationToken()}",
        ];
        $options = [];

        $response = $this->__request($this->credentials->test_mode, "GET", "payment-links?{$query}", $headers, $options);

        $status_code = $response->getStatusCode();
        $content = $response->getBody()->getContents();
        $content_array = json_decode($content, true);

        if ($status_code === 200) {
            $collection = new Collection();
            foreach ($content_array['data'] ?? [] as $key => $value) {
                $collection->push($this->newElement($value));
            }
            return new PaginationElement($content_array, $collection);
        }

        return null;
    }
    /**
     * Create item
     *
     * @param array $data
     * @return PaymentLinkElement|null
     */
    public function create(array $data): ?PaymentLinkElement
    {
        $validation = new PaymentLinkCreateValidation($data);

        if (!$validation->passed()) {
            ValidationException::message("PaymentLinks::create", $validation->errors(), 422);
        }
        //
        $headers = [
            "Authorization" => "Bearer {$this->credentials->getAuthorizationToken()}",
        ];
        $options = [];
        $options['json'] = $data;

        $response = $this->__request($this->credentials->test_mode, "POST", "payment-links", $headers, $options);

        $status_code = $response->getStatusCode();
        $content = $response->getBody()->getContents();
        $content_array = json_decode($content, true);

        if ($status_code === 200) {
            return $this->newElement($content_array);
        } elseif ($status_code === 422) {
            ValidationException::message("PaymentLinks::create", $content_array['errors'] ?? [], 422);
        } else {
            InvalidHttpResponse::message($response, 403);
        }

        return null;
    }
    /**
     * Update item
     *
     * @param string $id
     * @param array $data
     * @return PaymentLinkElement|null
     */
    public function update(string $id, array $data): ?PaymentLinkElement
    {
        $validation = new PaymentLinkUpdateValidation($data);

        if (!$validation->passed()) {
            ValidationException::message("PaymentLinks::update", $validation->errors(), 422);
        }
        //
        $headers = [
            "Authorization" => "Bearer {$this->credentials->getAuthorizationToken()}",
        ];
        $options = [];
        $options['json'] = $data;

        $response = $this->__request($this->credentials->test_mode, "POST", "payment-links/{$id}", $headers, $options);

        $status_code = $response->getStatusCode();
        $content = $response->getBody()->getContents();
        $content_array = json_decode($content, true);

        if ($status_code === 200) {
            return $this->newElement($content_array);
        } elseif ($status_code === 422) {
            ValidationException::message("PaymentLinks::update", $content_array['errors'] ?? [], 422);
        } else {
            InvalidHttpResponse::message($response, 403);
        }

        return null;
    }
    /**
     * Get Item
     *
     * @param string $id
     * @return PaymentLinkElement|null
     */
    public function get(string $id): ?PaymentLinkElement
    {
        $headers = [
            "Authorization" => "Bearer {$this->credentials->getAuthorizationToken()}",
        ];
        $options = [];

        $response = $this->__request($this->credentials->test_mode, "GET", "payment-links/{$id}", $headers, $options);

        $status_code = $response->getStatusCode();
        $content = $response->getBody()->getContents();
        $content_array = json_decode($content, true);

        if ($status_code === 200) {
            return $this->newElement($content_array);
        } elseif ($status_code === 404) {
            return null;
        } else {
            InvalidHttpResponse::message($response, 403);
        }

        return null;
    }
    /**
     * Get Item Items
     *
     * @param string $id
     * @param integer $per_page
     * @param integer $page
     * @return PaginationElement|null
     */
    public function prices(string $id, $per_page = 30, $page = 1): ?PaginationElement
    {
        $query = http_build_query([
            "per_page" => $per_page,
            "page" => $page,
        ]);
        $headers = [
            "Authorization" => "Bearer {$this->credentials->getAuthorizationToken()}",
        ];
        $options = [];

        $response = $this->__request($this->credentials->test_mode, "GET", "payment-links/{$id}/items?{$query}", $headers, $options);

        $status_code = $response->getStatusCode();
        $content = $response->getBody()->getContents();
        $content_array = json_decode($content, true);

        if ($status_code === 200) {
            $collection = new Collection();
            foreach ($content_array['data'] ?? [] as $key => $value) {
                $collection->push((new Prices($this->credentials))->newElement($value));
            }
            return new PaginationElement($content_array, $collection);
        }

        return null;
    }
    /**
     * Create new Element
     *
     * @param array $data
     * @return PaymentLinkElement
     */
    public function newElement(array $data): PaymentLinkElement
    {
        return (new PaymentLinkElement())
            ->setId($data['id'])
            ->setName($data['name'])
            ->setActive(boolval($data['active']))
            ->setAfterCompletionMessage($data['after_completion_message'])
            ->setPassFeesToCustomer(boolval($data['pass_fees_to_customer']))
            ->setLocale($data['locale'])
            ->setMetadata($data['metadata'])
            ->setUrl($data['url'] ?? null)
            ->setCreatedAt(Carbon::parse($data['created_at']))
            ->setUpdatedAt(Carbon::parse($data['updated_at']))
            ->attachMethodPrices(new PaymentLinkHasManyPricesRelation($this, new Prices($this->credentials), ["id" => $data['id']]));
    }
}
