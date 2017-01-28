<?php

    $max_string_length = 255;

  // is_blank('abcd')
  function is_blank($value='') {
    return !isset($value) || trim($value) == '';
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options=array()) {
    $length = strlen($value);
    if(isset($options['max']) && ($length > $options['max'])) {
      return false;
    } elseif(isset($options['min']) && ($length < $options['min'])) {
      return false;
    } elseif(isset($options['exact']) && ($length != $options['exact'])) {
      return false;
    } else {
      return true;
    }
  }

    function has_valid_string_length($value)
    {
        global $max_string_length;
        return has_length($value, ['max' => $max_string_length]); // max 255 characters
    }

    function has_valid_username_format($username)
    {
        return preg_match('/\A[A-Za-z0-9\_]+\Z/', $username); // A-Z, a-z, 0-9, and _
    }

    function has_valid_phone_number_format($phone_number)
    {
        return preg_match('/\A[0-9\(\)\-\s]+\Z/', $phone_number); // 0-9, spaces, (, ), -
    }

    /************************
     * MY CUSTOM VALIDATION *
     ************************/
    function has_valid_email_format($email)
    {
        return preg_match('/\A[A-Za-z0-9\_\.]+@[A-Za-z0-9\.]+\.[A-Za-z0-9]{2,}\Z/', $email); // legal characters in format _@_.__
    }

    /************************
     * MY CUSTOM VALIDATION *
     ************************/
    function has_valid_name_format($name)
    {
        return preg_match('/\A[A-Za-z\s\-\']+\Z/', $name); // letters, spaces, -, and '
    }

    /************************
     * MY CUSTOM VALIDATION *
     ************************/
    function has_valid_state_code_format($code)
    {
        return preg_match('/\A[A-Z]{2}+\Z/', $code); // exactly 2 uppercase letters
    }
    
    function validate_name($name, $name_type, &$errors)
    {
        global $max_string_length;
        if(is_blank($name))
        {
            $errors[] = $name_type . " name cannot be blank.";
        }
        else if(!has_valid_string_length($name))
        {
            $errors[] = $name_type . " name must not exceed " . $max_string_length . " characters.";
        }
        else if(!has_valid_name_format($name))
        {
            $errors[] = $name_type . " name may only contain letters, spaces, and the following symbols: hyphen, comma, and apostrophe.";
        }
    }

    function validate_first_name($first_name, &$errors)
    {
        validate_name($first_name, "First", $errors);
    }

    function validate_last_name($last_name, &$errors)
    {
        validate_name($last_name, "Last", $errors);
    }

    function validate_phone_number($phone_number, &$errors)
    {
        global $max_string_length;
        
        if(is_blank($phone_number))
        {
            $errors[] = "Phone number cannot be blank.";
        }
        else if(!has_valid_string_length($phone_number))
        {
            $errors[] = "Phone number must not exceed {$max_string_length} characters.";
        }
        else if(!has_valid_phone_number_format($phone_number))
        {
            $errors[] = "Phone number must only contain numbers, parentheses, dashes, and spaces.";
        }       
    }

    function validate_email($email, &$errors)
    {
        global $max_string_length;
        
        if(is_blank($email))
        {
            $errors[] = "Email cannot be blank.";
        }
        else if(!has_valid_string_length($email))
        {
            $errors[] = "Email must not exceed {$max_string_length} characters.";
        }
        else if(!has_valid_email_format($email))
        {
            $errors[] = "Email must be a valid format.";
        }
    }

    function validate_username($username, &$errors)
    {
        global $max_string_length;
        
        if(is_blank($username))
        {
            $errors[] = "Username cannot be blank.";
        }
        else if(!has_valid_string_length($username))
        {
            $errors[] = "Username must not exceed " . $max_string_length . " characters.";
        }
        else if(!has_valid_username_format($username))
        {
            $errors[] = "Username may only contain letters, spaces, and underscores.";
        }
    }

    /************************
     * MY CUSTOM VALIDATION *
     ************************/
    function validate_state_name($state_name, &$errors)
    {
        validate_name($state_name, "State", $errors);
    }

    /************************
     * MY CUSTOM VALIDATION *
     ************************/
    function validate_territory_name($territory_name, &$errors)
    {
        validate_name($territory_name, "Territory", $errors);
    }

    /************************
     * MY CUSTOM VALIDATION *
     ************************/
    function validate_state_code($code, &$errors)
    {
        if(is_blank($code))
        {
            $errors[] = "State code cannot be blank.";
        }
        else if(!has_valid_state_code_format($code))
        {
            $errors[] = "State code must consist of exactly 2 uppercase letters.";
        }
    }

    /************************
     * MY CUSTOM VALIDATION *
     ************************/
    function is_whole_number($str)
    {
        return preg_match('/\A[0-9]+\Z/', $str);
    }

    /************************
     * MY CUSTOM VALIDATION *
     ************************/
    function validate_territory_position($position, &$errors)
    {
        if(is_blank($position))
        {
            $errors[] = "Territory position cannot be blank.";
        }
        else if(!is_whole_number($position))
        {
            $errors[] = "Territory position must be a whole number.";
        }
    }

?>
