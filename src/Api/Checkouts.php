<?php

namespace Chargily\ChargilyPay\Api;

use Chargily\ChargilyPay\Core\Abstracts\ApiClassesAbstract;
use Chargily\ChargilyPay\Core\Helpers\Carbon;
use Chargily\ChargilyPay\Core\Helpers\Collection;
use Chargily\ChargilyPay\Core\Interfaces\ApiClassesInterface;
use Chargily\ChargilyPay\Core\Traits\GuzzleHttpTrait;
use Chargily\ChargilyPay\Elements\CheckoutElement;
use Chargily\ChargilyPay\Elements\PaginationElement;
use Chargily\ChargilyPay\Exceptions\InvalidHttpResponse;
use Chargily\ChargilyPay\Exceptions\ValidationException;
use Chargily\ChargilyPay\Relation\CheckoutHasManyPricesRelation;
use Chargily\ChargilyPay\Validation\Api\CheckoutCreateValidation;

final class Checkouts extends ApiClassesAbstract implements ApiClassesInterface
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

        $response = $this->__request($this->credentials->test_mode, "GET", "checkouts?{$query}", $headers, $options);

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
     * @return CheckoutElement|null
     */
    public function create(array $data): ?CheckoutElement
    {
        $validation = new CheckoutCreateValidation($data);

        if (!$validation->passed()) {
            ValidationException::message("Checkout::create", $validation->errors(), 422);
        }
        //
        $headers = [
            "Authorization" => "Bearer {$this->credentials->getAuthorizationToken()}",
        ];
        $options = [];
        $options['json'] = $data;

        $response = $this->__request($this->credentials->test_mode, "POST", "checkouts", $headers, $options);

        $status_code = $response->getStatusCode();
        $content = $response->getBody()->getContents();
        $content_array = json_decode($content, true);

        if ($status_code === 200) {
            return $this->newElement($content_array);
        } elseif ($status_code === 422) {
            ValidationException::message("Checkout::create", $content_array['errors'] ?? [], 422);
        } else {
            InvalidHttpResponse::message($response, 403);
        }

        return null;
    }
    /**
     * Get Item
     *
     * @param string $id
     * @return CheckoutElement|null
     */
    public function get(string $id): ?CheckoutElement
    {
        $headers = [
            "Authorization" => "Bearer {$this->credentials->getAuthorizationToken()}",
        ];
        $options = [];

        $response = $this->__request($this->credentials->test_mode, "GET", "checkouts/{$id}", $headers, $options);

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
    public function getItems(string $id, $per_page = 30, $page = 1): ?PaginationElement
    {
        $query = http_build_query([
            "per_page" => $per_page,
            "page" => $page,
        ]);
        $headers = [
            "Authorization" => "Bearer {$this->credentials->getAuthorizationToken()}",
        ];
        $options = [];

        $response = $this->__request($this->credentials->test_mode, "GET", "checkouts/{$id}/items?{$query}", $headers, $options);

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
     * Mark Checkout as Expire
     *
     * @param string $id
     * @return CheckoutElement|null
     */
    public function expire(string $id): ?CheckoutElement
    {
        $headers = [
            "Authorization" => "Bearer {$this->credentials->getAuthorizationToken()}",
        ];
        $options = [];

        $response = $this->__request($this->credentials->test_mode, "POST", "checkouts/{$id}/expire", $headers, $options);

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
     * @return CheckoutElement
     */
    public function newElement(array $data): CheckoutElement
    {
        return (new CheckoutElement())
            ->setId($data['id'])
            ->setPaymentLinkId($data['payment_link_id'])
            ->setCustomerId($data['customer_id'])
            ->setInvoiceId($data['invoice_id'])
            ->setPaymentMethod($data['payment_method'])
            ->setCurrency($data['currency'])
            ->setAmount($data['amount'])
            ->setStatus($data['status'])
            ->setFees($data['fees'])
            ->setPassFeesToCustomer(boolval($data['pass_fees_to_customer']))
            ->setDescription($data['description'])
            ->setSuccessUrl($data['success_url'])
            ->setFailureUrl($data['failure_url'])
            ->setWebhookEndpoint($data['webhook_endpoint'])
            ->setLocale($data['locale'])
            ->setMetadata($data['metadata'])
            ->setUrl($data['checkout_url'] ?? null)
            ->setCreatedAt(Carbon::parse($data['created_at']))
            ->setUpdatedAt(Carbon::parse($data['updated_at']))
            ->attachMethodPrices(new CheckoutHasManyPricesRelation($this, new Prices($this->credentials), ["id" => $data['id']]));
    }
}
