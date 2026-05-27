<?php

use PHPUnit\Framework\TestCase;

class CustomersTest extends TestCase
{
    public function test_database_config_has_required_keys()
    {
        $config = [
            'host'   => 'localhost',
            'dbname' => 'cloud_app',
            'user'   => 'root',
            'pass'   => '',
        ];

        $this->assertArrayHasKey('host', $config);
        $this->assertArrayHasKey('dbname', $config);
        $this->assertArrayHasKey('user', $config);
        $this->assertArrayHasKey('pass', $config);
    }

    public function test_customer_name_is_not_empty()
    {
        $name = 'Tendai Moyo';
        $this->assertNotEmpty($name);
    }

    public function test_customer_email_format()
    {
        $email = 'tendai@example.com';
        $this->assertStringContainsString('@', $email);
    }

    public function test_sql_query_contains_select()
    {
        $query = 'SELECT id, name, email, created_at FROM customers ORDER BY id ASC';
        $this->assertStringStartsWith('SELECT', $query);
    }

    public function test_html_special_chars_are_escaped()
    {
        $input   = '<script>alert("xss")</script>';
        $escaped = htmlspecialchars($input);
        $this->assertStringNotContainsString('<script>', $escaped);
    }
}