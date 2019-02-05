<?php

// 1)Основные настройки
define('ROOT', dirname(__FILE__)); //коренная папка
session_start();

// 2)Подключения файлов
require_once(ROOT.'/components/Autoload.php'); // Автозагрузка классов

// 3)Вызов Router
$router = new Router();
$router->run();
