<?php

include('config.php');

// Query to get unique semesters
$semesterQuery = "SELECT DISTINCT Semester FROM papers WHERE Programme = 'MCA' ORDER BY Semester ASC";
$semesterResult = mysqli_query($con, $semesterQuery);
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
                <!-- <option value="all" selected>All</option> -->
                <?php while($row = mysqli_fetch_assoc($semesterResult)) { ?>
                    <option value="<?php echo $row['Semester']; ?>">
                        <?php echo $row['Semester']; ?>
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
