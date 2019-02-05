<?php include ROOT.'/view/layouts/header.php';?>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="left-sidebar">
                            <h2>Каталог</h2>
                            <?php foreach ($categories as $categoryItem): ?>
                            <div class="panel-group category-products">

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="/category/<?php echo $categoryItem['id']; ?>">
                                                <?php echo $categoryItem['name'];?></a></h4>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                        </div>
                    </div>

                    <div class="col-sm-9 padding-right">
                        <div class="features_items"><!--features_items-->
                            <h2 class="title text-center">Оформление заказа</h2>
                            <p>Для оформления заказа заполните форму. Наш менеджер свяжется с вами</p>
                            <?php
                              if ($result == true) {
                              echo "<h3 align='center'>Заказ принят. Мы вам перезвоним.</h3>";
                              $result = false;
                              }
                              else {
                                echo "<div class='signup-form'>
                                    <form action='#' method='post'>
                                      <input type='text' name='name' placeholder='Как ваш зовут?'/>
                                      <input type='text' name='numberTelephone' placeholder='Ваш номер телефона?'/>
                                      <input type='text' name='comment' placeholder='Комментарий к заказу'/>
                                      <button type='submit' name='submit' class='btn btn-default'>Оформить</button>
                                    </form>
                                    </div>";
                              }
                            ?>
                        </div><!--features_items-->
                    </div>
                </div>
            </div>
        </section>
<?php include ROOT.'/view/layouts/footer.php'; ?>
