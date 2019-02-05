<?php
/**
 * Абстрактный класс для общей логики для контроллеров в админке
 */
abstract class AdminBase
{
  public static function checkAdmin() {
    // Проверяем авторизован ли пользователь
    $userId = User::checkLogged();

    // Получаем информацию о пользователе
    $user = User::getUserById($userId);

    // Проверяем является ли админом пользователь
    if ($user['role'] == 'admin') {
      return true;
    }

    // Иначе не впускаем
    die('Доступ запрещён');
  }
}
