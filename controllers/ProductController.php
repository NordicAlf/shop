<?php

class ProductController
{
	public function actionView($productId)
	{
		$categories = array();
		$categories = Category::getCategoryList();

		$product = array();
		$product = Product::getProductById($productId);

		require_once(ROOT. '/view/product/product.php');

		return true;
	}
}
