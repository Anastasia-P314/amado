<?php $this->layout('template', ['title' => 'product_details']) ?>

        <!-- Product Details Area Start -->
        <div class="single-product-area section-padding-100 clearfix">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mt-50">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item"><a href="#"><?php echo $category_title?></a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $product['name']?></li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-7">
                        <div class="single_product_thumb">
                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li class="active" data-target="#product_details_slider" data-slide-to="0" style='background-image: url(<?php echo $product["image"] ?>)'>
                                    </li>
                                    <li data-target="#product_details_slider" data-slide-to="1" style="background-image: url(img/product-img/pro-big-2.jpg);">
                                    </li>
                                    <li data-target="#product_details_slider" data-slide-to="2" style="background-image: url(img/product-img/pro-big-3.jpg);">
                                    </li>
                                    <li data-target="#product_details_slider" data-slide-to="3" style="background-image: url(img/product-img/pro-big-4.jpg);">
                                    </li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <a class="gallery_img" href="<?php echo $product['image']?>">
                                            <img class="d-block w-100" style="height: 723px; width: 747px;" src="<?php echo $product['image']?>" alt="First slide">
                                        </a>
                                    </div>
                                    <div class="carousel-item">
                                        <a class="gallery_img" href="img/product-img/pro-big-2.jpg">
                                            <img class="d-block w-100" src="img/product-img/pro-big-2.jpg" alt="Second slide">
                                        </a>
                                    </div>
                                    <div class="carousel-item">
                                        <a class="gallery_img" href="img/product-img/pro-big-3.jpg">
                                            <img class="d-block w-100" src="img/product-img/pro-big-3.jpg" alt="Third slide">
                                        </a>
                                    </div>
                                    <div class="carousel-item">
                                        <a class="gallery_img" href="img/product-img/pro-big-4.jpg">
                                            <img class="d-block w-100" src="img/product-img/pro-big-4.jpg" alt="Fourth slide">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="single_product_desc">
                            <!-- Product Meta Data -->
                            <div class="product-meta-data">
                                <div class="line"></div>
                                <p class="product-price"><?php echo $product['price']?></p>
                                <a href="">
                                    <h6><?php echo $product['name']?></h6>
                                </a>
                                <!-- Ratings & Review -->
                                <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                                    <div class="ratings">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <!-- Avaiable -->
<!--                                 <p class="avaibility"><i class="fa fa-circle"></i> In Stock</p> -->
                            </div>

                            <div class="short_overview my-5">
                                <p><?php echo $product['description']?></p>
                            </div>

                            <div class="">
                                <a href="/edit<?php echo '?id='.$product['id']; ?>"><button type="button" name="edit" class="btn amado-btn">Edit</button></a>
                                <a href="/delete<?php echo '?id='.$product['id'];?>"><button type="button" name="delete" class="btn amado-btn active">Delete</button></a>
                            </div>
                        </div>

                        <div class="my-5">
                            <h6>Reviews</h6>

                            <?php foreach($reviews as $review): ?>
                            <div class="p-3 mb-2 bg-light"> 
                                <p class="font-weight-bold text-dark"><?php echo $review['username'] ?>:</p>
                                <p><?php echo $review['text'] ?></p>
                                <div class="d-flex justify-content-end">
                                    <a class="p-1" href="/edit_review<?php echo '?id='.$review['review_id']; ?>">Edit review</a>
                                    <a class="p-1" href="/delete_review<?php echo '?id='.$review['review_id'];?>">Delete review</a>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="review">
                            <a href="/new_review<?php echo '?id='.$product['id']; ?>"><button type="button" name="edit" class="btn amado-btn">Write A Review</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Details Area End -->