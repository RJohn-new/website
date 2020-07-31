<!doctype html>
<html>
<head>
	<link rel='stylesheet' href='page_css.css'>
	<title> Student's Hangout </title>
</head>
<body>
		<table cellpadding='3' cellspacing='3' class='tab_main'>
			<!--Logo-->
			<tr>
				<td  colspan='5'><img src='images/logo.png' height='65%' width='100%' ></td> <!--1350x160-->
			</tr>
			<!--Nav_Tabs-->
			<tr align='center' bgcolor='lightgrey' class='td_bor'>
				<td width='5%'> <?php Session_start(); if(IsSet($_SESSION["user_id"])) {echo "<a href='user_page.php'>"; } else {echo "<a href='home.php'>";}?>Home </a></td>
				<td width='5%'> <a href='send_message.php'>Send Message </a></td>
				<td width='5%'> <a href='inbox.php'>Inbox </a></td>
				<td width='5%'> <a href='view_profile.php'>View Profile </a></td>
				<td width='5%'> <a href='signout.php'>Signout </a></td>

			</tr>
			
			<tr>
				<td> <hr> </td> 
				<td> <hr> </td> 
				<td> <hr> </td> 
				<td> <hr> </td> 
				<td> <hr> </td> 
			</tr>

			<!--
				gotcha 3 php/mysql, users can upload a profile picture on the view profile page
			-->
			<?php
				function img($file_ext, $file_temp) {
					$fl_path = 'images/profile-pics/' . substr(md5(time()), 0, 10) . '.' . $file_ext;
					move_uploaded_file($file_temp, $fl_path);
					include 'mysql.php';
					if (MySQLi_Connect_Errno()) {
						echo 'Couldn\'t connect to database';
					} else {
						MySQLi_query($resid, "UPDATE students SET photo='".$fl_path."' WHERE id = ".$_SESSION["user_id"]."");
					}
					MySQLi_Close($resid);
				}
				
			?>
			
			
			<?php
			//Session_start();
			if(IsSet($_SESSION["user_id"])) {
						echo "<tr> <td colspan='5' align='center'> <table align='center'>
							<tr  align='center'>
								<td align='right'>Name:- </td> <td align='left'>".$_SESSION["name"]." </td> </tr> 
								<tr align='center'>
									<td align='right'>Email:- </td> <td align='left'>".$_SESSION["email"]." </td> </tr>
									<tr align='center'>
										<td align='right'>Gender:- </td> <td align='left'>".$_SESSION["gender"]."</td> </tr>
										<tr align='center'>
											<td align='right'>Age:- </td> <td align='left'>".$_SESSION["age"]."  </td> </tr> 
							</tr>
							</table>
							<table align='center'>
								<tr>
								<td width='5%' align='right'> <a href='FlappyOwl.php'>Play Flappy Owl! &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a></td>
								</tr>
							</table>
							</td>
							</tr>
							";
					
					}
			else {
				echo "<tr align='center'> <td colspan='5'> <font color='red'> Sorry, You're not Logged in! </font> Login again:- <a href='login.php'>Login</a> </td> </tr>";
			}
			
			?>
			<!-- gotcha 3 php/mysql continued -->
			<?php
				function check() {
					include 'mysql.php';
					if (MySQLi_Connect_Errno()) {
						echo 'MySql messed up';
					}else {
						$_SESSION['pic_path'] = MySQLi_query($resid, 'Select photo FROM students WHERE id = '.$_SESSION['user_id'].'');
					}
					MySQLi_Close($resid);
				}
				
			?>
			<!-- gotcha 3 php/mysql continued -->
			<tr align='center'>
				<td align='center' colspan ='2'>
					<form action="" method="post" enctype="multipart/form-data">
					<table colspan ='2'>
						<tr> <td> <hr> </td> </tr>
						<tr>
							<td colspan ='5'><input type="file" name="img" id=""> <input type="submit" value="Save"></td>
						</tr>
						<tr rowspan='3'>
							<td colspan = '2'> 
								<?php
									
									if (isset($_FILES['img'])) {
										if (empty($_FILES['img']['name'])){
											echo 'You haven\'t chosen a file';
										} else {
											$allowed = ['jpg', 'jpeg', 'png'];
											$file_name = $_FILES['img']['name'];
											$file_ext = strtolower(end(explode('.', $file_name)));
											$file_temp = $_FILES['img']['tmp_name'];
											
											if (in_array($file_ext, $allowed)) {
												img($file_ext, $file_temp);
											} else {
												echo 'Please choose jpg, jpeg, or png';
											}
										}
									} else {
										if (isset($_SESSION['pic_path'])) {
											echo '<img src="'.$_SESSION['pic_path'].'" alt="Error finding picture">';
										} else {
											check();
										}
									}
								?>
							</td>
						</tr>
					</table>
					</form>
				</td>
			</tr>
			
			
			</table>
			<footer align='center'>
			<img src='images/ksu-logo.png' height='65%' width='100%' >
			&copy; All Rights Reserved.
			<p><a href = "https://github.com/abhn/"> Original Creator </a></p>	
			</footer>
</body>
</html>
