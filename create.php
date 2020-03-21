<?php 
    require_once("layout/header.php");
    $id = $_GET['item'];
?>

        <!-- Main content -->
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <div class="card my-4">
                        <div class="card-body">
                            <form action="<?= getRequestURL("create")?>" method="post">
                            <input type="text" style="display: none;"class="form-control" name="id" value="<?= getUserID() ?>">
                                    <?php if(isset($_GET['error']) && $_GET['error'] == 'noform'):?>
                                        <p style="color: #ff6677;">Please use the form to edit items</p>
                                    
                                    <?php endif; ?>
                                <div class="form-group">
                                        <label for="imageURL">Image URL</label>
                                        <input type="text" class="form-control" name="imageURL"  placeholder="Enter Image URL" > 
                                </div>
                                <div class="form-group">
                                        <label for="prod-name">Product Name</label>
                                        <input type="text" class="form-control" name="prod-name" placeholder="Enter Product Name" required> 
                                </div>
                                <div class="form-group">
                                        <label for="prod-desc">Product Description</label>
                                        <input type="text" class="form-control" name="prod-desc" placeholder="Enter Product Description" required> 
                                </div>
                                <div class="form-group">
                                        <label for="prod-price">Product Price</label>
                                        <input type="text" class="form-control" name="prod-price" placeholder="Enter Product Price" required> 
                                </div>
                                <div class="form-group">
                                        <label for="prod-brand">Product Brand</label>
                                        <input type="text" class="form-control" name="prod-brand" placeholder="Enter Product Brand" required> 
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="prod-cat" name="prod-cat" required>
                                        <?php $categories = $dbx->select("SELECT * FROM category");?>
                                        <?php foreach($categories as $cat): ?>
                                            <option  value="<?=$cat['id']?>"><?=$cat['category_name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <input type="submit" class="btn btn-success float-right" value="Apple Changes" >
                            </form>
                            <form action="<?=getURL('market')?>" method="post">
                                <input type="submit" class="btn btn-danger float-right mr-2" value="Cancel" >
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("layout/footer.php") ?>
