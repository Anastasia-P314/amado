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

                            <form action="/save_review" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name='id' value="<?php echo $_GET['id'];?>">
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <textarea class="form-control h-500" placeholder="Text" name="description"></textarea>
                                    </div>
                                </div>

                                <div class="cart-btn mt-30">
                                    
                                    <button type="submit" class="btn amado-btn w-100">Save review</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 
