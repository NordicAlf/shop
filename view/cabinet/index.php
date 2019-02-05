<?php include ROOT . '/view/layouts/header.php'; ?>

<section>
  <div class="container">
    <div class="row">
      <h1>Кабинет пользователя</h1>
      <h3>Привет, <?php echo $user['name']; ?></h3>
      <ul>
        <?php
        if (User::checkAdmin()) {
          echo "<li><a href=\"/admin\">Админ-панель</a></li>";
        }?>
        <li><a href="/cabinet/edit">Редактировать</a></li>
        <li><a href="/cabinet/history">Список покупок</a></li>
      </ul>
    </div>
  </div>
</section>

<?php include ROOT . '/view/layouts/footer.php'; ?>
