<?php
$config = parse_ini_file('/home/rjohn331/private/config.ini');
$resid=MySQLi_Connect($config['servername'], $config['username'], $config['password'], $config['dbname']);
					if(MySQLi_Connect_Errno()) {
						echo "<tr align='center'> <td colspan='5'> Failed to connect to MySQL </td> </tr>";
					}
					else {
					}

?>
