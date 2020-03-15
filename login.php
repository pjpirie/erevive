<?php 
    require_once("layout/header.php");
?>

        <!-- Main content -->
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <div class="card my-4">
                        <div class="card-body">
                            <form action="<?= getRequestURL("login")?>" method="post">
                                    <?php if(isset($_GET['error']) && $_GET['error'] == 'noform'):?>
                                        <p style="color: #ff6677;">Please use the form to login</p>
                                    <?php endif; ?>
                                <div class="form-group">
                                    <?php if(isset($_GET['error']) && $_GET['error'] == 'wrongmail'):?>
                                        <p style="color: #ff6677;">Email incorrect</p>
                                    <?php endif; ?>
                                    <?php if(isset($_GET['mail'])):?>
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="<?= $_GET['mail']?>">
                                    <?php else: ?>
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                                    <?php endif; ?>
                                </div>
                                
                                <div class="form-group">
                                    <?php if(isset($_GET['error']) && $_GET['error'] == 'wrongpass'):?>
                                        <p style="color: #ff6677;">Password incorrect</p>
                                    <?php endif; ?>
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                                
                                <input type="submit" class="btn btn-primary" value="Login" >
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("layout/footer.php") ?>
