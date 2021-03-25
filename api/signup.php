<?php
	session_start();
	include_once 'config.php';
	$fname = mysqli_real_escape_string($conn, $_POST['fname']);
	$lname = mysqli_real_escape_string($conn, $_POST['lname']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	if (empty($fname) || empty($lname) || empty($email) || empty($password))
		echo 'All input fields are required';
	elseif (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$sql = mysqli_query($conn, "select email from Users where email = '{$email}'");
		if (mysqli_num_rows($sql) > 0) {
			echo "$email already exists";
		}
		else {
			if (isset($_FILES['image'])) {
				$img_name = $_FILES['image']['name'];
				$img_type = $_FILES['image']['type'];
				$tmp_name = $_FILES['image']['tmp_name'];

				$img_explode = explode('.', $img_name);
				$img_ext = end($img_explode);

				$extensions = ['png', 'jpeg', 'jpg']; // valid img extensions
				if (in_array($img_ext, $extensions) === true) {
					$time = time();
					$new_img_name = $time.$img_name;
					if (move_uploaded_file($tmp_name, "../static/img/" . $new_img_name)) {
						$status = 'Active now';
						$random_id = rand(time(), 10000000);

						$sql2 = mysqli_query($conn, "INSERT INTO Users (unique_id, fname, lname, email, password, img, status)
						VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}')");
						// $sql2 = mysqli_query($conn, "INSERT INTO Users(unique_id, fname, lname, email, password, img, status) VALUES(2, 'Cicioc', 'Vlad', 'test@test.com', 'import slow;', '1615776681defender of slow loris 2.jpg', 'Active now')") or die(mysqli_error($conn));
						if ($sql2) {
							$sql3 = mysqli_query($conn, "SELECT * FROM Users WHERE email = '{$email}'");
							if (mysqli_num_rows($sql3) > 0) {
								$row = mysqli_fetch_assoc($sql3);
								$_SESSION['unique_id'] = $row['unique_id'];
								echo 'success';
							}
						} else {
							echo 'Something went wrong!';
						}
					}
				} else {
					echo 'Please select an Image file';
				}
			}
			else {
				echo 'Please select an image file';
			}
		}
	}
	else {
		echo "$email is not a valid email";
	}
?>