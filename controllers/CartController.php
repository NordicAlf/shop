<?php

class CartController
{
  public function actionAdd($productId)
  {
    //require_once(ROOT . '/view/cart/add.php');
    echo 'hi';
    //добавляем товар в корзину
    Cart::addProduct($productId);

    $ref = $_SERVER['HTTP_REFERER'];
    header("Location: $ref");
  }

  public function actionIndex()
  {
    $categories = array();
    $products = array();
    $categories = Category::getCategoryList();

    $productsInCart = false;
    $productsInCart = Cart::getProducts();

    if ($productsInCart) {
      //получаем информацию о товарах из массива
        $products = Product::getProductByIds($productsInCart);
    }
    require_once(ROOT . '/view/cart/index.php');
  }

  public function actionCheckout()
  {
    $categories = array();
    $categories = Category::getCategoryList();
    $result = false;

    if (isset($_POST['submit'])) {
        if (isset($_POST['name']) and isset($_POST['numberTelephone'])) {
          if (!isset($_POST['comment'])) {
            $_POST['comment'] = ''; //пустой комментарий для SQL
          }
          $name = $_POST['name'];
          $phone = $_POST['numberTelephone'];
          $comment = $_POST['comment'];
          Cart::checkOut($name, $phone, $comment);
          $result = true;   //заявка отправлена
          unset($_SESSION['products']);   //очистить корзину
        }
    }

    require_once(ROOT . '/view/cart/checkout.php');
  }

  public function actionDelete($numberDelete)
  {
    unset($_SESSION['products'][$numberDelete]);
    header("Location: /cart");
  }
}
