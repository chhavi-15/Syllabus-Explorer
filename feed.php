<?php

include_once("header.php");

?>
<?php
 if(isset($_POST['feedSubmit']))
 {
  $feedt =$_POST['feedback'];
  $fp = fopen('data.txt', 'a+');
  $text = $feedt . "\n";
    if(fwrite($fp, $text))  {
        // echo 'saved';
    }
fclose ($fp);    
}
?>

<body>
    <div class="w3-agile-services">
    <div class="container">
			<h3 class="title-txt"><span>Thank You! for the feedback.</span></h3>
			<h3 class="title-txt"><span>Visit Again.</span></h3>
                
			</div>
		</div>
        <?php
		include_once("footer.php");
		include_once("javascript.php");
	?>
</body>