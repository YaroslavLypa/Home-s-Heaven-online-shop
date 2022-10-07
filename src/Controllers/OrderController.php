<?php

namespace YaroslavLypa\HomesHaven\Controllers;

use Illuminate\Support\Collection;
use mysqli;
use Rakit\Validation\Validator;
class OrderController
{
    public static function store(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        $data = json_decode(file_get_contents('php://input'), true);

        $orderProducts = $data['products'];
        $productIds = array_column($orderProducts, 'id');
        $productIds = implode(', ', $productIds);

        $mysql = new mysqli('localhost', 'root', '', 'code_it');
        $products = $mysql->query("select * from goods where id in ($productIds)")->fetch_all(MYSQLI_ASSOC);
        $products = Collection::make($products)
            ->keyBy('id');

        if ($products->isNotEmpty()) {
            $totalSum = 0;
            foreach ($orderProducts as $orderProduct) {
                $product = $products[$orderProduct['id']];
                $totalSum += $product['price'] * $orderProduct['qty'];
            }

            $user = json_decode($_COOKIE['user'] ?? '[]', true);
            $email = $user['email'];

            $result = mail($email, 'Thanks for your order!', "Your order total: $totalSum");
        }
    }
}
