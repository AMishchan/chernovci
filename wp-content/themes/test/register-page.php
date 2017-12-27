<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package EasyWP
 */

if (isset($_POST['submit'])) {
echo '<pre>';
    print_r($_POST);
echo '</pre>';
    $reg_errors = registration_validation(
        $_POST['username'],
        $_POST['password'],
        $_POST['fname'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['contract'],
        $_POST['kwart'],
        $_POST['rememberme']
    );

    $username	= 	sanitize_user($_POST['username']);
    $password 	= 	esc_attr($_POST['password']);
    $email 		= 	sanitize_email($_POST['email']);
    $first_name = 	sanitize_text_field($_POST['fname']);
    $phone 	    = 	sanitize_text_field($_POST['phone']);
    $contract 	    = 	sanitize_text_field($_POST['contract']);
    $kwart 	    = 	sanitize_text_field($_POST['kwart']);

    if (!$reg_errors->errors) {
        global $username, $password, $email, $first_name, $phone, $contract, $kwart;

        $completed = complete_registration($username, $password, $email,
            $first_name, $phone, $contract, $kwart
        );

         wp_signon();
    }

}
?>

<?php get_header(); ?>

<div class="container">
    <div class="row">

        <?php get_sidebar();?>

        <div class="col-sm-6" style="padding-bottom: 10px;">

            <?php

                if (isset($completed) && $completed === true) {
                    echo '<a href="' . get_site_url() . '/osobistij-kabinet">В кабинет</a>';
                } else {
            ?>

                    <?php if ( isset( $reg_errors ) ) : ?>
                        <?php foreach ($reg_errors->get_error_messages() as $error) : ?>

                                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">x</span></button>
                                <p><?= $error ?></p>
                                </div>

                        <?php  endforeach;  ?>
                    <?php endif; ?>

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




                            <input id="rememberme" type="hidden" class="form-control" name="rememberme" value="1" required>


                    <div class="form-group">
                        <div class="col-md-12">
                            <br />
                            <input type="submit" name="submit" class="btn btn-primary" value="Реєстрація"/>
                        </div>
                    </div>
                </form>

            <?php } ?>

        </div>

        <?php get_sidebar('right'); ?>

    </div>
</div>

<?php get_footer(); ?>




