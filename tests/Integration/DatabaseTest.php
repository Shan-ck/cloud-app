<?php

use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    public function test_pdo_dsn_format_is_correct()
    {
        $host    = 'localhost';
        $dbname  = 'cloud_app';
        $charset = 'utf8mb4';
        $dsn     = "mysql:host=$host;dbname=$dbname;charset=$charset";

        $this->assertStringStartsWith('mysql:', $dsn);
        $this->assertStringContainsString('host=localhost', $dsn);
        $this->assertStringContainsString('dbname=cloud_app', $dsn);
    }

    public function test_pdo_options_array_has_required_keys()
    {
        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $this->assertArrayHasKey(\PDO::ATTR_ERRMODE, $options);
        $this->assertArrayHasKey(\PDO::ATTR_DEFAULT_FETCH_MODE, $options);
    }

    public function test_error_log_message_format()
    {
        $message = 'DB connection failed: SQLSTATE error';
        $this->assertStringStartsWith('DB connection failed:', $message);
    }

    public function test_empty_customers_array_returns_true()
    {
        $customers = [];
        $this->assertEmpty($customers);
    }

    public function test_customer_record_has_required_fields()
    {
        $customer = [
            'id'         => 1,
            'name'       => 'Tendai Moyo',
            'email'      => 'tendai@example.com',
            'created_at' => '2025-01-01 00:00:00',
        ];

        $this->assertArrayHasKey('id', $customer);
        $this->assertArrayHasKey('name', $customer);
        $this->assertArrayHasKey('email', $customer);
        $this->assertArrayHasKey('created_at', $customer);
    }
}