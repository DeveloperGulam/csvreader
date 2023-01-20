<?php

namespace Bigcommerce;

require_once __DIR__ . '/constants.php';
class Product
{
    public $limit = null;
    public $page = null;
    private static $base_url;
    private static $auth_token;
    private static $product_id;

    public function __construct($limit = null, $page = null, $product_id = null)
    {
        $this->limit = $limit;
        $this->page = $page;
        self::$base_url = BIGCOMMERCE_STORE_URL;
        self::$auth_token = BIGCOMMERCE_AUTH_TOKEN;
        self::$product_id = $product_id;
    }

    public static function getProduct($limit = null, $page = null)
    {
        $url = self::$base_url . 'catalog/products?limit=' . $limit . '&page=' . $page;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-Auth-Token: ' . self::$auth_token
            ),
        ));

        $response = curl_exec($curl);
        if ($response) {
            $result = json_decode($response, true);
            return $result;
        } else return false;
    }

    public static function createProduct($data = null)
    {
        $url = self::$base_url . 'catalog/products';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "id": 6414,
                "name": "API Product",
                "type": "physical",
                "sku": "API-01",
                "description": "<p><span>GG Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel metus ac est egestas porta sed quis erat. Integer id nulla massa. Proin vitae enim nisi. Praesent non dignissim nulla. Nulla mattis id massa ac pharetra. Mauris et nisi in dolor aliquam sodales. Aliquam dui nisl, dictum quis leo sit amet, rutrum volutpat metus. Curabitur libero nunc, interdum ac libero non, tristique porttitor metus. Ut non dignissim lorem, in vestibulum leo. Vivamus sodales quis turpis eget.</span></p>",
                "weight": 1,
                          "width": 0,
                          "depth": 0,
                          "height": 0,
                          "price": 49,
                          "cost_price": 0,
                          "retail_price": 0,
                          "sale_price": 0,
                          "map_price": 0,
                          "tax_class_id": 0,
                          "product_tax_code": "",
                          "calculated_price": 49,
                          "categories": [
                              23,
                              18
                          ],
                          "brand_id": 0,
                          "option_set_id": 14,
                          "option_set_display": "right",
                          "inventory_level": 0,
                          "inventory_warning_level": 0,
                          "inventory_tracking": "none",
                          "reviews_rating_sum": 0,
                          "reviews_count": 0,
                          "total_sold": 4,
                          "fixed_cost_shipping_price": 0,
                          "is_free_shipping": false,
                          "is_visible": true,
                          "is_featured": false,
                          "related_products": [
                              -1
                          ],
                          "warranty": "",
                          "bin_picking_number": "",
                          "layout_file": "product.html",
                          "upc": "",
                          "mpn": "",
                          "gtin": "",
                          "search_keywords": "",
                          "availability": "available",
                          "availability_description": "",
                          "gift_wrapping_options_type": "any",
                          "gift_wrapping_options_list": [],
                          "sort_order": 0,
                          "condition": "New",
                          "is_condition_shown": false,
                          "order_quantity_minimum": 0,
                          "order_quantity_maximum": 0,
                          "page_title": "",
                          "meta_keywords": [],
                          "meta_description": "",
                          "date_created": "2015-07-03T17:57:10+00:00",
                          "date_modified": "2015-08-05T18:17:22+00:00",
                          "view_count": 63,
                          "preorder_release_date": null,
                          "preorder_message": "0",
                          "is_preorder_only": false,
                          "is_price_hidden": false,
                          "price_hidden_label": "0",
                          "custom_url": {
                              "url": "/fog-linen-chambray-towel-beige-stripe/",
                              "is_customized": false
                          },
                "open_graph_type": "product",
                "open_graph_title": "string",
                "open_graph_description": "string",
                "open_graph_use_meta_description": true,
                "open_graph_use_product_name": true,
                "open_graph_use_image": true,
                "brand_name or brand_id": "Common Good",
                "gtin": "string",
                "mpn": "string",
                "reviews_rating_sum": 3,
                "reviews_count": 4,
                "total_sold": 80,
                "custom_fields": [],
                "bulk_pricing_rules": [],
                "images": [],
                "videos": [
                  {
                    "title": "Writing Great Documentation",
                    "description": "A video about documenation",
                    "sort_order": 1,
                    "type": "youtube",
                    "video_id": "z3fRu9pkuXE",
                    "id": 0,
                    "product_id": 0,
                    "length": "string"
                  }
                ]
            }',
            CURLOPT_HTTPHEADER => array(
                'X-Auth-Token: ' . self::$auth_token,
            ),
        ));

        $response = curl_exec($curl);
        if ($response) {
            $result = json_decode($response, true);
            return $result;
        } else return false;
    }

    public static function createProductOption($data = null)
    {
        if (!empty($data)) {
            $option_values = [];
            for ($i = 0; $i < count($data['color']); $i++) {
                $option_values[] = array(
                    "label" => $data['color'][$i],
                    "sort_order" => 1,
                    "value_data" => [
                        "colors" => [
                            $data['color_code'][$i]
                        ]
                    ],
                    "is_default" => false
                );
            }
            $count = 0;
            foreach ($data['product_ids'] as $product_id) {
                $count++;
                $postData = [
                    "display_name" => $data['display_name'],
                    "type" => strtolower($data['type']),
                    "option_values" => $option_values,
                    "image_url" => ""
                ];
                // echo "<pre>";
                // print_r($postData);

                $url = self::$base_url . 'catalog/products/' . $product_id . '/options';
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode($postData),
                    CURLOPT_HTTPHEADER => array(
                        'X-Auth-Token: ' . self::$auth_token,
                    ),
                ));

                $response = curl_exec($curl);
                // if ($response && $count == count($data['product_ids'])) {
                //     // $result = json_decode($response, true);
                //     return true;
                // } else return false;
            }
            return true;
            // die;
        } else return false;
    }
}
