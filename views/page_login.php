<?php $this->layout('template', ['title' => 'page_login']) ?>


        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-lg-4 ">
                        <div class="checkout_details_area mt-50 clearfix ">

                            <div class="cart-title">
                                <h2>Login</h2>
                            </div>

                            <div class="flashes">
                                <?php echo flash()->display(); ?>
                            </div>

                            <form action="/login_check" method="post">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <input type="email" class="form-control" id="email" placeholder="Email" name ="email" value="">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="password" class="form-control" id="password" placeholder="Password" name ="password" value="">
                                    </div>
                                </div>

                                <div class="cart-btn mt-100">
                                    <button type="submit" class="btn amado-btn w-100">Login</button>
                                </div>
                            </form>

                            <div class="blankpage-footer text-center" style="margin-top: 20px;">
                                No account yet? <a href="/register"><strong>Register</strong>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

