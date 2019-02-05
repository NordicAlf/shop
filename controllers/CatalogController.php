<?php

class CatalogController
{
	public function actionIndex()
	{
		$categories = array();
		$categories = Category::getCategoryList();

		$latestProducts = array();
		$latestProducts = Product::getLatestProducts(10);

		require_once(ROOT. '/view/catalog/index.php');

		return true;
	}

	public function actionCategory($categoryId, $page = 1)
	{
		
		$categories = array();
		$categories = Category::getCategoryList();

		$productsCategory = array();
		$productsCategory = Category::getProductsByIdCategory($categoryId, $page);

		$total = Product::getTotalProductsInCategory($categoryId);
		$pagination = new Pagination($total, $page, Category::SHOW_BY_DEFAULT, 'page-');

		require_once(ROOT .'/view/catalog/category.php');
	}
}
