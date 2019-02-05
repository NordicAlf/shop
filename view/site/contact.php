<?php include ROOT . '/view/layouts/header.php'; ?>

<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-4 col-sm-offser-4 padding-right">
        <?php
          if ($result) {
            echo '<p>Сообщение отправлено на указанный email</p>';
          }
          else {
            if (isset($errors) and isset($_POST['submit'])) {
              echo '<ul>';
              foreach ($errors as $error) {
                echo '<li>-' . $error . '</li>';
              }
            }
            echo '</ul>';
          }
        ?>
          <div class='signup-form'>
              <h2>Отправить письмо</h2>
              <form action='#' method='post'>
                <input type='email' name='email' placeholder='Почта' value='<?php echo $userEmail; ?>'/>
                <input type="text" name='userText' placeholder="Сообщение" value='<?php echo $userText; ?>'/>
                <button type='submit' name='submit' class='btn btn-default'>Отправить сообщение</button>
              </form>
            </div>
          <br />
        <br />
      </div>
    </div>
  </div>
</section>

<?php include ROOT . '/view/layouts/footer.php'; ?>
