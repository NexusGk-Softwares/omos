<style>
    .product-img-holder{
        width:100%;
        height:15em;
        overflow:hidden;
    }
    .product-img{
        width:100%;
        height:100%;
        object-fit: cover;
        object-position: center center;
        transition: all .3s ease-in-out;
    }
    .product-item:hover .product-img{
        transform: scale(1.2)
    }
</style>
<section class="py-3">
	<div class="container">
		<div class="content bg-gradient-maroon py-5 px-3">
			<h4 class="">Our Available Products</h4>
		</div>
		<div class="row mt-n3 justify-content-center">
            <div class="col-lg-10 col-md-11 col-sm-11 col-sm-11">
                <div class="card card-outline rounded-0">
                    <div class="card-body">
                        <div class="row row-cols-xl-4 row-md-6 col-sm-12 col-xs-12 gy-2 gx-2">
                            <?php 
                                $qry = $conn->query("SELECT *, (COALESCE((SELECT SUM(quantity) FROM `stock_list` where product_id = product_list.id and (expiration IS NULL or date(expiration) > '".date("Y-m-d")."') ), 0) - COALESCE((SELECT SUM(quantity) FROM `order_items` where product_id = product_list.id), 0)) as `available` FROM `product_list` where (COALESCE((SELECT SUM(quantity) FROM `stock_list` where product_id = product_list.id and (expiration IS NULL or date(expiration) > '".date("Y-m-d")."') ), 0) - COALESCE((SELECT SUM(quantity) FROM `order_items` where product_id = product_list.id), 0)) > 0 order by RAND()");
                                while($row = $qry->fetch_assoc()):
                            ?>
                            <div class="col">
                                <a class="card rounded-0 shadow product-item text-decoration-none text-reset" href="./?p=products/view_product&id=<?= $row['id'] ?>">
                                    <div class="position-relative">
                                        <div class="img-top position-relative product-img-holder">
                                            <img src="<?= validate_image($row['image_path']) ?>" alt="" class="product-img">
                                        </div>
                                        <div class="position-absolute bottom-1 right-1" style="bottom:.5em;right:.5em">
                                            <span class="badge badge-light bg-gradient-light border text-dark px-4 rounded-pill"><?= format_num($row['price'], 2) ?></span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div style="line-height:1em">
                                            <div class="card-title w-100 mb-0"><?= $row['name'] ?></div>
                                            <div class="card-description w-100"><small class="text-muted"><?= $row['brand'] ?></small></div>
                                            <div class="card-description w-100"><small class="text-muted">Stock: <?= format_num($row['available'],0) ?></small></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</section>