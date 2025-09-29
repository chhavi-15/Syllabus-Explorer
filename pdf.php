<?php
    $File_Url=$_GET['Url'];
?>
<html>
    <head>
        <title><?php echo $_GET['Url']; ?></title>
        	<!-- Meta Tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="application/x-javascript">
            addEventListener("load", function () {
                setTimeout(hideURLbar, 0);
            }, false);

            function hideURLbar() {
                window.scrollTo(0, 1);
            }
        </script>
        <!-- // Meta Tags -->
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all">
        <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
        <!-- testimonial flexslider -->
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
        <!--fonts-->
        <link href="//fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
        <link href="//fonts.googleapis.com/css?family=Raleway:300,400,500,600,800" rel="stylesheet">
        <!--//fonts-->
        <link rel="icon" href="images/favicon.ico">
    </head>
    <body>
        <embed src="<?php echo $_GET['Url'];?>" type="application/pdf" height="100%" width="100%">
    </body>
</html>
