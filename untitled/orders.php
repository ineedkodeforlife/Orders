<?php

// Подключаем файл с настройками и функциями для работы с корзиной
require_once 'cart.php';

// Проверяем, какой запрос пришел от клиента
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Если пришел запрос на добавление товара в корзину
    if ($_POST['action'] === 'add_to_cart' && isset($_POST['product_id'])) {
        addToCart($_POST['product_id']);
    }
    // Если пришел запрос на удаление товара из корзины
    elseif ($_POST['action'] === 'remove_from_cart' && isset($_POST['product_id'])) {
        removeFromCart($_POST['product_id']);
    }
    // Если пришел запрос на симуляцию покупки
    elseif ($_POST['action'] === 'checkout') {
        checkout();
    }
}

// Отображаем содержимое корзины
displayCart();
