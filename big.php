<?php
    require_once __DIR__ . '/bigcommerce.php';

    $bigcommerce = new Bigcommerce\Product;
    $products = $bigcommerce->getProduct(2,1);
    echo "<pre>";
    print_r($products['data']);

?>