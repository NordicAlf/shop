<?php

class CabinetController
{
  public function actionIndex()
  {
    $userId = User::checkLogged(); //проверка авторизирован ли

    $user = User::getUserById($userId);

    require_once(ROOT . '/view/cabinet/index.php');
  }

  public function actionEdit()
  {
    $userId = User::checkLogged();
    $user = User::getUserById($userId);

    $name = $user['name'];
    $email = $user['email'];
    $password = $user['password'];
    $errors = null;

    if (isset($_POST['submit'])) {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      if (!User::checkName($name)) {
        $errors[] = 'Имя не должно быть короче 4-х символов!';
      }

      if (!User::checkEmail($email)) {
        $errors[] = 'Неправильный email!';
      }

      if (User::checkEmailExistsForEditUser($email, $userId)) {
        $errors[] = 'Такой email уже существует';
      }

      if (!User::checkPassword($password)) {
        $errors[] = 'Пароль не должен быть короче 8-х символов!';
      }
      if ($errors == null) {
        $resultEdit = User::editUser($userId, $name, $email, $password);
      }
    }
    require_once(ROOT . '/view/cabinet/edit.php');
  }
}
