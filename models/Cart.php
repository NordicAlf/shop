<?php

class Cart
{
  public static function addProduct($productId)
  {
    $id = intval($productId);

    $productsInCart = array();

    //Если в корзине есть товары
    if (isset($_SESSION['products'])) {
      $productsInCart = $_SESSION['products'];
    }

    //Если товар уже был в корзине, то добавим количество
    if (array_key_exists($productId, $productsInCart)) {
      $productsInCart[$productId] ++;
    }
    else {
      //добавим новый товар в корзину
      $productsInCart[$productId] = 1;
    }

    $_SESSION['products'] = $productsInCart;
  }

  public static function countItems()
  {
    if (isset($_SESSION['products'])) {
      $count = 0;
      foreach ($_SESSION['products'] as $productId => $quatity) {
        $count += $quatity;
      }
      return $count;
    }
    else {
      return 0;
    }
  }

  public static function getProducts()
  {
    if (isset($_SESSION['products'])) {
      return $_SESSION['products'];
    }
    return false;
  }

  public static function checkOut($name, $phone, $comment)
  {
    $db = Database::db_connect();

    $productsArray = $_SESSION['products'];
    $products = '';
    foreach ($productsArray as $id => $count) {
      $products .= "$id-$count-";
    }

    $db->query("INSERT INTO product_order (user_name, user_phone, user_comment, products)
      VALUES ('$name', '$phone', '$comment', '$products')");
  }
}
