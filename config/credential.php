<?php

return [
    'user' => env('LOOP_USER', 'loop'),
    'pass' => env('LOOP_PASS', 'backend_dev'),
    'customer_file_url' => env('LOOP_CUSTOMER_FILE_URL', 'https://backend-developer.view.agentur-loop.com/customers.csv'),
    'product_file_url' => env('LOOP_PRODUCT_FILE_URL', 'https://backend-developer.view.agentur-loop.com/products.csv')
];