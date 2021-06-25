<?php

class LoginController {
  public static function validate_login($post) {
    $email = "admin@mail.com";
    $password = "123456";

    if ($email == $post["email"] && $password == $post["password"]) {      
      return true;
    }

    return false;

  }
}
