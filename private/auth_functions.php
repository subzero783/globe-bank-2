<?php

  // Performs all actions necessary to log in an admin
  function log_in($user) {
		// Renerating the ID protects the admin from session fixation.
    session_regenerate_id();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['last_login'] = time();
    $_SESSION['username'] = $user['username'];
    return true;
  }

  // Performs all actions necessary to log out an admin
  function log_out() {
    unset($_SESSION['user_id']);
    unset($_SESSION['last_login']);
    unset($_SESSION['username']);
    // session_destroy(); // optional: destroys the whole session
    return true;
  }


  // is_logged_in() contains all the logic for determining if a
  // request should be considered a "logged in" request or not.
  // It is the core of require_login() but it can also be called
  // on its own in other contexts (e.g. display one link if an admin
  // is logged in and display another link if they are not)
  function is_logged_in() {
    // Having a admin_id in the session serves a dual-purpose:
    // - Its presence indicates the admin is logged in.
    // - Its value tells which admin for looking up their record.
    return isset($_SESSION['user_id']);
  }

  // Call require_login() at the top of any page which needs to
  // require a valid login before granting acccess to the page.
  function require_login($path) {
    if(!is_logged_in()) {
      // redirect_to(url_for('/staff/login.php'));
      redirect_to(url_for($path));
    } else {
      // Do nothing, let the rest of the page proceed
    }
  }

  function log_in_verification($thePost, $path){
    $errors = [];
    $username = '';
    $password = '';
    if(is_post_request()) {
      $username = isset($thePost['username']) ? $thePost['username'] : '';
      $password = isset($thePost['password']) ? $thePost['password'] : '';

      if(is_blank($username)){
        $errors[] = "Username cannot be blank.";
      }
      if(is_blank($password)){
        $errors[] = "Password cannot be blank.";
      }
      // if there were no errors, try to log in
      if(empty($errors)){
        $login_failure_message = "Log in was unsuccessful.";
        $user = find_user_by_username($username);
        if($user){
          if(password_verify($password, $user['hashed_password'])){
            // password matches      
            log_in($user);
            // redirect_to(url_for('/staff/index.php'));
            redirect_to(url_for($path));
          }else{
            // username found, but password does not match
            return $errors[] = $login_failure_message;
          }
        }else{
          // no username found
          return $errors[] = $login_failure_message;
        }
      }
    }
  }

?>
