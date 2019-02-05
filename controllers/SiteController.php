<?php

class SiteController
{
	public function actionIndex()
	{
		// Список категорий для левого меню
		$categories = array();
		$categories = Category::getCategoryList();

		// Список последних товаров на главной
		$latestProducts = array();
		$latestProducts = Product::getLatestProducts(3);

		// Список товаров для слайдера
		$sliderProducts = Product::getRecommendedProducts();

		require_once(ROOT. '/view/site/index.php');

		return true;
	}

	public function actionContact()
	{
		$userEmail = '';
		$userText = '';
		$result = false;

		if (isset($_POST['submit'])) {
			$userEmail = $_POST['userEmail'];
			$userText = $_POST['userText'];
			$errors = false;

			if (!User::checkEmail($userEmail)) {
				$errors[] = 'Неправильный email';
			}

			if ($errors == false) {
				$adminEmail = 'php.start@gmail.com';
				$subject = 'Тема письма';
				$message = "Текст: {$userText}. От: {$userEmail}" ;
				$result = mail($adminEmail, $subject, $message);
				$result = true;
			}
		}
		require_once(ROOT . '/view/site/contact.php');
		return true;
	}
}
