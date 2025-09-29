<?php
include_once('header.php');
include('config.php');

// Capture the cid1 and cid2 from the URL
$cid1 = isset($_GET['cid1']) ? $_GET['cid1'] : null;
$cid2 = isset($_GET['cid2']) ? $_GET['cid2'] : null;

if ($cid1 && $cid2) {
    // Prepare and execute the query for the first CID
    $stmt1 = $con->prepare("SELECT * FROM comparison WHERE cid = ?");
    $stmt1->bind_param("s", $cid1);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    $rows1 = $result1->fetch_assoc();

    // Prepare and execute the query for the second CID
    $stmt2 = $con->prepare("SELECT * FROM comparison WHERE cid = ?");
    $stmt2->bind_param("s", $cid2);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $rows2 = $result2->fetch_assoc();

    if ($rows1 && $rows2) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Text Comparison Tool</title>
    
    <style>
        .diff-added { background-color: #d4fcbc; }
        .diff-removed { background-color: #fbcfcf; }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .rowspan {
            vertical-align: middle;
        }
        textarea {
            color:black;
            width: 100%;
            height: auto;
            padding: 8px;
            box-sizing: border-box;
            border: none;
            resize: none;
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
            width: 20%;
        }
    </style>
    <script src="compare5line.js" defer></script>
</head>
<body>
<hr>
<h3 style="text-align:center;margin-bottom:40px">Syllabus Comparison</h3>

<div class='container'>
    <h4>Unit 1</h4>
    <table>
        <tr>
            <td><textarea id="text1a" rows="10" cols="50" readonly><?php echo trim(preg_replace('/\s+/', ' ', htmlspecialchars($rows1['Unit1'], ENT_QUOTES, 'UTF-8'))); ?></textarea></td>
            <td><textarea id="text1b" rows="10" cols="50" readonly><?php echo trim(preg_replace('/\s+/', ' ', htmlspecialchars($rows2['Unit1'], ENT_QUOTES, 'UTF-8'))); ?></textarea></td>
        </tr>
        <tr>
            <td colspan="2"><p>Similarity 1: <span id="similarity1"></span></p>
            <div id="result1"></div></td>
        </tr>
    </table>
    <br>
    <h4>Unit 2</h4>
    <table>
        <tr>
            <td><textarea id="text2a" rows="10" cols="50" readonly><?php echo trim(preg_replace('/\s+/', ' ', htmlspecialchars($rows1['Unit2'], ENT_QUOTES, 'UTF-8'))); ?></textarea></td>
            <td><textarea id="text2b" rows="10" cols="50" readonly><?php echo trim(preg_replace('/\s+/', ' ', htmlspecialchars($rows2['Unit2'], ENT_QUOTES, 'UTF-8'))); ?></textarea></td>
        </tr>
        <tr>
            <td colspan="2"><p>Similarity 2: <span id="similarity2"></span></p>
            <div id="result2"></div></td>
        </tr>
    </table>
    <br>
    <h4>Unit 3</h4>
    <table>
        <tr>
            <td><textarea id="text3a" rows="10" cols="50" readonly><?php echo trim(preg_replace('/\s+/', ' ', htmlspecialchars($rows1['Unit3'], ENT_QUOTES, 'UTF-8'))); ?></textarea></td>
            <td><textarea id="text3b" rows="10" cols="50" readonly><?php echo trim(preg_replace('/\s+/', ' ', htmlspecialchars($rows2['Unit3'], ENT_QUOTES, 'UTF-8'))); ?></textarea></td>
        </tr>
        <tr>
            <td colspan="2"><p>Similarity 3: <span id="similarity3"></span></p>
            <div id="result3"></div></td>
        </tr>
    </table>
    <br>
    <h4>Unit 4</h4>
    <table>
        <tr>
            <td><textarea id="text4a" rows="10" cols="50" readonly><?php echo trim(preg_replace('/\s+/', ' ', htmlspecialchars($rows1['Unit4'], ENT_QUOTES, 'UTF-8'))); ?></textarea></td>
            <td><textarea id="text4b" rows="10" cols="50" readonly><?php echo trim(preg_replace('/\s+/', ' ', htmlspecialchars($rows2['Unit4'], ENT_QUOTES, 'UTF-8'))); ?></textarea></td>
        </tr>
        <tr>
            <td colspan="2"><p>Similarity 4: <span id="similarity4"></span></p>
            <div id="result4"></div></td>
        </tr>
    </table>
    <br>
    <h4>Unit 5</h4>
    <table>
        <tr>
            <td><textarea id="text5a" rows="10" cols="50" readonly><?php echo trim(preg_replace('/\s+/', ' ', htmlspecialchars($rows1['Unit5'], ENT_QUOTES, 'UTF-8'))); ?></textarea></td>
            <td><textarea id="text5b" rows="10" cols="50" readonly><?php echo trim(preg_replace('/\s+/', ' ', htmlspecialchars($rows2['Unit5'], ENT_QUOTES, 'UTF-8'))); ?></textarea></td>
        </tr>
        <tr>
            <td colspan="2"><p>Similarity 5: <span id="similarity5"></span></p>
            <div id="result5"></div></td>
        </tr>
    </table>
</div>
<br>
<div class="containerbtn">
    <button class='btn' onclick='compareTexts()'>Compare All</button>
</div>
</body>
</html>

<?php
    } else {
        echo "<p>Data for the provided CIDs could not be found.</p>";
    }

    $stmt1->close();
    $stmt2->close();
} else {
    echo "<p>Invalid or missing CIDs.</p>";
}

$con->close();
?>

<?php include_once('footer.php'); ?>
