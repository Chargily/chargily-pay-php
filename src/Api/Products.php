<?php

namespace Chargily\ChargilyPay\Api;

use Chargily\ChargilyPay\Core\Abstracts\ApiClassesAbstract;
use Chargily\ChargilyPay\Core\Helpers\Carbon;
use Chargily\ChargilyPay\Core\Helpers\Collection;
use Chargily\ChargilyPay\Core\Interfaces\ApiClassesInterface;
use Chargily\ChargilyPay\Core\Traits\GuzzleHttpTrait;
use Chargily\ChargilyPay\Elements\PaginationElement;
use Chargily\ChargilyPay\Elements\ProductElement;
use Chargily\ChargilyPay\Exceptions\InvalidHttpResponse;
use Chargily\ChargilyPay\Exceptions\ValidationException;
use Chargily\ChargilyPay\Relation\ProductHasManyPricesRelation;
use Chargily\ChargilyPay\Validation\Api\ProductCreateValidation;
use Chargily\ChargilyPay\Validation\Api\ProductUpdateValidation;

final class Products extends ApiClassesAbstract implements ApiClassesInterface
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

        $response = $this->__request($this->credentials->test_mode, "GET", "products?{$query}", $headers, $options);

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
     * @return ProductElement|null
     */
    public function create(array $data): ?ProductElement
    {
        $validation = new ProductCreateValidation($data);

        if (!$validation->passed()) {
            ValidationException::message("Product::create", $validation->errors(), 422);
        }
        //
        $headers = [
            "Authorization" => "Bearer {$this->credentials->getAuthorizationToken()}",
        ];
        $options = [];
        $options['json'] = $data;

        $response = $this->__request($this->credentials->test_mode, "POST", "products", $headers, $options);

        $status_code = $response->getStatusCode();
        $content = $response->getBody()->getContents();
        $content_array = json_decode($content, true);

        if ($status_code === 200) {
            return $this->newElement($content_array);
        } elseif ($status_code === 422) {
            ValidationException::message("Product::create", $content_array['errors'] ?? [], 422);
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
     * @return ProductElement|null
     */
    public function update(string $id, array $data): ?ProductElement
    {
        $validation = new ProductUpdateValidation($data);

        if (!$validation->passed()) {
            ValidationException::message("Product::update", $validation->errors(), 422);
        }
        //
        $headers = [
            "Authorization" => "Bearer {$this->credentials->getAuthorizationToken()}",
        ];
        $options = [];
        $options['json'] = $data;

        $response = $this->__request($this->credentials->test_mode, "POST", "products/{$id}", $headers, $options);

        $status_code = $response->getStatusCode();
        $content = $response->getBody()->getContents();
        $content_array = json_decode($content, true);

        if ($status_code === 200) {
            return $this->newElement($content_array);
        } elseif ($status_code === 422) {
            ValidationException::message("Product::update", $content_array['errors'] ?? [], 422);
        } else {
            InvalidHttpResponse::message($response, 403);
        }

        return null;
    }
    /**
     * Get Item
     *
     * @param string $id
     * @return ProductElement|null
     */
    public function get(string $id): ?ProductElement
    {
        $headers = [
            "Authorization" => "Bearer {$this->credentials->getAuthorizationToken()}",
        ];
        $options = [];

        $response = $this->__request($this->credentials->test_mode, "GET", "products/{$id}", $headers, $options);

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

        $response = $this->__request($this->credentials->test_mode, "DELETE", "products/{$id}", $headers, $options);

        $status_code = $response->getStatusCode();

        if ($status_code === 200) {
            return true;
        }

        return false;
    }
    /**
     * Get item prices
     *
     * @param  string $id product id
     * @return PaginationElement
     */
    public function prices(string $id, $per_page = 10, $page = 1): ?PaginationElement
    {
        $query = http_build_query([
            "per_page" => $per_page,
            "page" => $page,
        ]);

        $headers = [
            "Authorization" => "Bearer {$this->credentials->getAuthorizationToken()}",
        ];
        $options = [];

        $response = $this->__request($this->credentials->test_mode, "GET", "products/{$id}/prices?$query", $headers, $options);

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
     * @return ProductElement
     */
    public function newElement(array $data): ProductElement
    {
        return (new ProductElement())
            ->setId($data['id'])
            ->setName($data['name'])
            ->setDescription($data['description'])
            ->setImages($data['images'])
            ->setMetadata($data['metadata'])
            ->setCreatedAt(Carbon::parse($data['created_at']))
            ->setUpdatedAt(Carbon::parse($data['updated_at']))
            ->attachMethodPrices(new ProductHasManyPricesRelation($this, new Prices($this->credentials), ["id" => $data['id']]));
    }
}
