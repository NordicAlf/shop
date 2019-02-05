<?php

return array (
	// Админ-панель
	'admin' => 'admin/index',
	// Конкретный товар
	'product/([0-9]+)' => 'product/view/$1',
	// Каталог товаров
	'catalog' => 'catalog/index',
	// Категории товаров
	'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2',
	'category/([0-9]+)' => 'catalog/category/$1',
	// Корзина
	'cart/add/([0-9]+)' => 'cart/add/$1',
	'cart/checkout' => 'cart/checkout',
	'cart/delete/([0-9]+)' => 'cart/delete/$1',
	'cart' => 'cart/index',
	// Пользователь
	'user/register' => 'user/register',
	'user/login' => 'user/login',
	'user/logout' => 'user/logout',
	'cabinet' => 'cabinet/index',
	'cabinet/edit' => 'cabinet/edit',
	// Управление товарами:
  'admin/product/create' => 'adminProduct/create',
  'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
  'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
  'admin/product' => 'adminProduct/index',
  // Управление категориями:
  'admin/category/create' => 'adminCategory/create',
  'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
  'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
  'admin/category' => 'adminCategory/index',
	// О магазине
	'contacts' => 'site/contact',
	// Главная страница
	'' => 'site/index' // SiteController и actionIndex

	);
