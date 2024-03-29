# Integration via Laravel

## Before start

-   Make sure the package is installed
-   You can install it via composer by running the following command

```bash
composer require chargily/chargily-pay
```

## Getting Started

Follow the following steps one by one

### 1. create new model & migration

```bash
php artisan make:model ChargilyPayment -m
```

### 2. attach the following to class

-   Model `ChargilyPayment` :

```php
    // .....
    class Payment extends Model
    {
        use HasFactory;
        protected $fillable = ["user_id","status","currency","amount"];
    }
```

-   Migration for `ChargilyPayment` :

```php
    // .....
    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('chargily_payments', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger("user_id");
                $table->enum("status", ["pending", "paid", "failed"])->default("pending");
                $table->string("currency");
                $table->string("amount");
                $table->timestamps();
            });
        }
    }
```

### 3. create routes

-   Routes :

```php
Route::post('chargilypay/redirect', [ChargilyPayController::class, "redirect"])->name("chargilypay.redirect");
Route::get('chargilypay/back', [ChargilyPayController::class, "back"])->name("chargilypay.back");
Route::post('chargilypay/webhook', [ChargilyPayController::class, "webhook"])->name("chargilypay.webhook_endpoint");
```

-   Exclude the webhook_endpoint route from the CSRF verification
    1. Go to Middleware `app/Http/Middleware/VerifyCsrfToken.php`
    2. Add `chargilypay/webhook` to except
    ```php
    class VerifyCsrfToken extends Middleware
    {
      /**
       * The URIs that should be excluded from CSRF verification.
       *
       * @var array<int, string>
       */
      protected $except = [
          'chargilypay/webhook',
      ];
    }
    ```

### 4. Create controler

```bash
php artisan make:controller ChargilyPayController
```

-   Attach the following methods to the controller

```php
class ChargilyPayController extends Controller
{
    /**
     * The client will be redirected to the ChargilyPay payment page
     *
     */
    public function redirect()
    {
        $user = auth()->user();
        $currency = "dzd";
        $amount = "25000";

        $payment = \App\Models\ChargilyPayment::create([
            "user_id"  => $user->id,
            "status"   => "pending",
            "currency" => $currency,
            "amount"   => $amount,
        ]);
        if ($payment) {
            $checkout = $this->chargilyPayInstance()->checkouts()->create([
                "metadata" => [
                    "payment_id" => $payment->id,
                ],
                "locale" => "ar",
                "amount" => $payment->amount,
                "currency" => $payment->currency,
                "description" => "Payment ID={$payment->id}",
                "success_url" => route("chargilypay.back"),
                "failure_url" => route("chargilypay.back"),
                "webhook_endpoint" => route("chargilypay.webhook_endpoint"),
            ]);
            if ($checkout) {
                return redirect($checkout->getUrl());
            }
        }
        return dd("Redirection failed");
    }
    /**
     * Your client you will redirected to this link after payment is completed ,failed or canceled
     *
     */
    public function back(Request $request)
    {
        $user = auth()->user();
        $checkout_id = $request->input("checkout_id");
        $checkout = $this->chargilyPayInstance()->checkouts()->get($checkout_id);
        $payment = null;

        if ($checkout) {
            $metadata = $checkout->getMetadata();
            $payment = \App\Models\ChargilyPayment::find($metadata['payment_id']);
            ////
            //// Is not recomended to process payment in back page / success or fail page
            //// Doing payment processing in webhook for best practices
            ////
        }
        dd($checkout,$payment);
    }
    /**
     * This action will be processed in the background
     */
    public function webhook()
    {
        $webhook = $this->chargilyPayInstance()->webhook()->get();
        if ($webhook) {
            //
            $checkout = $webhook->getData();
            //check webhook data is set
            //check webhook data is a checkout
            if ($checkout and $checkout instanceof \Chargily\ChargilyPay\Elements\CheckoutElement) {
                if ($checkout) {
                    $metadata = $checkout->getMetadata();
                    $payment = \App\Models\ChargilyPayment::find($metadata['payment_id']);

                    if ($payment) {
                        if ($checkout->getStatus() === "paid") {
                            //update payment status in database
                            $payment->status = "paid";
                            $payment->update();
                            /////
                            ///// Confirm your order
                            /////
                            return response()->json(["status" => true, "message" => "Payment has been completed"]);
                        } else if ($checkout->getStatus() === "failed" or $checkout->getStatus() === "canceled") {
                            //update payment status in database
                            $payment->status = "failed";
                            $payment->update();
                            /////
                            /////  Cancel your order
                            /////
                            return response()->json(["status" => true, "message" => "Payment has been canceled"]);
                        }
                    }
                }
            }
        }
        return response()->json([
            "status" => false,
            "message" => "Invalid Webhook request",
        ], 403);
    }

    /**
     * Just a shortcut
     */
    protected function chargilyPayInstance()
    {
        return new \Chargily\ChargilyPay\ChargilyPay(new \Chargily\ChargilyPay\Auth\Credentials([
            "mode" => "test",
            "public" => "test_pk_*************************",
            "secret" => "test_sk_*************************",
        ]));
    }
}
```

### 4. Instructions

-   Webhooks not working for local environment. you must be host your website
