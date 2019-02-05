<?php

class AdminCategoryController extends AdminBase
{
  public function actionIndex() {
    self::checkAdmin();

    $categoryList = Category::getCategoryList();

    require_once(ROOT . '/view/admin_category/index.php');
  }

  public function actionDelete($id) {
    self::checkAdmin();
    if (isset($_POST['submit'])) {
      Category::deleteCategory($id);
      header("Location: /admin/category");
    }

    require_once(ROOT . '/view/admin_category/delete.php');
  }

  public function actionUpdate($id)
  {
    self::checkAdmin();
    $category = Category::getCategoryById($id);

    if (isset($_POST['submit'])) {
      // Если форма отправлена
      // Получаем данные из формы
      $options['name'] = $_POST['name'];
      $options['sort_order'] = $_POST['sort_order'];
      $options['status'] = $_POST['status'];

      Category::updateCategory($id, $options);
      // Перенаправляем пользователя на страницу управлениями товарами
      header("Location: /admin/category");
    }
    require_once(ROOT . '/view/admin_category/update.php');
  }

  public function actionCreate()
  {
    self::checkAdmin();
    $categoryList = Category::getCategoryList();

    if (isset($_POST['submit'])) {
      // Если форма отправлена
      // Получаем данные из формы
      $options['name'] = $_POST['name'];
      $options['sort_order'] = $_POST['sort_order'];
      $options['status'] = $_POST['status'];

      Category::createCategory($options);

      // Перенаправляем пользователя на страницу управлениями товарами
      header("Location: /admin/category");
    }
    require_once(ROOT . '/view/admin_category/create.php');
  }
}
