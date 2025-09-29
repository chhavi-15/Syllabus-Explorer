<?php

include_once("header.php");

?>
<head>
    <style>
        .container{
            padding-bottom: 40px;
        }
        textarea{
            border: 2px solid black;
            border-radius: 4px;
            /* width: auto; */
        }
        .feedSubmit{
            position: absolute; top: 50%;
        	left: 50%; padding: 10px;
        	transform: translate(-50%, -50%);
        }

    </style>

</head>
<body>

	<div class="w3-agile-services">
		<div class="container">
			<h3 class="title-txt"><span>Feedback Page</span></h3>
			<div class="container">
                <form action="feed.php" method="post">
            <textarea name="feedback" id="feedbackID" placeholder="Let us know what you think about our website..."></textarea>
            <input type="submit" value="Submit" class="btn btn-success feedSubmit" name="feedSubmit"  onclick="myFunction()">
            </form>
                
			</div>
		</div>
	</div>	
	<?php
		include_once("footer.php");
		include_once("javascript.php");
	?>
</body>

                   