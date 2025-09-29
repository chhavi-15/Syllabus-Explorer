<!DOCTYPE html>
<?php
include_once('header.php');
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCA</title>
    <!-- Script to add jQuery for filtering data using AJAX -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        #myTable {
            margin-left: auto;
            margin-right: auto;
        }
        tr, td {
            color: black !important; 
            border: 0.2px solid;     
        }
        #thd {
            color: white;
            background: black;
            position: sticky;
            top: 0px;
        }
        label, select, input {
            margin-left: 10px;
            margin-right: 10px;
            margin-bottom: 20px;
        }
        .heading {
            text-align: center;
        }
        .table tr:hover {
            background-color: #f1f1f1;
        }
        .containerbtn {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn {
            color: #fefafa;
            border: none;
            text-align: center;
            background: black;
            width: 10%;
        }
    </style>
</head>

<body>
<hr>
<div>
    <div class="w3_wthree_agileits_icons.main-grid-border">
        <h4 class="title" style="text-align:center;margin-bottom:40px"><span>Previous Year Papers</span></h4>  
    </div>
</div>
<?php include("filter_papers_MCA.php");?>
<div id="result">
    <div class="container">
    <table id="myTable" class="table responsive-utilities"> 
        <thead>
            <th id="thd">S.No.</th>
            <th id="thd">Level</th>
            <th id="thd">Programee</th>
            <th id="thd">Semester</th>
            <th id="thd">Course Code</th>
            <th id="thd">Course Title</th>
            <th id="thd">Preview</th>
        </thead>
        <?php
        // Displaying the content of the table for the first time when no filter is selected
        $sql = "SELECT * FROM papers WHERE Programme = 'MCA'";
        ?>
        <tbody>
        <?php 
            include('config.php');
            $result = mysqli_query($con, $sql);
            $id = 1;
            // Loop through the data
            while($rows = $result->fetch_assoc()) {
                 // Using the `cid` or `$id` to generate unique ids and names
                $checkboxId = "selectC_$id";
                $checkboxName = "selectC_$id";
        ?>
            <tr class='table tr:hover'>
                <td><?php echo $id; ?></td>
                <td><?php echo $rows['Level']; ?></td>
                <td><?php echo $rows['Programme']; ?></td>
                <td><?php echo $rows['Semester']; ?></td>
                <td><?php echo $rows['Course_Code']; ?></td>
                <td><?php echo $rows['Course_Title']; ?></td>
                <td><a href="<?php echo "pdf.php?Url=" . $rows['File_Url']; ?>" target="_blank">View</a></td>
            </tr>
        <?php
            $id++;
            } // End while loop
        ?>
        </tbody>
    </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        //Event listener for filter inputs
        $('#Course_Code, #Course_Title, #Semester').on('input change', function(){
            var filterText1 = $('#Course_Code').val();
            var filterText2 = $('#Course_Title').val();
            var filterDropdown1 = $('#Semester').val();
            var Program = 'MCA';

            $.ajax({
                url: 'filter_papers.php',
                type: 'POST',
                data: {
                    Program: Program,
                    filterText1: filterText1,
                    filterText2: filterText2,
                    filterDropdown1: filterDropdown1
                },
                success: function(response) {
                    $('#result').html(response);
                updateButtonState(); // Initial check after the table is updated
                
                }
            });
        });
    });
</script>
<?php
include_once('footer.php');
include_once('javascript.php');
?>
</body>
</html>