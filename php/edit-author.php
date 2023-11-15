<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

	# Database Connection File
	include "../db_conn.php";


    /** 
	  check if author 
	  name is submitted
	**/
	if (isset($_POST['author_name']) &&
        isset($_POST['author_id'])) {
		/** 
		Get data from POST request 
		and store them in var
		**/
		$name = $_POST['author_name'];
		$id = $_POST['author_id'];

		#simple form Validation
		if (empty($name)) {
			$em = "ناوی نووسەرت نەنووسیوە";
			header("Location: ../edit-author.php?error=$em&id=$id");
            exit;
		}else {
			# UPDATE the Database
			$sql  = "UPDATE authors 
			         SET name=?
			         WHERE id=?";
			$stmt = $conn->prepare($sql);
			$res  = $stmt->execute([$name, $id]);

			/**
		      If there is no error while 
		      inserting the data
		    **/
		     if ($res) {
		     	# success message
		     	$sm = "بەسەرکەوتووی گۆڕانکاری ئەنجام درا";
				header("Location: ../edit-author.php?success=$sm&id=$id");
	            exit;
		     }else{
		     	# Error message
		     	$em = "هەڵەیەک ڕوویدا لە گۆڕانکارکردن لە نووسەردا";
				header("Location: ../edit-author.php?error=$em&id=$id");
	            exit;
		     }
		}
	}else {
      header("Location: ../admin.php");
      exit;
	}

}else{
  header("Location: ../login.php");
  exit;
}