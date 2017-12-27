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
?>
<?php

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        global $reg_errors;

        $reg_errors = new WP_Error;

        $user = wp_authenticate( $_POST['username'], $_POST['password'] );

        // авторизация не удалась
        if ( is_wp_error($user) ) {
            $reg_errors->add('password', 'Неправильный пароль или логин');
        } else {
            wp_signon();
            wp_redirect(get_site_url().'/osobistij-kabinet');
        }
    }

?>
<?php get_header(); ?>

<div class="container">
    <div class="row">

        <?php get_sidebar();?>

        <div class="col-sm-6">

            <?php
                if ( isset( $reg_errors ) ) {

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

                <form name="loginform" id="loginform" action="" method="post">

                <div class="form-group<?php if(isset($reg_errors) && $reg_errors->get_error_message('password')) echo ' has-error' ?>">
                    <label for="user_login" class="col-md-12 control-label">Имя пользователя или e-mail</label>

                    <div class="col-md-12">
                        <input id="user_login" type="text" class="form-control" name="username" value="" required autofocus>
                    </div>
                </div>

                <div class="form-group<?php if(isset($reg_errors) && $reg_errors->get_error_message('password')) echo ' has-error' ?>">
                    <label for="user_pass" class="col-md-12 control-label">Пароль</label>

                    <div class="col-md-12">
                        <input id="user_pass" type="password" class="form-control" name="password" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="rememberme"> Запомнить меня
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-primary" value="Войти">
                        <input type="hidden" name="redirect_to" value="<?php echo get_site_url()?>/osobistij-kabinet">
                    </div>
                </div>

            </form>

            <hr>
            <div class="row">
                <div class="col-md-12">
                    <a href="/registraciya">Реєстрація</a>
                </div>
            </div>

        </div>

        <?php get_sidebar('right'); ?>

    </div>
</div>
<?php get_footer(); ?>




