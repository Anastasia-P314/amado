
<?php
require '../vendor/autoload.php';
use JasonGrimes\Paginator;
?>

<?php $this->layout('template', ['title' => 'Shop']) ?>
    <div class="amado_product_area section-padding-100">
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-8">
                    <div class="product-topbar d-xl-flex align-items-end justify-content-between">
                        <!-- Total Products -->
                        <div class="total-products">
                            <p>
                            Showing 
                            <?php echo $paginator->getCurrentPageFirstItem(); ?>-<?php echo $paginator->getCurrentPageLastItem(); ?> 
                            of <?php echo $paginator->getTotalItems(); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                <!-- Button Group -->
                    <div class="amado-btn-group float-right" style="align-self: right;">
                        <a href="/addnew" class="btn amado-btn">Add product</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php foreach($result_per_page as $product): ?>
                <!-- Single Product Area -->
                <div class="col-12 col-sm-6 col-md-12 col-xl-6">
                    <div class="single-product-wrapper">
                        <!-- Product Image -->
                        <div class="product-img">
                            <img src="<?=$this->e($product['image'])?>" alt="">
                            <!-- Hover Thumb -->
                            <!-- <img class="hover-img" src="<?php //$this->e($product['hover_img'])?>" alt=""> -->
                        </div>

                        <!-- Product Description -->
                        <div class="product-description d-flex align-items-center justify-content-between">
                            <!-- Product Meta Data -->
                            <div class="product-meta-data">
                                <div class="line"></div>
                                <p class="product-price"><?=$this->e($product['price'])?></p>
                                <a href="product_details<?php echo '?id='.$product['id']?>">
                                    <h6><?=$this->e($product['name'])?></h6>
                                </a>
                            </div>
                            <!-- Ratings & Cart -->
                            <div class="ratings-cart text-right">
                                <div class="ratings">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
<!--                                     <div class="cart">
                                    <a href="cart.html" data-toggle="tooltip" data-placement="left" title="Add to Cart"><img src="img/core-img/cart.png" alt=""></a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>                    
            </div>


            <div class="row">
                <div class="col-12">
                    <!-- Pagination -->
                    <nav aria-label="navigation">
                        <ul class="pagination justify-content-end mt-50">
                            <?php if ($paginator->getPrevUrl()): ?>
                                <li class="page-item"><a class="page-link" href="<?php echo $paginator->getPrevUrl(); ?>">&laquo; Previous</a></li>
                            <?php endif; ?>

                            <?php foreach ($paginator->getPages() as $page): ?>
                                <?php if ($page['url']): ?>
                                    
                                    <li <?php if(isset($_GET['page'])){if($page['num']==$_GET['page']) {echo 'class="page-item active"';} else {echo 'class="page-item"';}} else {if($page['num']==1){echo 'class="page-item active"';}else{echo 'class="page-item"';}}?>>
                                        <a class="page-link" href="<?php echo $page['url'];?>"><?php echo $page['num']; ?></a>
                                    </li>
                                <?php else: ?>
                                    <li class="page-item"><span><?php echo $page['num']; ?></span></li>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <?php if ($paginator->getNextUrl()): ?>
                                <li class="page-item"><a class="page-link" href="<?php echo $paginator->getNextUrl(); ?>">Next &raquo;</a></li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
 


    
