<?php

class User
{
  public static function register($name, $email, $password) {
    $db = Database::db_connect();

    $sql = "INSERT INTO user (name, email, password, role) VALUES (:name, :email, :password, '')";

    $result = $db->prepare($sql);
    $result->bindParam(':name', $name, PDO::PARAM_STR);
    $result->bindParam(':email', $email, PDO::PARAM_STR);
    $result->bindParam(':password', $password, PDO::PARAM_STR);
    return $result->execute();
    /**$db->query("INSERT INTO user SET name='$name',
    email='$email', password='$password'"); **/
  }

  public static function checkName($name) {
    if (strlen($name) >= 4) {
      return true;
    }
  return false;
  }

  public static function checkEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return true;
    }
  return false;
  }

  public static function checkEmailExists($email) {
    $db = Database::db_connect();

    $sql = 'SELECT COUNT(*) FROM user WHERE email= :email';
    $result = $db->prepare($sql);
    $result->bindParam(":email", $email, PDO::PARAM_STR);
    $result->execute();

    if ($result->fetchColumn()) {
      return true;
    }
    return false;
  }
  /**
   * Проверяет существует ли почта у других юзеров
   */
  public static function checkEmailExistsForEditUser($email, $userId) {
    $db = Database::db_connect();

    $result = $db->query("SELECT COUNT(*) FROM user WHERE email='$email' AND id!='$userId'");

    if ($result->fetchColumn()) {
      return true;
    }
    return false;
  }

  public static function checkPassword($password) {
    if (strlen($password) >= 8) {
      return true;
    }
  return false;
  }

  public static function checkUserData($email, $password)
  {
    $db = Database::db_connect();
    $result = $db->query("SELECT * FROM user
      WHERE email='$email' AND password='$password'");
    $user = $result->fetch();
    if($user) {
      return $user['id'];
    }
    return false;
  }

  public static function auth($userId)
  {
    session_start();
    $_SESSION['user'] = $userId;
  }

  public static function checkLogged()
  {
    if (isset($_SESSION['user'])) {
      return $_SESSION['user'];
    }
    header("Location: /user/login");
  }

  public static function getUserById($userId)
  {
    if ($userId) {
      $db = Database::db_connect();
      $result = $db->query("SELECT * FROM user WHERE id='$userId'");
      return $result->fetch(PDO::FETCH_ASSOC);
    }
  }

  public static function editUser($userId, $name, $email, $password)
  {
      $db = Database::db_connect();
      $db->query("UPDATE user SET name='$name', email='$email', password='$password'
        WHERE id='$userId'");
      return true;
  }

  /**
   * Функция для проверки админки в юзер-панели!
   */
  public static function checkAdmin() {
    // Проверяем авторизован ли пользователь
    $userId = User::checkLogged();

    // Получаем информацию о пользователе
    $user = User::getUserById($userId);

    // Проверяем является ли админом пользователь
    if ($user['role'] == 'admin') {
      return true;
    }
  }
  
}
