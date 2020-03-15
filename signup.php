<?php 
    require_once("layout/header.php");
?>

        <!-- Main content -->
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <div class="card my-4">
                        <div class="card-body">
                            <form action="<?= getRequestURL("signup")?>" method="post" class="container">
                                    <?php if(isset($_GET['error']) && $_GET['error'] == 'noform'):?>
                                        <p style="color: #ff6677;">Please use the form to login</p>
                                    <?php endif; ?>
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="fname">First Name</label>
                                        <input type="text" class="form-control" name="fname" aria-describedby="emailHelp" placeholder="Enter First Name">
                                    </div>
                                    <div class="form-group col">
                                        <label for="lname">Last Name</label>
                                        <input type="text" class="form-control" name="lname" aria-describedby="emailHelp" placeholder="Enter Last Name">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col">
                                        <?php if(isset($_GET['error']) && $_GET['error'] == 'mailused'):?>
                                            <p style="color: #ff6677;">Email already in use</p>
                                        <?php endif; ?>
                                        <?php if(isset($_GET['mail'])):?>
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="<?= $_GET['mail']?>">
                                        <?php else: ?>
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php if(isset($_GET['error']) && $_GET['error'] == 'wrongpass'):?>
                                    <p style="color: #ff6677;">Passwords don't match</p>
                                <?php endif; ?>
                                <div class="row">
                                        
                                    <div class="form-group col">
                                        
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                    </div>

                                    <div class="form-group col">
                                        <label for="passwordrepeat">Repeat Password</label>
                                        <input type="password" class="form-control" name="passwordrepeat" placeholder="Repeat Password">
                                    </div>
                                </div>
                                <?php //var_dump($dbx->select("SELECT * FROM user")); ?>
                                <div class="row mt-3">
                                    <input type="submit" class=" col btn btn-primary" value="Sign Up" >
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("layout/footer.php") ?>
