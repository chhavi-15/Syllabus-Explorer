<?php

include('config.php'); // Make sure the database connection is established
include_once('header.php');
// Query to get unique semesters
$semesterQuery = "SELECT DISTINCT Semester FROM syllabus WHERE Programme = 'MSc-IT' ORDER BY Semester ASC";
$semesterResult = mysqli_query($con, $semesterQuery);

// Query to get unique credit systems
$creditSystemQuery = "SELECT DISTINCT Credit_System FROM syllabus WHERE Programme = 'MSc-IT' ORDER BY Credit_System ASC";
$creditSystemResult = mysqli_query($con, $creditSystemQuery);

// Query to get unique years (Year1)
$yearQuery = "SELECT DISTINCT Year1 FROM syllabus WHERE Programme = 'MSc-IT' ORDER BY Year1 ASC";
$yearResult = mysqli_query($con, $yearQuery);
?>

<!-- Form for filters -->
<div class="container">
    <div style="text-align:center;">
        <!-- Input element for filtering the data through search -->
        <label for="Course_Code">Course Code:
            <input type="text" id="Course_Code" name="Course_Code" value=""> 
        </label>
        <label for="Course_Title">Course Title:
            <input type="text" id="Course_Title" name="Course_Title" value="">
        </label>
        <!-- Dropdown filters -->
        <!-- Dynamic filter associated with semester -->
        <label for="Semester">Semester:
            <select name="Semester" id="Semester">
                <option value="all" selected>All</option>
                <?php while($row = mysqli_fetch_assoc($semesterResult)) { ?>
                    <option value="<?php echo $row['Semester']; ?>">
                        <?php echo $row['Semester']; ?>
                    </option>
                <?php } ?>
            </select>
        </label>
        <!-- Dynamic filter associated with Credit System (Either CBCS or Non-CBCS) -->
        <label for="Credit_System">Credit System:
            <select name="Credit_System" id="Credit_System">
                <option value="all" selected>All</option>
                <?php while($row = mysqli_fetch_assoc($creditSystemResult)) { ?>
                    <option value="<?php echo $row['Credit_System']; ?>">
                        <?php echo $row['Credit_System']; ?>
                    </option>
                <?php } ?>
            </select>
        </label>
        <!-- Dynamic filter associated with Starting Year for the session -->
        <label for="Year1">Session Start:
            <select name="Year1" id="Year1">
                <option value="all" selected>All</option>
                <?php while($row = mysqli_fetch_assoc($yearResult)) { ?>
                    <option value="<?php echo $row['Year1']; ?>">
                        <?php echo $row['Year1']; ?>
                    </option>
                <?php } ?>
            </select>
        </label>
    </div>
</div>

<?php
// Close the database connection
mysqli_close($con);
?>
