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
                                            <a href="/category/<?php echo $categoryItem['id']; ?>"
                                                class="<?php if ($categoryId == $categoryItem['id']) echo 'active'; ?>">
                                                <?php echo $categoryItem['name'];?></a></h4>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                        </div>
                    </div>

                    <div class="col-sm-9 padding-right">
                        <div class="features_items"><!--features_items-->
                            <h2 class="title text-center">Последние товары</h2>
                            <?php foreach ($productsCategory as $itemProduct): ?>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="<?php echo Product::getImage($itemProduct['id']); ?>" alt="" />
                                                <h2><?php echo $itemProduct['price']?>$</h2>
                                                <p>
                                                   <a href="/product/<?php echo $itemProduct['id']; ?>"><?php echo $itemProduct['name']; ?></a>
                                                </p>
                                                <a href="/cart/add/<?php echo $itemProduct['id']; ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                            </div>
                                            <?php if ($itemProduct['is_new'] == 1): ?>
                                            <img src="/template/images/home/new.png" class="new" alt=""/>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                          <!--Постраничная навигация-->
                          <?php echo $pagination->get(); ?>
                        </div><!--features_items-->
                    </div>
                </div>
            </div>
        </section>
<?php include ROOT.'/view/layouts/footer.php'; ?>
