<?php 
	include 'inc/header.php'; 
?>
<?php
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$firstname = $fm->validation($_POST['firstname']);
		$lastname  = $fm->validation($_POST['lastname']);
		$email 	   = $fm->validation($_POST['email']);
		$body      = $fm->validation($_POST['body']);
		
				
		$firstname = mysqli_real_escape_string($db->link, $firstname);
		$lastname  = mysqli_real_escape_string($db->link, $lastname);
		$email     = mysqli_real_escape_string($db->link, $email);
		$body      = mysqli_real_escape_string($db->link, $body);

		$error = "";
		if (empty($firstname)) {
			$error = "First name must not be empty !!!";
		} elseif (empty($lastname)) {
			$error = "Last name must not be empty !!!";
		} elseif (empty($email)) {
			$error = "Email field must not be empty !!!";
		} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error = "Invalid email Address !!!";
		} elseif (empty($body)) {
			$error = "Message field must not be empty !!!";
		} else {
			$query = "INSERT INTO tbl_contact(firstname, lastname,email,body) values('$firstname', '$lastname', '$email', '$body')";
             $inserted_rows = $db->insert($query);
             if ($inserted_rows) {
                $msg = "Message sent Successfully.";
             } else {
                $error = "Message not sent.";
                }
		}
	}
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
				<?php
					if (isset($error)) {
						echo "<span style = 'color:red;font-size:18px;'>$error</span>";
					} 
					if (isset($msg)) {
						echo "<span style = 'color:green;font-size:18px;'>$msg</span>";
					} 
				?>
			<form action="" method="post">
				<table>
				<tr>
					<td>Your First Name:</td>
					<td>
					<input type="text" name="firstname" placeholder="Enter first name" />
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
					<input type="text" name="lastname" placeholder="Enter Last name" />
					</td>
				</tr>
				
				<tr>
					<td>Your Email Address:</td>
					<td>
					<input type="text" name="email" placeholder="Enter Email Address" />
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
					<textarea name="body"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Send"/>
					</td>
				</tr>
		</table>
	<form>				
 </div>

</div>
	<?php include 'inc/sidebar.php'; ?>
	<?php include 'inc/footer.php'; ?>