<?php
include('config.php');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data based on filters
$Program = $_POST['Program'];
$filterText1 = isset($_POST['filterText1']) ? $_POST['filterText1'] : '';
$filterText2 = isset($_POST['filterText2']) ? $_POST['filterText2'] : '';
$filterDropdown1 = isset($_POST['filterDropdown1']) ? $_POST['filterDropdown1'] : 'all';
$filterDropdown2 = isset($_POST['filterDropdown2']) ? $_POST['filterDropdown2'] : 'all';
$filterDropdown3 = isset($_POST['filterDropdown3']) ? $_POST['filterDropdown3'] : 'all';

$sql = "SELECT * FROM syllabus WHERE Programme = ?";
$params = [$Program];

if ($filterDropdown1 != 'all') {
    $sql .= " AND Semester = ?";
    $params[] = $filterDropdown1;
}
if ($filterDropdown2 != 'all') {
    $sql .= " AND Credit_System = ?";
    $params[] = $filterDropdown2;
}
if ($filterDropdown3 != 'all') {
    $sql .= " AND Year1 = ?";
    $params[] = $filterDropdown3;
}
if (!empty($filterText1)) {
    $sql .= " AND Course_Code LIKE ?";
    $params[] = '%' . $filterText1 . '%';
}
if (!empty($filterText2)) {
    $sql .= " AND Course_Title LIKE ?";
    $params[] = '%' . $filterText2 . '%';
}

// Prepare and execute the query
$stmt = $con->prepare($sql);
if ($stmt) {
    // Bind the parameters dynamically
    $stmt->bind_param(str_repeat('s', count($params)), ...$params);
    $stmt->execute();
    $result = $stmt->get_result();

    $id = 1;
    if ($result->num_rows > 0) {
        ?>
        <div class="container">
        <table id="myTable"  class="table responsive-utilities" > 
        <thead>
            <th id="thd">Select</th>
            <th id="thd">S.No.</th>
            <th id="thd">Level</th>
            <th id="thd">Programme</th>
            <th id="thd">Semester</th>
            <th id="thd">Course Code</th>
            <th id="thd">Course Title</th>
            <th id="thd">Credit System</th>
            <th id="thd">Session</th>
            <th id="thd">Preview</th>
        </thead>
        <tbody>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php 
            while($rows = $result->fetch_assoc())
            {
                // Using the `cid` or `$id` to generate unique ids and names
                $checkboxId = "selectC_$id";
                $checkboxName = "selectC_$id";
            ?>
            <tr>
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
            }
            ?>
        </tbody>
    </table>
    </div>
    <script src="fetchscript.js"></script>
    <?php
    } else {
        ?>
        <h4 style="text-align:center">"No results found";</h4>
        <?php
    }
    $stmt->close();
} else {
    echo "Error preparing statement: " . $con->error;
}

mysqli_close($con);
?>
