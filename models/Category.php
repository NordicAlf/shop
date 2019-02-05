<?php
class Category
{
	const SHOW_BY_DEFAULT = 3;

	public static function getCategoryList()
	{
		$db = Database::db_connect();

		$categoryList = array();
		$result = $db->query("SELECT * FROM category ORDER BY sort_order ASC");

		$i = 0;
		while ($row = $result->fetch()) {
			$categoryList[$i]['id'] = $row['id'];
			$categoryList[$i]['name'] = $row['name'];
			$categoryList[$i]['sort_order'] = $row['sort_order'];
			$categoryList[$i]['status'] = $row['status'];
			$i++;
		}
	return $categoryList;
	}

	public static function getCategoryById($id)
	{
		$db = Database::db_connect();

		$category = array();
		$category = $db->query("SELECT * FROM category WHERE id='$id'");
	return $category->fetch();
	}

	public static function getProductsByIdCategory($categoryId = false, $page = 1)
	{
		if ($categoryId) {
			$showDefault = self::SHOW_BY_DEFAULT;
			$page = intval($page);
			$offset = ($page - 1) * self::SHOW_BY_DEFAULT;

			$db = Database::db_connect();
			$products = array();
			$result = $db->query("SELECT id, name, price, is_new FROM product
				WHERE status = '1' AND category_id = '$categoryId'
				ORDER BY id DESC
				LIMIT $showDefault
				OFFSET $offset");

			$i = 0;
			while ($row = $result->fetch()) {
				$products[$i]['id'] = $row['id'];
				$products[$i]['name'] = $row['name'];
				$products[$i]['price'] = $row['price'];
				$products[$i]['is_new'] = $row['is_new'];
				$i++;
			}
			return $products;
		}
	}

	public static function createCategory($options)
	{
		$db = Database::db_connect();

		// Текст запроса к БД
      $sql = 'INSERT INTO category '
              . '(name, sort_order, status)'
              . 'VALUES '
              . '(:name, :sort_order, :status)';

      // Получение и возврат результатов. Используется подготовленный запрос
      $result = $db->prepare($sql);
      $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
      $result->bindParam(':sort_order', $options['sort_order'], PDO::PARAM_STR);
      $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
      if ($result->execute()) {
          // Если запрос выполенен успешно, возвращаем id добавленной записи
          return $db->lastInsertId();
      }
      // Иначе возвращаем 0
      return 0;
  }

	public static function updateCategory($id, $options)
	{
		$db = Database::db_connect();
		$name = $options['name'];
		$sort_order = $options['sort_order'];
		$status = $options['status'];
		// Текст запроса к БД
		$db->query("UPDATE category
			SET
				name = '$name',
				sort_order = '$sort_order',
				status = '$status'
			WHERE id = '$id'");
  }

	public static function deleteCategory($id)
	{
		$db = Database::db_connect();

		$db->query("DELETE FROM category WHERE id='$id'");
	}
}
