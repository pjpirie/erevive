<?php 
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);
require_once("layout/header.php");
?>


<!-- Main content -->
<div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <div class="card my-4">
                        <div class="card-body">
                            <form action="<?= getRequestURL("role")?>" method="post">
                            <h1 style="text-align: center;">Role Update Form</h1>
                            <input type="text" style="display: none;"class="form-control" name="id" value="<?= $_SESSION['user']['id']?>">
                                    <?php if(isset($_GET['error']) && $_GET['error'] == 'noform'):?>
                                        <p style="color: #ff6677;">Please use the form to edit items</p>
                                    
                                    <?php endif; ?>
                                    <?php 
                                        // var_dump($prod); 
                                        // exit;
                                        $currentUser = $user['id'] == getUserID() ? " - Current User" : " no";
                                    ?>
                                <div class="form-group">
                                    <label for="admin-user">Select User</label>
                                    <select class="form-control" id="admin-user" name="admin-user">
                                        <?php $users = $dbx->select("SELECT user.*, roles.role_title as 'role' FROM user INNER JOIN user_roles on user.id = user_roles.user_id INNER JOIN roles on user_roles.role_id = roles.role_id");?>                                    
                                        <?php foreach($users as $user): ?>
                                            <option value="<?=$user['id']?>"><?= ("{$user['role']} - {$user['first_name']} {$user['last_name']}" . ($user['id'] == getUserID() ? " - Current User" : "")); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="admin-role">Select Role</label>
                                    <select class="form-control" id="admin-role" name="admin-role">
                                        <?php $roles = $dbx->select("SELECT roles.role_id, roles.role_title as 'role' FROM roles");?>                                    
                                        <?php foreach($roles as $role): ?>
                                            <option value="<?=$role['role_id']?>"><?= ("{$role['role']}"); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                        <label for="admin-pwd">Your Password</label>
                                        <input type="password" class="form-control" name="admin-pwd" placeholder="Enter Your Password"> 
                                </div>
                                
                                
                                <input type="submit" class="btn btn-success float-right" value="Update User" >
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<?php require_once("layout/footer.php")?>