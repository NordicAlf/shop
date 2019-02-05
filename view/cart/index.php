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
                            <h2 class="title text-center">Корзина</h2>
                            <table class="table-bordered table-striped table">
                              <tr>
                                <th>Код товара</th>
                                <th>Название</th>
                                <th>Количество</th>
                                <th>Стоимость</th>
                                <th>Удалить</th>
                              </tr>
                            <?php
                            $allPrice = 0;
                            foreach ($products as $product) {
                              echo '<tr>';
                                echo '<td>' . $product['code'] . '</td>';
                                echo '<td>' . $product['name'] . '</td>';
                                echo '<td>' . $product['count'] . '</td>';
                                echo '<td>' . $product['price'] . '$</td>';
                                echo "<td><center><a href=\"/cart/delete/$product[id]\">
                                  <img src=\"/template/images/product-details/delete.jpg\" width=\"25\" height=\"25\"</a></center></td>";
                              echo '</tr>';
                              $allPrice += $product['price'];
                            }
                            ?>
                            <tr>
                              <th colspan="3">Общая стоимость:</th>
                              <th><?php echo $allPrice . '$'; ?></th>
                            </tr>
                            </table>
                          <?php if ($allPrice != 0) {
                            echo "<form action='/cart/checkout'><button>Оформить заказ</button></form>";
                          }
                          ?>
                        </div><!--features_items-->
                    </div>
                </div>
            </div>
        </section>
<?php include ROOT.'/view/layouts/footer.php'; ?>
