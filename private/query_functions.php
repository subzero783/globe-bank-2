<?php 
//Pages
function get_all_pages_order_by_subject_id_and_position(){
	try{
		global $db;
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $db->prepare("SELECT * FROM pages ORDER BY subject_id ASC, position ASC");
		$stmt->execute();
		$errorInfo = $db->errorInfo();
		if(isset($errorInfo[2])){
			$error = $errorInfo[2];
		}
	} catch (Exception $e) {
		$error = $e->getMessage();
	} 
	if(isset($error)){
		echo "<p>$error</p>";
	}else{
		return filter_array_stripslashes_fetch_all($stmt->fetchAll(PDO::FETCH_ASSOC));
	}
	$stmt = null;
}

function insert_new_page($page){
	$errorsArray = validate_page($page);
	$filPage = filter_array_data($page);            
	$insertArray = [];
	if(empty($errorsArray)){
		try{
			global $db;
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $db->prepare("INSERT INTO pages (subject_id, menu_name, position, visible, content) VALUES (?, ?, ?, ?, ?)");
			$stmt->bindValue(1, $filPage['subject_id']);
			$stmt->bindValue(2, $filPage['menu_name']);
			$stmt->bindValue(3, $filPage['position']);
			$stmt->bindValue(4, $filPage['visible']);
			$stmt->bindValue(5, $filPage['content']);
			$stmt->execute();
			$errorInfo = $db->errorInfo();
			if(isset($errorInfo[2])){
				$error = $errorInfo[2];
			}
		}catch (Exception $e) {
			$error = $e->getMessage();
		}
		if(isset($error)) {
			echo "<p>$error</p>";
		}else{
			$insertArray['new_id'] = $db->lastInsertId();
			$insertArray['inserted'] = true;
			return $insertArray;
		}
		$stmt = null;
	}else{
		$insertArray['errors'] = $errorsArray;
		return $insertArray;
	}
}

function update_page_by_id($page){
	$errorsArray = validate_page($page);
	$filPage = filter_array_data($page);            
	$updateArray = [];
	if(empty($errorsArray)){
		try{
			global $db;
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $db->prepare("UPDATE pages SET subject_id = ?, menu_name = ?, position = ?, visible = ?, content = ? WHERE id = ? LIMIT 1");
			$stmt->bindValue(1, $filPage['subject_id']);
			$stmt->bindValue(2, $filPage['menu_name']);
			$stmt->bindValue(3, $filPage['position']);
			$stmt->bindValue(4, $filPage['visible']);
			$stmt->bindValue(5, $filPage['content']);
			$stmt->bindValue(6, $filPage['id']);
			$stmt->execute();
			$errorInfo = $db->errorInfo();
			if(isset($errorInfo[2])){
				$error = $errorInfo[2];
			}
		}catch(Exception $e) {
			$error = $e->getMessage();
		}
		if(isset($error)) {
			echo "<p>$error</p>";
		}else{
			$updateArray['inserted'] = true;
			return $updateArray;
		}
		$stmt = null;
	}else{
		$updateArray['errors'] = $errorsArray;
		return $updateArray;
	}
} 

function delete_page_by_id($id){
	$id = form_input_filter_string($id);
	try{
		global $db;
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $db->prepare("DELETE FROM pages WHERE id = ? LIMIT 1");
		$stmt->bindValue(1, $id);
		$stmt->execute();
		$errorInfo = $db->errorInfo();
		if(isset($errorInfo[2])){
			$error = $errorInfo[2];
		}
	}catch(Exception $e) {
		$error = $e->getMessage();
	}
	if(isset($error)) {
		echo "<p>$error</p>";
	}else{
		return true;
	}
	$stmt = null;
}

function get_page_by_slug($id, $options=[]){
	$id = form_input_filter_string($id);
	$visible = isset($options['visible']) ? $options['visible'] : false;
	try{
		global $db;
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query = "SELECT * FROM pages WHERE page_slug = ? ";
		if($visible){
			$query .= "AND visible = true";
		}
		$stmt = $db->prepare($query);
		$stmt->bindValue(1, $id);
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
	} else {
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	$stmt = null; 
}

function get_first_page_by_subject_id_visible_true($id){
	$id = form_input_filter_string($id);
	try{
		global $db;
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $db->prepare("SELECT * FROM pages WHERE subject_id = ? AND visible = true LIMIT 1");
		$stmt->bindValue(1, $id);
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
	} else {
		return filter_array_stripslashes_fetch($stmt->fetch(PDO::FETCH_ASSOC));
	}
	$stmt = null; 
}

// function find_pages_by_subject_id($subject_id, $options=[]){
// 	$visible = isset($options['visible']) ? $options['visible'] : false;
// 	$subject_id = form_input_filter_string($subject_id);
// 	try{
// 		global $db;
// 		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 		$query = "SELECT * FROM pages WHERE subject_id = ? ";
// 		if($visible){
// 			$query .= "AND visible = true ";
// 		}
// 		$query .= "ORDER BY position ASC ";
// 		$stmt = $db->prepare($query);
// 		$stmt->bindValue(1, $subject_id);
// 		$stmt->execute();
// 		$errorInfo = $db->errorInfo();
// 		if(isset($errorInfo[2])){
// 			$error = $errorInfo[2];
// 		}
// 	} catch (Exception $e) {
// 			$error = $e->getMessage();
// 	}
// 	if(isset($error)) {
// 		echo "<p>$error</p>";
// 	} else {
// 		return filter_array_stripslashes_fetch_all($stmt->fetchAll(PDO::FETCH_ASSOC));
// 	}
// 	$stmt = null; 
// }

function count_pages_by_subject_id($subject_id, $options=[]){
	$visible = isset($options['visible']) ? $options['visible'] : false;
	$subject_id = form_input_filter_string($subject_id);
	try{
		global $db;
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query = "SELECT * FROM pages WHERE subject_id = ? ";
		if($visible){
			$query .= "AND visible = true ";
		}
		$query .= "ORDER BY position ASC ";
		$stmt = $db->prepare($query);
		$stmt->bindValue(1, $subject_id);
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
	} else {
		return $stmt->rowCount();
	}
	$stmt = null; 
}

//Subjects

function edit_bid($subject){
	$errorsArray = validate_subject($subject);
	$filSubject = filter_array_data($subject);
	$subjectArray = [];
	if(empty($errorsArray)){
		try{
			global $db;
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $db->prepare("UPDATE bids SET menu_name = ?, position = ?, visible = ? WHERE id = ? LIMIT 1");
			$stmt->bindValue(1, $filSubject['menu_name']);
			$stmt->bindValue(2, $filSubject['position']);
			$stmt->bindValue(3, $filSubject['visible']);
			$stmt->bindValue(4, $filSubject['id']);
			$stmt->execute();
			$errorInfo = $db->errorInfo();
			if(isset($errorInfo[2])){
				$error = $errorInfo[2];
			}
		}catch(Exception $e) {
			echo $error = $e->getMessage();
		}   
		if(isset($error)) {
			return "<p>$error</p>";
		}else{
			$subjectArray['updated'] = true;
			return $subjectArray;
		}
		$stmt = null;
	}else{
		$subjectArray['errors'] = $errorsArray;
		return $subjectArray;
	}
}

 function delete_bid_with_id($id){
	$id = form_input_filter_string($id);
	try{
		global $db;
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $db->prepare("DELETE FROM bid WHERE id = ? LIMIT 1");
		$stmt->bindValue(1, $id);
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
	} else {
		return true;
	}
	$stmt = null;
}

function get_all_pages_order_by_position($options=[]){
	$visible = isset($options['visible']) ? $options['visible'] : false;
	//var_dump($visible);
	try{
		global $db;
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM pages ";
    
		if($visible){
			$query .= "WHERE visible = true ";
		}
    $query .= "ORDER BY position ASC";
    
		$stmt = $db->prepare($query);
		$stmt->execute();
    $errorInfo = $db->errorInfo();
    
		if(isset($errorInfo[2])){
			$error = $errorInfo[2];
		}
	}catch(Exception $e) {
		$error = $e->getMessage();
	}
	if(isset($error)) {
		echo "<p>$error</p>";
	}else{
		$array = filter_array_stripslashes_fetch_all($stmt->fetchAll(PDO::FETCH_ASSOC));
		return $array;
	}
	$stmt = null;
}

function get_all_pages($options=[]){
	$visible = isset($options['visible']) ? $options['visible'] : false;
	//var_dump($visible);
	try{
		global $db;
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM pages ";
    
		if($visible){
			$query .= "WHERE visible = true ";
		}
    $query .= "ORDER BY position ASC";
    
		$stmt = $db->prepare($query);
		$stmt->execute();
    $errorInfo = $db->errorInfo();
    
		if(isset($errorInfo[2])){
			$error = $errorInfo[2];
		}
	}catch(Exception $e) {
		$error = $e->getMessage();
	}
	if(isset($error)) {
		echo "<p>$error</p>";
	}else{
		$array = filter_array_stripslashes_fetch_all($stmt->fetchAll(PDO::FETCH_ASSOC));
		return $array;
	}
	$stmt = null;
}

function get_bids_by_id($id, $options=[]){
	$id = form_input_filter_string($id);
	$visible = isset($options['visible']) ? $options['visible'] : false;
	try{
		global $db;
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query = "SELECT * FROM bids WHERE id = ? ";
		if($visible){
			$query .= "AND visible = true";
		}
		$stmt = $db->prepare($query);
		$stmt->bindValue(1, $id);
		$stmt->execute();
		$errorInfo = $db->errorInfo();
		if(isset($errorInfo[2])){
			$error = $errorInfo[2];
		}
	}catch(Exception $e) {
		$error = $e->getMessage();
	}
	if(isset($error)) {
		return "<p>$error</p>";
	}else{
		return filter_array_stripslashes_fetch($stmt->fetch(PDO::FETCH_ASSOC));
	}
	$stmt = null;
}

function create_new_bid($subject){
	$errorsArray = validate_subject($subject);
	$filSubject = filter_array_data($subject);
	$subjectArray = [];
	if(empty($errorsArray)){
		try{
			global $db;
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $db->prepare("INSERT INTO bids (menu_name, position, visible) VALUES (?, ?, ?)");
			$stmt->bindValue(1, $filSubject['menu_name']);
			$stmt->bindValue(2, $filSubject['position']);
			$stmt->bindValue(3, $filSubject['visible']);
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
			$subjectArray['inserted'] = true;
			$subjectArray['last_id'] = $db->lastInsertId();
			return $subjectArray;
		}	
		$stmt = null;
	}else{
		$subjectArray['errors'] = $errorsArray;
		return $subjectArray;
	}
}

function count_rows_bids_table(){
	try{
		global $db;
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $db->prepare("SELECT position FROM bids");
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
		return $stmt->rowCount();
	}
	$stmt = null;
}

function get_all_bids_count(){
	try{
		global $db;
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $db->prepare("SELECT * FROM bids");
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
		return $stmt->rowCount() + 1;
	}
	$stmt = null;
}

//Admins
function find_all_admins(){
	try{
		global $db;
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query = "SELECT * FROM admins ORDER BY last_name ASC, first_name ASC";
		$stmt = $db->prepare($query);
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
		$array = filter_array_stripslashes_fetch_all($stmt->fetchAll(PDO::FETCH_ASSOC));
		return $array;
	}
	$stmt = null;
}

function find_user_by_id($id){
	$id = form_input_filter_string($id);
	try{
		global $db;
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query = "SELECT * FROM users WHERE id = ? LIMIT 1";
		$stmt = $db->prepare($query);
		$stmt->bindValue(1, $id);
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
		$array = filter_array_stripslashes_fetch($stmt->fetch(PDO::FETCH_ASSOC));
		return $array;
	}
	$stmt = null;
}

function find_user_by_username($username){
	$username = form_input_filter_string($username);
	try{
		global $db;
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query = "SELECT * FROM users WHERE username = ? LIMIT 1";
		$stmt = $db->prepare($query);
		$stmt->bindValue(1, $username);
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
		$array = $stmt->fetch(PDO::FETCH_ASSOC);
		return $array;
	}
	$stmt = null;
}

function insert_admin($admin){
	$errorsArray = validate_admin($admin);
	$filAdmin = filter_array_data($admin);
	$adminArray = [];
	$hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);
	if(empty($errorsArray)){
		try{
			global $db;
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $db->prepare("INSERT INTO admins (first_name, last_name, email, username, hashed_password) VALUES (?, ?, ?, ?, ?)");
			$stmt->bindValue(1, $filAdmin['first_name']);
			$stmt->bindValue(2, $filAdmin['last_name']);
			$stmt->bindValue(3, $filAdmin['email']);
			$stmt->bindValue(4, $filAdmin['username']);
			$stmt->bindValue(5, $hashed_password);
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
			$adminArray['inserted'] = true;
			$adminArray['last_id'] = $db->lastInsertId();
			return $adminArray;
		} 
	$stmt = null;
	}else{
		$adminArray['errors'] = $errorsArray;
		return $adminArray;
	}
}

function update_admin($admin){
	$password_sent = !is_blank($admin['password']);
	$errorsArray = validate_admin($admin, ['password_required' => $password_sent]);
	$filAdmin = filter_array_data($admin);
	$adminArray = [];
	$hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);
	if(empty($errorsArray)){
		try{
			global $db;
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if($password_sent){
				$stmt = $db->prepare("UPDATE admins SET first_name = ?, last_name = ?, email = ?, hashed_password = ?, username = ? WHERE id = ? LIMIT 1");
				$stmt->bindValue(1, $filAdmin['first_name']);
				$stmt->bindValue(2, $filAdmin['last_name']);
				$stmt->bindValue(3, $filAdmin['email']);
				$stmt->bindValue(4, $hashed_password);
				$stmt->bindValue(5, $filAdmin['username']);
				$stmt->bindValue(6, $filAdmin['id']);
			}else{
				$stmt = $db->prepare("UPDATE admins SET first_name = ?, last_name = ?, email = ?, username = ? WHERE id = ? LIMIT 1");
				$stmt->bindValue(1, $filAdmin['first_name']);
				$stmt->bindValue(2, $filAdmin['last_name']);
				$stmt->bindValue(3, $filAdmin['email']);
				$stmt->bindValue(4, $filAdmin['username']);
				$stmt->bindValue(5, $filAdmin['id']);
			}
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
			$adminArray['updated'] = true;
			$adminArray['last_id'] = $db->lastInsertId();
			return $adminArray;
		} 
	$stmt = null;
	}else{
		$adminArray['errors'] = $errorsArray;
		return $adminArray;
	}
}

function delete_admin($id){
	$id = form_input_filter_string($id);
	try{
		global $db;
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $db->prepare("DELETE FROM admins WHERE id = ? LIMIT 1");
		$stmt->bindValue(1, $id);
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
	 } else {
		return true;
	 }
	$stmt = null;
}

?>