<?php

namespace Chargily\ChargilyPay\Api;

use Chargily\ChargilyPay\Core\Abstracts\ApiClassesAbstract;
use Chargily\ChargilyPay\Core\Helpers\Carbon;
use Chargily\ChargilyPay\Core\Helpers\Collection;
use Chargily\ChargilyPay\Core\Interfaces\ApiClassesInterface;
use Chargily\ChargilyPay\Core\Traits\GuzzleHttpTrait;
use Chargily\ChargilyPay\Elements\CustomerElement;
use Chargily\ChargilyPay\Elements\PaginationElement;
use Chargily\ChargilyPay\Exceptions\InvalidHttpResponse;
use Chargily\ChargilyPay\Exceptions\ValidationException;
use Chargily\ChargilyPay\Relation\CustomerHasManyCheckoutsRelation;
use Chargily\ChargilyPay\Validation\Api\CustomerCreateValidation;
use Chargily\ChargilyPay\Validation\Api\CustomerUpdateValidation;

final class Customers extends ApiClassesAbstract implements ApiClassesInterface
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

        $response = $this->__request($this->credentials->test_mode, "GET", "customers?{$query}", $headers, $options);

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
     * @return CustomerElement|null
     */
    public function create(array $data): ?CustomerElement
    {
        $validation = new CustomerCreateValidation($data);

        if (!$validation->passed()) {
            ValidationException::message("Customer::create", $validation->errors(), 422);
        }
        //
        $headers = [
            "Authorization" => "Bearer {$this->credentials->getAuthorizationToken()}",
        ];
        $options = [];
        $options['json'] = $data;

        $response = $this->__request($this->credentials->test_mode, "POST", "customers", $headers, $options);

        $status_code = $response->getStatusCode();
        $content = $response->getBody()->getContents();
        $content_array = json_decode($content, true);

        if ($status_code === 200) {
            return $this->newElement($content_array);
        } elseif ($status_code === 422) {
            ValidationException::message("Customer::create", $content_array['errors'] ?? [], 422);
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
     * @return CustomerElement|null
     */
    public function update(string $id, array $data): ?CustomerElement
    {
        $validation = new CustomerUpdateValidation($data);

        if (!$validation->passed()) {
            ValidationException::message("Customer::update", $validation->errors(), 422);
        }
        //
        $headers = [
            "Authorization" => "Bearer {$this->credentials->getAuthorizationToken()}",
        ];
        $options = [];
        $options['json'] = $data;

        $response = $this->__request($this->credentials->test_mode, "POST", "customers/{$id}", $headers, $options);

        $status_code = $response->getStatusCode();
        $content = $response->getBody()->getContents();
        $content_array = json_decode($content, true);

        if ($status_code === 200) {
            return $this->newElement($content_array);
        } elseif ($status_code === 422) {
            ValidationException::message("Customer::update", $content_array['errors'] ?? [], 422);
        } else {
            InvalidHttpResponse::message($response, 403);
        }

        return null;
    }
    /**
     * Get Item
     *
     * @param string $id
     * @return CustomerElement|null
     */
    public function get(string $id): ?CustomerElement
    {
        $headers = [
            "Authorization" => "Bearer {$this->credentials->getAuthorizationToken()}",
        ];
        $options = [];

        $response = $this->__request($this->credentials->test_mode, "GET", "customers/{$id}", $headers, $options);

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
     * Delete Item
     *
     * @param string $id
     * @return boolean
     */
    public function delete(string $id): bool
    {
        $headers = [
            "Authorization" => "Bearer {$this->credentials->getAuthorizationToken()}",
        ];
        $options = [];

        $response = $this->__request($this->credentials->test_mode, "DELETE", "customers/{$id}", $headers, $options);

        $status_code = $response->getStatusCode();

        if ($status_code === 200) {
            return true;
        }

        return false;
    }
    /**
     * Create new Element
     *
     * @param array $data
     * @return CustomerElement
     */
    public function newElement(array $data): CustomerElement
    {
        return (new CustomerElement())
            ->setId($data['id'])
            ->setName($data['name'])
            ->setEmail($data['email'])
            ->setPhone($data['phone'])
            ->setAddress($data['address'])
            ->setMetadata($data['metadata'])
            ->setCreatedAt(Carbon::parse($data['created_at']))
            ->setUpdatedAt(Carbon::parse($data['updated_at']))
            ->attachMethodCheckouts(new CustomerHasManyCheckoutsRelation($this, new Checkouts($this->credentials), ["id" => $data['id']]));
    }
}
