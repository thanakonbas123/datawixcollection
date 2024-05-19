<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Data</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        padding: 10px;
        text-align: left;
        border: 1px solid #dddddd;
    }
    th {
        background-color: #f2f2f2;
    }
    .download-btn {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    body {
        background-color: #f5f5f5;
        font-family: Arial, sans-serif;
        padding: 20px;
    }
    .container {
        background-color: #ffffff;
        border: 1px solid #ccc;
        padding: 20px;
        margin-top: 20px;
        border-radius: 10px;
        max-width: 100%;
        overflow: auto;
    }
    table {
        background-color: #ffffff;
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid #dddddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }

    footer {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    footer .column {
        border-right: 1px solid #ccc;
        padding-right: 20px;
    }

    footer .column:last-child {
        border-right: none;
    }

    footer {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    footer .column h4 {
        color: #ff7f50;
    }

    footer .column .logo {
        max-width: 100px;
        margin-bottom: 2rem;
    }

    h2 {
        font-family: Arial, sans-serif;
        font-weight: bold;
    }
</style>
</head>
<body>
<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-2 mb-4 border-bottom border-1 border-dark">
    <a href="#" class="d-flex align-items-center col-md-2 mb-2 mb-md-0 text-dark text-decoration-none">
        <img src="https://static.wixstatic.com/media/ce1a33_40b3d369556a46208d13ea9176151af9~mv2.png/v1/fill/w_439,h_163,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/ce1a33_40b3d369556a46208d13ea9176151af9~mv2.png" alt="Logo" width="280" height="80" class="me-2">
        <svg class="bi me-2" width="200" height="80" role="img" aria-label="Bootstrap"><use xlink:href="index.php"></use></svg>
    </a>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="#" class="nav-link px-2"></a></li>
    </ul>

    <div class="col-md-3 text-end">
        <a href="logout.php" class="btn btn-outline-danger me-2">Logout</a>
    </div>
</header>

<?php
echo "<h2 style='text-align:center;'>ตารางข้อมูลผู้ลงทะเบียน</h2><br>";
$access_token = trim(file_get_contents('access_token.txt'));
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www.wixapis.com/wix-data/v2/items/query',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "dataCollectionId": "RegisterUser",
  "query": {},
  "returnTotalCount": false,
  "includeReferencedItems": [],
  "consistentRead": false
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: ' . $access_token, // Use access token from file
    'Content-Type: application/json',
    'Cookie: XSRF-TOKEN=1715761186|CQvJQWXegm6h'
  ),
));

$response = curl_exec($curl);
curl_close($curl);

$data = json_decode($response, true);

if(isset($data['dataItems']) && !empty($data['dataItems'])) {
    $dataItems = $data['dataItems'];
    echo "<table>";
    echo "<tr>";

    // Define the desired order of columns
    $columns = array('_id', 'firstName', 'lastName', 'email', 'address', 'district', 'province', 'country', 'postcode', 'codephone','phoneNumber'  );

    // Table headers
    foreach($columns as $column) {
        echo "<th>" . htmlspecialchars($column) . "</th>";
    }
    echo "</tr>";

    // Table rows
    foreach($dataItems as $item) {
        echo "<tr>";
        foreach($columns as $column) {
            $value = isset($item['data'][$column]) ? $item['data'][$column] : '';
            // Check if $value is an array
            if(is_array($value)) {
                // If it is an array, convert it to a comma-separated string
                echo "<td>" . htmlspecialchars(implode(', ', $value)) . "</td>";
            } else {
                // If it's not an array, use htmlspecialchars as usual
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
        }
        echo "</tr>";
    }

    echo "</table>";
    ?>
    <form action="download.php" method="post">
        <input type="hidden" name="csv_data" value="<?php echo htmlspecialchars(json_encode($dataItems)); ?>">
        <button type="submit" class="download-btn">Download CSV</button>
    </form>
    <?php
} else {
    echo "No items found.";
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
