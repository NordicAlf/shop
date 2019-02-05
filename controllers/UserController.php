<?php

class UserController
{
  public function actionRegister()
  {
    $name = '';
    $email = '';
    $password = '';

    if (isset($_POST['submit'])) {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      $errors = null;

      if (!User::checkName($name)) {
        $errors[] = 'Имя не должно быть короче 4-х символов!';
      }
    }

      if (!User::checkEmail($email)) {
        $errors[] = 'Неправильный email!';
      }

      if (User::checkEmailExists($email)) {
        $errors[] = 'Такой email уже существует';
      }

      if (!User::checkPassword($password)) {
        $errors[] = 'Пароль не должен быть короче 8-х символов!';
      }
      if ($errors == null) {
        $result = User::register($name, $email, $password);
      }
    require_once(ROOT . '/view/user/register.php');
  }

  public function actionLogin()
  {
    $email = '';
    $password = '';

    if (isset($_POST['submit'])) {
      $email = $_POST['email'];
      $password = $_POST['password'];

      $errors = null;

      //валидация полей
      if (!User::checkEmail($email)) {
        $errors[] = 'Неправильный email!';
      }
      if (!User::checkPassword($password)) {
        $errors[] = 'Пароль не должен быть короче 8-х символов!';
      }

      //проверка существует ли пользователь
      $userId = User::checkUserData($email, $password);

      if ($userId == false) {
        $errors[] = 'Неправильные данные для входа на сайт';
      }
      else {
        //запоминаем пользователя(в сессии)
        User::auth($userId);

        //перенаправляем в Кабинет
        header("Location: /cabinet/");
      }
    }
          require_once(ROOT . '/view/user/login.php');
  }

  public function actionLogout()
  {
    unset($_SESSION['user']);
    header('Location: /');
  }
}
