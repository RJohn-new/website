<?php
  // create short variable names
  $tireqty = $_POST['tireqty'];
  $oilqty = $_POST['oilqty'];
  $sparkqty = $_POST['sparkqty'];
	$document_root = $_SERVER['DOCUMENT_ROOT'];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Bob's Auto Parts - Order Results</title>
  </head>
  <body>
    <h1>Bob's Auto Parts</h1>
    <h2>Order Results</h2> 
    <?php
    echo "<p>Order processed at ";
    echo date('H:i, jS F Y');
    echo "</p>";

    echo '<p>Your order is as follows: </p>';

    echo htmlspecialchars($tireqty).' tires<br />';
    echo htmlspecialchars($oilqty).' bottles of oil<br />';
    echo htmlspecialchars($sparkqty).' spark plugs<br />';

    $totalqty = 0;
    $totalqty = $tireqty + $oilqty + $sparkqty;
    echo "<p>Items ordered: ".$totalqty."<br />";
    $totalamount = 0.00;

    define('TIREPRICE', 100);
    define('OILPRICE', 10);
    define('SPARKPRICE', 4);

    $totalamount = $tireqty * TIREPRICE
                 + $oilqty * OILPRICE
                 + $sparkqty * SPARKPRICE;

    echo "Subtotal: $".number_format($totalamount,2)."<br />";
    
    $taxrate = 0.10;  // local sales tax is 10%
    $totalamount = $totalamount * (1 + $taxrate);
    echo "Total including tax: $".number_format($totalamount,2)."</p>";

	try {
	@$fp = fopen("orders.txt", 'ab');
	chmod("orders.txt", 0666);

      if(!fp) {
            throw new Exception("Darn");
      }
	
	$outputString = $date."\t".$tireqty." tires \t".$oilqty." oil \t".$sparkqty." spark plugs \t\$".$totalamount."\n";
	
	flock($fp, LOCK_EX);
	fwrite($fp, $outputString, strlen($outputString));
	flock($fp, LOCK_UN);
	fclose($fp);
	} catch (Exception $e) {
		echo"<p><strong>Your order could not be processed at this time. Please try again later.</strong></p></body></html>";
		exit;
	}
	echo "<p>Order Written.</p>";
    ?>  
  </body>
</html>
