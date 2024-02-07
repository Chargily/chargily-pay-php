<?php

namespace ChargilyTests\ChargilyPay;

use Chargily\ChargilyPay\Auth\Credentials;
use Chargily\ChargilyPay\Exceptions\ValidationException;
use PHPUnit\Framework\TestCase;

final class CredentialsTest extends TestCase
{
    /**
     * Test
     *
     */
    public function testAuthCredentialsForLiveMode()
    {
        $credentials = new Credentials([
            "mode" => "live",
            "public" => "live_pk_***********************",
            "secret" => "live_sk_***********************",
        ]);
        $this->assertTrue($credentials->live_mode);
        $this->assertFalse($credentials->test_mode);
    }
    /**
     * Test
     *
     */
    public function testAuthCredentialsForTestMode()
    {
        $credentials = new Credentials([
            "mode" => "test",
            "public" => "test_pk_***********************",
            "secret" => "test_sk_***********************",
        ]);
        $this->assertTrue($credentials->test_mode);
        $this->assertFalse($credentials->live_mode);
    }
    /**
     * Test
     *
     */
    public function testAuthCredentialsInvalidMode()
    {
        $this->expectException(ValidationException::class);


        $credentials = new Credentials([
            "mode" => "not-test-or-live-mode",
        ]);
    }
    /**
     * Test
     *
     */
    public function testAuthCredentialsInvalidPublic()
    {
        $this->expectException(ValidationException::class);


        $credentials = new Credentials([
            "mode" => "test",
            "public" => "",
            "secret" => "test_sk_***********************",
        ]);
    }
    /**
     * Test
     *
     */
    public function testAuthCredentialsInvalidSecret()
    {
        $this->expectException(ValidationException::class);


        $credentials = new Credentials([
            "mode" => "test",
            "public" => "test_pk_***********************",
            "secret" => "",
        ]);
    }
}
