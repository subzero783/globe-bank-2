<?php

// is_blank('abcd')
// * validate data presence
// * uses trim() so empty spaces don't count
// * uses === to avoid false positives
// * better than empty() which considers "0" to be empty
function is_blank($value) {
	return !isset($value) || trim($value) === '';
}

// has_presence('abcd')
// * validate data presence
// * reverse of is_blank()
// * I prefer validation names with "has_"
function has_presence($value) {
	return !is_blank($value);
}

// has_length_greater_than('abcd', 3)
// * validate string length
// * spaces count towards length
// * use trim() if spaces should not count
function has_length_greater_than($value, $min) {
	$length = strlen($value);
	return $length > $min;
}

// has_length_less_than('abcd', 5)
// * validate string length
// * spaces count towards length
// * use trim() if spaces should not count
function has_length_less_than($value, $max) {
	$length = strlen($value);
	return $length < $max;
}

// has_length_exactly('abcd', 4)
// * validate string length
// * spaces count towards length
// * use trim() if spaces should not count
function has_length_exactly($value, $exact) {
	$length = strlen($value);
	return $length == $exact;
}

// has_length('abcd', ['min' => 3, 'max' => 5])
// * validate string length
// * combines functions_greater_than, _less_than, _exactly
// * spaces count towards length
// * use trim() if spaces should not count
function has_length($value, $options) {
	if(isset($options['min']) && !has_length_greater_than($value, $options['min'])) {
		return false;
	} elseif(isset($options['max']) && !has_length_less_than($value, $options['max'])) {
		return false;
	} elseif(isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
		return false;
	} else {
		return true;
	}
}

// has_inclusion_of( 5, [1,3,5,7,9] )
// * validate inclusion in a set
function has_inclusion_of($value, $set) {
	return in_array($value, $set);
}

// has_exclusion_of( 5, [1,3,5,7,9] )
// * validate exclusion from a set
function has_exclusion_of($value, $set) {
	return !in_array($value, $set);
}

// has_string('nobody@nowhere.com', '.com')
// * validate inclusion of character(s)
// * strpos returns string start position or false
// * uses !== to prevent position 0 from being considered false
// * strpos is faster than preg_match()
function has_string($value, $required_string) {
	return strpos($value, $required_string) !== false;
}

// has_valid_email_format('nobody@nowhere.com')
// * validate correct format for email addresses
// * format: [chars]@[chars].[2+ letters]
// * preg_match is helpful, uses a regular expression
//    returns 1 for a match, 0 for no match
//    http://php.net/manual/en/function.preg-match.php
function has_valid_email_format($value) {
	$email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
	return preg_match($email_regex, $value) === 1;
}

function has_unique_page_menu_name($menu_name, $current_id = '0'){
		try{
			global $db;
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $db->prepare("SELECT * FROM pages WHERE menu_name = ? AND id != ?");
			$stmt->bindValue(1, $menu_name);
			$stmt->bindValue(2, $current_id);
			$stmt->execute();
			$errorInfo = $db->errorInfo();
			if(isset($errorInfo[2])){
				$error = $errorInfo[2];
			}
		} catch (Exception $e) {
			$error = $e->getMessage();
		}
		if(isset($error)) {
			echo "<p>$error</p>";
		}else{
			$rowCount = $stmt->rowCount();
			return $rowCount == 0;
		}
		$stmt = null;
	}

function has_unique_username($username, $current_id="0") {
	try{
		global $db;
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $db->prepare("SELECT * FROM admins WHERE username = ? AND id != ?");
		$stmt->bindValue(1, $username);
		$stmt->bindValue(2, $current_id);
		$stmt->execute();
		$errorInfo = $db->errorInfo();
		if(isset($errorInfo[2])){
			$error = $errorInfo[2];
		}
	}catch(Exception $e){
		$error = $e->getMessage();
	}
	if(isset($error)){
		echo "<p>$error</p>";
	}else{
		$rowCount = $stmt->rowCount();
		return $rowCount === 0;
	}
	$stmt = null;
}

function validate_subject($subject) {
	$errors = [];
	// menu_name
	if(is_blank($subject['menu_name'])) {
		$errors[] = "Menu Name cannot be blank.";
	}
	if(!has_length($subject['menu_name'], ['min' => 2, 'max' => 255])) {
		$errors[] = "Menu Name must be between 2 and 255 characters.";
	}
	// position
	// Make sure we are working with an integer
	$postion_int = (int) $subject['position'];
	if($postion_int <= 0) {
		$errors[] = "Position must be greater than zero.";
	}
	if($postion_int > 999) {
		$errors[] = "Position must be less than 999.";
	}
	// visible
	// Make sure we are working with a string
	$visible_str = (string) $subject['visible'];
	if(!has_inclusion_of($visible_str, ["0","1"])) {
		$errors[] = "Visible must be true or false.";
	}
	return $errors;
}

function validate_page($page) {
	$errors = [];

	// subject_id
	if(is_blank($page['subject_id'])) {
		$errors[] = "Subject cannot be blank.";
	}

	// menu_name
	if(is_blank($page['menu_name'])) {
		$errors[] = "Menu Name cannot be blank.";
	} elseif(!has_length($page['menu_name'], ['min' => 2, 'max' => 255])) {
		$errors[] = "Menu Name must be between 2 and 255 characters.";
	}
	$current_id = isset($page['id']) ? $page['id'] : '0';
	if(!has_unique_page_menu_name($page['menu_name'], $current_id)){
		$errors[] = "Menu Name must be unique.";
	}

	// position
	// Make sure we are working with an integer
	$postion_int = (int) $page['position'];
	if($postion_int <= 0) {
		$errors[] = "Position must be greater than zero.";
	}
	if($postion_int > 999) {
		$errors[] = "Position must be less than 999.";
	}

	// visible
	// Make sure we are working with a string
	$visible_str = (string) $page['visible'];
	if(!has_inclusion_of($visible_str, ["0","1"])) {
		$errors[] = "Visible must be true or false.";
	}

	// content
	if(is_blank($page['content'])) {
		$errors[] = "Content cannot be blank.";
	}

	return $errors;
}

/*function validate_subject($subject){
	$errors = [];
	if(is_blank($subject['menu_name'])){
		$errors[] = "Name cannot be blank.";
	}
	if()
	return $errors;
}*/

function validate_admin($admin, $options=[]) {

	$password_required = isset($options['password_required']) ? $options['password_required'] : true;

	if(is_blank($admin['first_name'])) {
		$errors[] = "First name cannot be blank.";
	} elseif (!has_length($admin['first_name'], array('min' => 2, 'max' => 255))) {
		$errors[] = "First name must be between 2 and 255 characters.";
	}

	if(is_blank($admin['last_name'])) {
		$errors[] = "Last name cannot be blank.";
	} elseif (!has_length($admin['last_name'], array('min' => 2, 'max' => 255))) {
		$errors[] = "Last name must be between 2 and 255 characters.";
	}

	if(is_blank($admin['email'])) {
		$errors[] = "Email cannot be blank.";
	} elseif (!has_length($admin['email'], array('max' => 255))) {
		$errors[] = "Last name must be less than 255 characters.";
	} elseif (!has_valid_email_format($admin['email'])) {
		$errors[] = "Email must be a valid format.";
	}

	if(is_blank($admin['username'])) {
		$errors[] = "Username cannot be blank.";
	} elseif (!has_length($admin['username'], array('min' => 7, 'max' => 255))) {
		$errors[] = "Username must be between 8 and 255 characters.";
	} elseif (!has_unique_username($admin['username'], isset($admin['id']) ? $admin['id'] : 0)) {
		$errors[] = "Username not allowed. Try another.";
	}

	if($password_required){
		if(is_blank($admin['password'])) {
			$errors[] = "Password cannot be blank.";
		} elseif (!has_length($admin['password'], array('min' => 5))) {
			$errors[] = "Password must contain 6 or more characters";
		} elseif (!preg_match('/[A-Z]/', $admin['password'])) {
			$errors[] = "Password must contain at least 1 uppercase letter";
		} elseif (!preg_match('/[a-z]/', $admin['password'])) {
			$errors[] = "Password must contain at least 1 lowercase letter";
		} elseif (!preg_match('/[0-9]/', $admin['password'])) {
			$errors[] = "Password must contain at least 1 number";
		} elseif (!preg_match('/[^A-Za-z0-9\s]/', $admin['password'])) {
			$errors[] = "Password must contain at least 1 symbol";
		}

		if(is_blank($admin['confirm_password'])) {
			$errors[] = "Confirm password cannot be blank.";
		} elseif ($admin['password'] !== $admin['confirm_password']) {
			$errors[] = "Password and confirm password must match.";
		}
	}
	return $errors;
}

function show_validation_errors($errors){
	echo "<ul id='validation-errors'>";
	echo "<p>Please fix the following errors:</p>";
	foreach($errors as $error){
		if(is_array($error)){
			foreach($error as $item){
				echo "<li>" . $error[$key] . "</li>";
			}
		}else{
			echo "<li>" . $error . "</li>";
		}
	}
	echo "</ul>";
}

?>
