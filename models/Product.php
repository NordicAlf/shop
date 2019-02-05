<?php

class Product
{
	const SHOW_BY_DEFAULT = 10;
	public static function getLatestProducts($count = self::SHOW_BY_DEFAULT)
	{
		$count = intval($count);

		$db = Database::db_connect();

		$productList = array();
		$result = $db->query("SELECT id, name, price, is_new FROM product WHERE status = '1' ORDER BY id DESC LIMIT $count");
		$i = 0;
		while ($row = $result->fetch()) {
			$productList[$i]['id'] = $row['id'];
			$productList[$i]['name'] = $row['name'];
			$productList[$i]['price'] = $row['price'];
			$productList[$i]['is_new'] = $row['is_new'];
			$i++;
		}
	return $productList;
	}

	public static function getProductList()
	{
		$db = Database::db_connect();

		$productList = array();
		$result = $db->query("SELECT * FROM product");
		$i = 0;
		while ($row = $result->fetch()) {
			$productList[$i]['id'] = $row['id'];
			$productList[$i]['code'] = $row['code'];
			$productList[$i]['name'] = $row['name'];
			$productList[$i]['price'] = $row['price'];
			$i++;
		}
		return $productList;
	}

	public static function getProductById($id)
	{
		$id = intval($id);
		$db = Database::db_connect();

		$product = array();
		$product = $db->query('SELECT * FROM product WHERE id=' . $id);
		return $product->fetch();
	}

	public static function getProductByIds($productsInCart)
	{
		$db = Database::db_connect();

		$products = array();
		$i = 0;

		foreach ($productsInCart as $id => $count) {
			$product = $db->query('SELECT * FROM product WHERE id=' . $id);
			while ($row = $product->fetch(PDO::FETCH_ASSOC)) {
				$products[$i]['id'] = $row['id'];
				$products[$i]['name'] = $row['name'];
				$products[$i]['code'] = $row['code'];
				$products[$i]['price'] = $row['price'];
				$products[$i]['count'] = $count;
			}
		$i++;
		}
		return $products;
	}

	public static function getTotalProductsInCategory($categoryId)
	{
		$db = Database::db_connect();
		$result = $db->query("SELECT count(id) AS count FROM product
			WHERE status='1' AND category_id = '$categoryId'");
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$row = $result->fetch();
		return $row['count'];

	}

	public static function getRecommendedProducts()
	{
		$db = Database::db_connect();

		// Получение и возврат результатов
    $result = $db->query('SELECT id, name, price, is_new FROM product '
            . 'WHERE status = "1" AND is_recommended = "1" '
            . 'ORDER BY id DESC');
    $i = 0;
    $productsList = array();
    while ($row = $result->fetch()) {
        $productsList[$i]['id'] = $row['id'];
        $productsList[$i]['name'] = $row['name'];
        $productsList[$i]['price'] = $row['price'];
        $productsList[$i]['is_new'] = $row['is_new'];
        $i++;
    }
    return $productsList;
	}

	public static function getImage($id)
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';

        // Путь к папке с товарами
        $path = '/upload/images/products/';

        // Путь к изображению товара
        $pathToProductImage = $path . $id . '.jpg';
				return $pathToProductImage;

				/*
        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        }

        // Возвращаем путь изображения-пустышки
        return $path . $noImage; */
    }

	public static function createProduct($options)
	{
		$db = Database::db_connect();

		// Текст запроса к БД
      $sql = 'INSERT INTO product '
              . '(name, code, price, category_id, brand, availability,'
              . 'description, is_new, is_recommended, status)'
              . 'VALUES '
              . '(:name, :code, :price, :category_id, :brand, :availability,'
              . ':description, :is_new, :is_recommended, :status)';

      // Получение и возврат результатов. Используется подготовленный запрос
      $result = $db->prepare($sql);
      $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
      $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
      $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
      $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
      $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
      $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
      $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
      $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
      $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
      $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
      if ($result->execute()) {
          // Если запрос выполенен успешно, возвращаем id добавленной записи
          return $db->lastInsertId();
      }
      // Иначе возвращаем 0
      return 0;
  }

	public static function updateProduct($id, $options)
	{
		$db = Database::db_connect();

		// Текст запроса к БД
		$sql = "UPDATE product
			SET
				name = :name,
				code = :code,
				price = :price,
				category_id = :category_id,
				brand = :brand,
				availability = :availability,
				description = :description,
				is_new = :is_new,
				is_recommended = :is_recommended,
				status = :status
			WHERE id = :id";

      // Получение и возврат результатов. Используется подготовленный запрос
      $result = $db->prepare($sql);
			$result->bindParam(':id', $id, PDO::PARAM_INT);
      $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
      $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
      $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
      $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
      $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
      $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
      $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
      $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
      $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
      $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
      if ($result->execute()) {
          // Если запрос выполенен успешно, возвращаем id добавленной записи
          return $db->lastInsertId();
      }
      // Иначе возвращаем 0
      return 0;
  }

	public static function deleteProduct($id)
	{
		$db = Database::db_connect();

		$db->query("DELETE FROM product WHERE id='$id'");
	}
}
