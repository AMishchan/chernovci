<?php
/**
 * Template part for displaying a form register.
 */

if ( isset( $reg_errors ) ) {
    print_r($reg_errors);die;
    foreach ( $reg_errors->get_error_messages() as $error ) {
        echo '
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">x</span></button>
            <p>' . $error . '</p>
            </div>
        ';
    }
}
?>


<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" >

    <div class="form-group<?php if(isset($reg_errors) && $reg_errors->get_error_message('username')) echo ' has-error' ?>">
        <label for="username" class="col-md-12 control-label">Логин <strong>*</strong></label>

        <div class="col-md-12">
            <input type="text" class="form-control" name="username" value="<?=  (isset($_POST['username']) ? $username : null) ?>" required>
        </div>
    </div>

    <div class="form-group<?php if(isset($reg_errors) && $reg_errors->get_error_message('fname')) echo ' has-error' ?>">
        <label for="fname" class="col-md-12 control-label">П.І.Б <strong>*</strong></label>

        <div class="col-md-12">
            <input type="text" class="form-control" name="fname" value="<?=  (isset($_POST['fname']) ? $fname : null)  ?>" required>
        </div>
    </div>

    <div class="form-group<?php if(isset($reg_errors) && $reg_errors->get_error_message('password')) echo ' has-error' ?>">
        <label for="password" class="col-md-12 control-label">Пароль <strong>*</strong></label>

        <div class="col-md-12">
            <input type="password" class="form-control" name="password" value="<?=  (isset($_POST['password']) ? $password : null)  ?>" required>
        </div>
   </div>

    <div class="form-group<?php if(isset($reg_errors) && $reg_errors->get_error_message('email')) echo ' has-error' ?>">
        <label for="email" class="col-md-12 control-label">Електронна адреса <strong>*</strong></label>

        <div class="col-md-12">
            <input type="email" class="form-control" name="email" value="<?= (isset($_POST['email']) ? $email : null)  ?>" required>
        </div>
   </div>

    <div class="form-group<?php if(isset($reg_errors) && $reg_errors->get_error_message('phone')) echo ' has-error' ?>">
        <label for="phone" class="col-md-12 control-label">Номер телефону <strong>*</strong></label>

        <div class="col-md-12">
            <input type="text" class="form-control" id="phone" name="phone" value="<?= (isset($_POST['phone']) ? $phone : null)  ?>" required>
        </div>
   </div>

    <div class="form-group<?php if(isset($reg_errors) && $reg_errors->get_error_message('contract')) echo ' has-error' ?>">
        <label for="contract" class="col-md-12 control-label">Номер особового рахунку <strong>*</strong></label>

        <div class="col-md-12">
            <input type="text" id="contract" class="form-control" name="contract" value="<?= (isset($_POST['contract']) ? $contract : null)  ?>" required>
        </div>
   </div>

    <div class="form-group<?php if(isset($reg_errors) && $reg_errors->get_error_message('kwart')) echo ' has-error' ?>">
        <label for="kwart" class="col-md-12 control-label">Номер квартиры <strong>*</strong></label>

        <div class="col-md-12">
            <input id="kwart" type="text" class="form-control" name="kwart" value="<?= (isset($_POST['kwart']) ? $kwart : null) ?>" required>
        </div>
   </div> 
   
   <div class="form-group">
        <div class="col-md-12">
        <br />
            <input type="submit" name="submit" class="btn btn-primary" value="Реєстрація"/>
        </div>
   </div> 
</form>


