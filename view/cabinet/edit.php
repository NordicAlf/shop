<?php include ROOT . '/view/layouts/header.php'; ?>

<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-4 col-sm-offser-4 padding-right">
        <?php
            if (isset($errors) and isset($_POST['submit'])) {
            echo '<ul>';
              foreach ($errors as $error) {
                echo '<li>-' . $error . '</li>';
              }
            echo '</ul>';
          }?>
          <div class='signup-form'>
            <?php
              if (isset($resultEdit)) {
                echo 'Данные отредактированы!';
              } else {
                echo "<h2>Редактирование данных</h2>
                <form action='#' method='post'>
                <input type='text' name='name' placeholder='Имя' value=\"$user[name]\" />
                <input type='email' name='email' placeholder='Почта' value=\"$user[email]\" />
                <input type='password' name='password' placeholder='Пароль' value=\"$user[password]\"/>
                <button type='submit' name='submit' class='btn btn-default'>Сохранить</button>
                </form>";
              }
            ?>
            </div>
          <br />
        <br />
      </div>
    </div>
  </div>
</section>

<?php include ROOT . '/view/layouts/footer.php'; ?>
