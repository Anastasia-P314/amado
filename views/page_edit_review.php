<?php 

$this->layout('template', ['title' => 'page_register']) ?>


        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-lg-4 ">
                        <div class="checkout_details_area mt-50 clearfix ">

                            <div class="cart-title">
                                <h2>Review</h2>
                            </div>

                            <form action="/update_review<?php echo '?id='.$review['review_id']; ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name='id' value="<?php echo $_GET['id'];?>">
                                <input type="hidden" name='product_id' value="<?php echo $review['product_id'];?>">
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <textarea class="form-control h-500" placeholder="" name="description"><?php echo $review['text'] ?></textarea>
                                    </div>
                                </div>

                                <?php if($_SESSION['auth_roles']=='1'): ?>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <select class="col-lg-12 mb-3 w-100" name="status">
                                            <option>Show</option>
                                            <option>Hide</option>
                                        </select>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <div class="cart-btn mt-30">
                                    
                                    <button type="submit" class="btn amado-btn w-100">Edit review</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>