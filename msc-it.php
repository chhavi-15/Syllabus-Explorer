<!DOCTYPE html>
<?php
include_once('header.php');
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>MSc-IT</title>
	
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
        <h4 class="title" style="text-align:center;margin-bottom:40px"><span>S</span>yllabus <span>D</span>etails <span>F</span>or <span>M</span>Sc-IT</h4>  
    </div>
</div>

<?php include("Filter_form.php");?>

<div class="containerbtn">
    <button class="btn" id="performAction" disabled>Compare</button>
</div>

<div id="result">
    <div class="container">
    <table id="myTable" class="table responsive-utilities"> 
        <thead>
            <th id="thd">Select</th>
            <th id="thd">S.No.</th>
            <th id="thd">Level</th>
            <th id="thd">Programee</th>
            <th id="thd">Semester</th>
            <th id="thd">Course Code</th>
            <th id="thd">Course Title</th>
            <th id="thd">Credit System</th>
            <th id="thd">Session</th>
            <th id="thd">Preview</th>
        </thead>

        <?php
        // Displaying the content of the table for the first time when no filter is selected
        $sql = "SELECT * FROM syllabus WHERE Programme = 'MSc-IT'";
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
                <td>
                    <label for="<?php echo $checkboxId; ?>"></label>
                    <input type="checkbox" id='<?php echo $checkboxId; ?>' name='<?php echo $checkboxName; ?>' class="row-checkbox" data-cid="<?php echo $rows['cid']; ?>">
                </td>
                <td><?php echo $id; ?></td>
                <td><?php echo $rows['Level']; ?></td>
                <td><?php echo $rows['Programme']; ?></td>
                <td><?php echo $rows['Semester']; ?></td>
                <td><?php echo $rows['Course_Code']; ?></td>
                <td><?php echo $rows['Course_Title']; ?></td>
                <td><?php echo $rows['Credit_System']; ?></td>
                <td><?php echo $rows['Year1']; ?>-<?php echo $rows['Year2']; ?></td>
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
        function updateButtonState() {
            const selectedCheckboxes = $('.row-checkbox:checked').length;
            $('#performAction').prop('disabled', selectedCheckboxes !== 2);
        }

        //Event listener for filter inputs
        $('#Course_Code, #Course_Title, #Semester, #Credit_System, #Year1').on('input change', function(){
            var filterText1 = $('#Course_Code').val();
            var filterText2 = $('#Course_Title').val();
            var filterDropdown1 = $('#Semester').val();
            var filterDropdown2 = $('#Credit_System').val();
            var filterDropdown3 = $('#Year1').val();
            var Program = 'MSc-IT';

            $.ajax({
                url: 'filter.php',
                type: 'POST',
                data: {
                    Program: Program,
                    filterText1: filterText1,
                    filterText2: filterText2,
                    filterDropdown1: filterDropdown1,
                    filterDropdown2: filterDropdown2,
                    filterDropdown3: filterDropdown3
                },
                success: function(response) {
                    $('#result').html(response);

                     // Re-bind the event handler for the dynamically loaded checkboxes
                $('.row-checkbox').change(function() {
                    updateButtonState();
                });

                updateButtonState(); // Initial check after the table is updated
                
                }
            });
        });

        // Event listener for checkbox change using event delegation
        $(document).on('change', '.row-checkbox', function() {
            updateButtonState();
        });

        // Event listener for comparison button click
        $('#performAction').click(function() {
            const selectedCids = $('.row-checkbox:checked').map(function() {
                return $(this).data('cid');
            }).get();

            console.log("Selected CIDs: ", selectedCids); 

            if (selectedCids.length === 2) {
                const compareUrl = 'comparefinal.php?cid1=' + selectedCids[0] + '&cid2=' + selectedCids[1];
                window.location.href = compareUrl;
            }else {
                alert('Please select exactly two rows to compare.');
            }
        });

        updateButtonState();
    });
</script>

<?php
include_once('footer.php');
include_once('javascript.php');
?>
</body>
</html>
