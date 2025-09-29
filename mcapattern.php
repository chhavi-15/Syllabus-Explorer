<?php
include_once('header.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="./filter.js"></script>
    
    <title>MSc-IT</title>
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
	<!--testimonial flexslider-->
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!--fonts-->
	<link href="//fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Raleway:300,400,500,600,800" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico">
	
    <!--Script to add jquery for filtering data using AJAX -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        #myTable
        {
            margin-left: auto;
            margin-right: auto;
        }
        tr, td{
            color:black !important ; 
            border: 0.2px solid;     
        }
        #thd
        {
            color:white;
            background:black;
            position:sticky;
            top:0px;
        }
        label,select,input
        {
            margin-left:  10px;
            margin-right:10px;
            margin-bottom: 20px;
        }
        .heading
        {
            text-align: center;
        }
    </style>
</head>

<body >
    <div>
         <!--header-->
        <!-- <div class="heading"> -->
            <div class="w3_wthree_agileits_icons.main-grid-border">
                <!-- <h3 class="title-txt"><span>S</span>yllabus <span>D</span>etails <span>F</span>or <span>M</span>Sc-IT</h3> -->
                <h4 class="title" style="text-align:center;margin-bottom:40px"><span>S</span>yllabus <span>D</span>etails <span>F</span>or <span>M</span>Sc-IT</h4>  
            </div>
            </div>
        </div>
        <!-- <hr> -->
        <div id="result">
            <div class="container">
            <table id="myTable"  class="table responsive-utilities" > 
            <thead>
                <th id="thd">S.No.</th>
                <th id="thd">Session</th>
                <th id="thd">Pattern</th>
            </thead>
    
            <?php
            //Displaying the content of the table for the first time when no filter is selected
            $sql = "SELECT * FROM paperpattern WHERE Programme = 'MCA'";
            ?>
                <tbody>
                <?php 
                    include('config.php');
                    $result = mysqli_query($con, $sql);
                    $id=1;
                // LOOP TILL END OF DATA
                    while($rows=$result->fetch_assoc())
                    {
                ?>
                    <tr>
                    <!-- FETCHING DATA FROM EACH
                        ROW OF EVERY COLUMN -->
                        <td><?php echo $id;?></td>
                        <td><?php echo $rows['Year1'];?>-<?php echo $rows['Year2'];?></td>
                        <td><a href="<?php echo "pdf.php?Url=".$rows['Pattern'];?>" target="_blank">View</a></td>
                    </tr>
                <?php
                $id = $id+1;
                }//END WHILE LOOP
                ?>
                </tbody>
            </table>
        </div>
    </div>
<!--//content-inner---->
<?php
include_once('footer.php');
include_once('javascript.php');
?>
</body>
</html>        