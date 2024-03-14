<?php

// Начинаем или возобновляем сессию
session_start();

// Функция для добавления товара в корзину
function addToCart($product_id) {
    // Создаем корзину, если её еще нет
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    // Добавляем товар в корзину
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]++;
    } else {
        $_SESSION['cart'][$product_id] = 1;
    }
}

// Функция для удаления товара из корзины
function removeFromCart($product_id) {
    // Проверяем, есть ли товар в корзине
    if (isset($_SESSION['cart'][$product_id])) {
        // Удаляем товар из корзины
        unset($_SESSION['cart'][$product_id]);
    }
}

// Функция для симуляции покупки
function checkout() {
    // Симуляция покупки - просто очистим корзину
    $_SESSION['cart'] = [];
}

// Функция для отображения содержимого корзины
function displayCart() {
    echo "<h2>Корзина:</h2>";
    if (empty($_SESSION['cart'])) {
        echo "<p>Корзина пуста</p>";
    } else {
        echo "<ul>";
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            echo "<li>Товар #$product_id: количество - $quantity</li>";
        }
        echo "</ul>";
    }
    // Форма для добавления и удаления товаров из корзины
    echo "
        <form action='orders.php' method='post'>
            <input type='hidden' name='action' value='remove_from_cart'>
            <input type='text' name='product_id' placeholder='ID товара'>
            <input type='submit' value='Удалить из корзины'>
        </form>
        <form action='orders.php' method='post'>
            <input type='hidden' name='action' value='add_to_cart'>
            <input type='text' name='product_id' placeholder='ID товара'>
            <input type='submit' value='Добавить в корзину'>
        </form>
        <form action='orders.php' method='post'>
            <input type='hidden' name='action' value='checkout'>
            <input type='submit' value='Оформить заказ'>
        </form>
    ";
}
