<?php
//
///*
//  Plugin Name: Custom Registration
//  Plugin URI: http://code.tutsplus.com
//  Description: Updates user rating based on number of posts.
//  Version: 1.0
//  Author: Agbonghama Collins
//  Author URI: http://tech4sky.com
// */
//
//function custom_registration_function() {
//    if (isset($_POST['submit'])) {
//        registration_validation(
//        $_POST['username'],
//        $_POST['fname'],
//        $_POST['lname'],
//        $_POST['password'],
//        $_POST['email'],
//        $_POST['phone'],
//        $_POST['personal_acc_num'],
//        $_POST['last_payment']
//		);
//
//		// sanitize user form input
//        global $username, $password, $email, $first_name, $last_name, $phone, $personal_acc_num, $last_payment;
//        $username	= 	sanitize_user($_POST['username']);
//        $password 	= 	esc_attr($_POST['password']);
//        $email 		= 	sanitize_email($_POST['email']);
//        $first_name = 	sanitize_text_field($_POST['fname']);
//        $last_name 	= 	sanitize_text_field($_POST['lname']);
//        $phone 	= 	sanitize_text_field($_POST['phone']);
//        $personal_acc_num 	= 	sanitize_text_field($_POST['personal_acc_num']);
//        $last_payment 	= 	sanitize_text_field($_POST['last_payment']);
//
//
//
//		// call @function complete_registration to create the user
//		// only when no WP_error is found
//        complete_registration($username, $password, $email,
//            $first_name, $last_name, $phone, $personal_acc_num, $last_payment
//		);
//    }
//
//    registration_form($username, $password, $email,
//            $first_name, $last_name, $phone, $personal_acc_num, $last_payment
//		);
//}
//
//function registration_form( $username, $password, $email, $first_name, $last_name, $phone, $personal_acc_num, $last_payment ) {
//    echo '
//    <style>
//	div {
//		margin-bottom:2px;
//	}
//
//	input{
//		margin-bottom:4px;
//	}
//	</style>
//	';
//
//    echo '
//    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
//	<div>
//	<label for="username">Username <strong>*</strong></label>
//	<input type="text" name="username" value="' . (isset($_POST['username']) ? $username : null) . '">
//	</div>
//
//	<div>
//	<label for="password">Password <strong>*</strong></label>
//	<input type="password" name="password" value="' . (isset($_POST['password']) ? $password : null) . '">
//	</div>
//
//	<div>
//	<label for="email">Email <strong>*</strong></label>
//	<input type="text" name="email" value="' . (isset($_POST['email']) ? $email : null) . '">
//	</div>
//
//	<div>
//	<label for="phone">Phone</label>
//	<input type="text" name="phone" value="' . (isset($_POST['phone']) ? $phone : null) . '">
//	</div>
//
//	<div>
//	<label for="fname">First Name</label>
//	<input type="text" name="fname" value="' . (isset($_POST['fname']) ? $first_name : null) . '">
//	</div>
//
//	<div>
//	<label for="lname">Last Name</label>
//	<input type="text" name="lname" value="' . (isset($_POST['lname']) ? $last_name : null) . '">
//	</div>
//
//	<div>
//	<label for="personal_acc_num">Personal_acc_num</label>
//	<input type="text" name="personal_acc_num" value="' . (isset($_POST['personal_acc_num']) ? $personal_acc_num : null) . '">
//	</div>
//
//	<div>
//	<label for="last_payment">Last Payment</label>
//	<input type="text" name="last_payment">' . (isset($_POST['last_payment']) ? $last_payment : null) . '</input>
//	</div>
//	<input type="submit" name="submit" value="Register"/>
//	</form>
//	';
//}
//
//function registration_validation( $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio )  {
//    global $reg_errors;
//    $reg_errors = new WP_Error;
//
//    if ( empty( $username ) || empty( $password ) || empty( $email ) ) {
//        $reg_errors->add('field', 'Required form field is missing');
//    }
//
//    if ( strlen( $username ) < 4 ) {
//        $reg_errors->add('username_length', 'Username too short. At least 4 characters is required');
//    }
//
//    if ( username_exists( $username ) )
//        $reg_errors->add('user_name', 'Sorry, that username already exists!');
//
//    if ( !validate_username( $username ) ) {
//        $reg_errors->add('username_invalid', 'Sorry, the username you entered is not valid');
//    }
//
//    if ( strlen( $password ) < 5 ) {
//        $reg_errors->add('password', 'Password length must be greater than 5');
//    }
//
//    if ( !is_email( $email ) ) {
//        $reg_errors->add('email_invalid', 'Email is not valid');
//    }
//
//    if ( email_exists( $email ) ) {
//        $reg_errors->add('email', 'Email Already in use');
//    }
//
//    if ( !empty( $website ) ) {
//        if ( !filter_var($website, FILTER_VALIDATE_URL) ) {
//            $reg_errors->add('website', 'Website is not a valid URL');
//        }
//    }
//
//    if ( is_wp_error( $reg_errors ) ) {
//
//        foreach ( $reg_errors->get_error_messages() as $error ) {
//            echo '<div>';
//            echo '<strong>ERROR</strong>:';
//            echo $error . '<br/>';
//
//            echo '</div>';
//        }
//    }
//}
//
//function complete_registration() {
//    global $reg_errors, $username, $password, $email, $website, $first_name, $last_name, $nickname, $bio;
//    if ( count($reg_errors->get_error_messages()) < 1 ) {
//        $userdata = array(
//        'user_login'	=> 	$username,
//        'user_email' 	=> 	$email,
//        'user_pass' 	=> 	$password,
//        'user_url' 		=> 	$website,
//        'first_name' 	=> 	$first_name,
//        'last_name' 	=> 	$last_name,
//        'nickname' 		=> 	$nickname,
//        'description' 	=> 	$bio,
//		);
//        $user = wp_insert_user( $userdata );
//        echo 'Registration complete. Goto <a href="' . get_site_url() . '/wp-login.php">login page</a>.';
//	}
//}
//
//// Register a new shortcode: [cr_custom_registration]
//add_shortcode('cr_custom_registration', 'custom_registration_shortcode');
//
//// The callback function that will replace [book]
//function custom_registration_shortcode() {
//    ob_start();
//    custom_registration_function();
//    return ob_get_clean();
//}