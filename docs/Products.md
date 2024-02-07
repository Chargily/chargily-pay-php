## Products

### List of All

```php
/**
* @var Chargily\ChargilyPay\Elements\PaginationElement|null
*/
$products = $chargily_pay->products()->all();
```

### Retrieve

```php
/**
* @var Chargily\ChargilyPay\Elements\ProductElement|null
*/
$product = $chargily_pay->products()->get("product_id");
```

### Create

```php
/**
* @var Chargily\ChargilyPay\Elements\ProductElement|null
*/
$product = $chargily_pay->products()->create([
        "name"=> "product name",
        "description"=> "product description",
        "images"=> ["image_url"],
        "metadata"=> [],
]);

```

### Update

```php
/**
* @var Chargily\ChargilyPay\Elements\ProductElement|null
*/
$product = $chargily_pay->products()->update("product_id",[
        "name"=> "new product name",
        "description"=> "new product description",
        "images"=> ["new_image_url"],
        "metadata"=> [],
]);
```

### Delete

```php
/**
* @var boolean
*/
$deleted = $chargily_pay->products()->delete("product_id");
```

### Retrieve a product prices

```php
/**
* @var Chargily\ChargilyPay\Elements\PaginationElement|null
*/
$pricecs = $chargily_pay->products()->prices("product_id");
```
