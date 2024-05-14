<?php 

if(isset($_SESSION['message']))
{
    ?>
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
        <?= $_SESSION['message'] ?>
    </div>
    
    <?php
    unset($_SESSION['message']);
}

?>
