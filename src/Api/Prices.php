<?php

namespace Chargily\ChargilyPay\Api;

use Chargily\ChargilyPay\Core\Abstracts\ApiClassesAbstract;
use Chargily\ChargilyPay\Core\Helpers\Carbon;
use Chargily\ChargilyPay\Core\Helpers\Collection;
use Chargily\ChargilyPay\Core\Helpers\NumFormat;
use Chargily\ChargilyPay\Core\Interfaces\ApiClassesInterface;
use Chargily\ChargilyPay\Core\Traits\GuzzleHttpTrait;
use Chargily\ChargilyPay\Elements\PaginationElement;
use Chargily\ChargilyPay\Elements\PriceElement;
use Chargily\ChargilyPay\Exceptions\InvalidHttpResponse;
use Chargily\ChargilyPay\Exceptions\ValidationException;
use Chargily\ChargilyPay\Validation\Api\PriceCreateValidation;
use Chargily\ChargilyPay\Validation\Api\PriceUpdateValidation;

final class Prices extends ApiClassesAbstract implements ApiClassesInterface
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

        $response = $this->__request($this->credentials->test_mode, "GET", "prices?{$query}", $headers, $options);

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
     * @return PriceElement|null
     */
    public function create(array $data): ?PriceElement
    {
        $validation = new PriceCreateValidation($data);

        if (!$validation->passed()) {
            ValidationException::message("Prices::create", $validation->errors(), 422);
        }
        //
        $headers = [
            "Authorization" => "Bearer {$this->credentials->getAuthorizationToken()}",
        ];
        $options = [];
        $options['json'] = $data;

        $response = $this->__request($this->credentials->test_mode, "POST", "prices", $headers, $options);

        $status_code = $response->getStatusCode();
        $content = $response->getBody()->getContents();
        $content_array = json_decode($content, true);

        if ($status_code === 200) {
            return $this->newElement($content_array);
        } elseif ($status_code === 422) {
            ValidationException::message("Prices::create", $content_array['errors'] ?? [], 422);
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
     * @return PriceElement|null
     */
    public function update(string $id, array $data): ?PriceElement
    {
        $validation = new PriceUpdateValidation($data);

        if (!$validation->passed()) {
            ValidationException::message("Prices::update", $validation->errors(), 422);
        }
        //
        $headers = [
            "Authorization" => "Bearer {$this->credentials->getAuthorizationToken()}",
        ];
        $options = [];
        $options['json'] = $data;

        $response = $this->__request($this->credentials->test_mode, "POST", "prices/{$id}", $headers, $options);

        $status_code = $response->getStatusCode();
        $content = $response->getBody()->getContents();
        $content_array = json_decode($content, true);

        if ($status_code === 200) {
            return $this->newElement($content_array);
        } elseif ($status_code === 422) {
            ValidationException::message("Prices::update", $content_array['errors'] ?? [], 422);
        } else {
            InvalidHttpResponse::message($response, 403);
        }

        return null;
    }
    /**
     * Get Item
     *
     * @param string $id
     * @return PriceElement|null
     */
    public function get(string $id): ?PriceElement
    {
        $headers = [
            "Authorization" => "Bearer {$this->credentials->getAuthorizationToken()}",
        ];
        $options = [];

        $response = $this->__request($this->credentials->test_mode, "GET", "prices/{$id}", $headers, $options);

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
     * Create new Element
     *
     * @param array $data
     * @return PriceElement
     */
    public function newElement(array $data): PriceElement
    {
        return (new PriceElement())
            ->setId($data['id'])
            ->setProductId($data['product_id'])
            ->setAmount(NumFormat::parse($data['amount'], 2))
            ->setCurrency($data['currency'])
            ->setMetadata($data['metadata'])
            ->setCreatedAt(Carbon::parse($data['created_at']))
            ->setUpdatedAt(Carbon::parse($data['updated_at']));
    }
}
