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
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                                </div>
                                
                                <div class="form-group">
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
