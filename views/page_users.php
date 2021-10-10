<?php $this->layout('template', ['title' => 'page_users']) ?>

        <div class="single-product-area section-padding-100 clearfix">
            <div class="container-fluid">

                <h2>All users</h2>

                <?php foreach($users as $user): ?>
                    <div class="row justify-content-start">
                        <div class="col-6 col-sm-3"><?php echo $user['username'] ?></div>
                        <div class="col-6 col-sm-3"><?php if($_SESSION['auth_roles']=='1'){echo $user['roles_mask'];} ?></div>
                        <div class="d-flex justify-content-end">
                            <a class="p-1" href="/delete_user<?php echo '?id='.$user['id'];?>">
                                <?php if($_SESSION['auth_roles']=='1' or $_SESSION['auth_user_id']==$user['id']){echo 'Delete';} ?>    
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
