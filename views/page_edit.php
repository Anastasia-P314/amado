<?php 
use App\Models\QueryBuilder;

$this->layout('template', ['title' => 'page_register']) ?>


        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-lg-4 ">
                        <div class="checkout_details_area mt-50 clearfix ">

                            <div class="cart-title">
                                <h2>Edit product</h2>
                            </div>

                            <div class="flashes">
                                <?php echo flash()->display(); ?>
                            </div>

                            <form action="/update<?php echo '?id='.$product['id']; ?>" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-8 mb-3">
                                        <input type="text" class="form-control" value='<?php echo $product["name"] ?>' placeholder="Name" name="name" required>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <input type="text" class="form-control" value='<?php echo $product["price"] ?>' placeholder="Price" name="price" required>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <textarea type="text" class="form-control h-100" placeholder="Description" name="description"><?php echo $product["description"] ?></textarea>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="col-lg-12 mb-3" for="">Category</label>
                                        <select class="col-lg-12 mb-3 w-100" name="category">
                                            <?php foreach($categories as $category): ?>
                                                <option value="<?php echo $category['category_id'] ?>"<?php if($product["category"]==$category['category_id']){echo 'selected';} ?>><?php echo $category['category_title'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label class="col-lg-12 mb-3" for="">Status</label>
                                        <select class="col-lg-12 mb-3 w-100" name="status">
                                          <option>Show</option>
                                          <option <?php if($product["status"]=='Hide'){echo 'selected';} ?>>Hide</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Image</label>
                                        <input type="file" class="form-control-file" name="image">
                                    </div>
                                </div>

                                <div class="cart-btn mt-30">
                                    <button type="submit" class="btn amado-btn w-100">Edit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
