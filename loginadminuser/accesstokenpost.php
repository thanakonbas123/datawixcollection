<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www.wixapis.com/oauth2/token',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "grantType": "client_credentials",
    "client_id": "00ba81c6-8583-4a74-8056-af8b8b132da7",
    "client_secret": "bfbe7804-1f88-4f50-b263-453903847e04",
    "instance_id": "202d1988-6832-4bdf-a780-e66a98ea4281"
  }',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

// Decode the response to get the access_token
$responseData = json_decode($response, true);
$accessToken = $responseData['access_token'];

// Write the access_token to access_token.txt, overwriting any existing content
file_put_contents('access_token.txt', $accessToken);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Token</title>
    <style>
        body {
            background-color: #c9d6ff;
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
        }
        .container {
            background: linear-gradient(to right, #ff8c5d, #ff7e5f);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.3);
            max-width: 400px;
            width: 90%;
        }
        h1 {
            font-size: 24px;
            color: #fff;
            margin-bottom: 20px;
            text-align: center;
        }
        button {
            padding: 15px 30px;
            font-size: 18px;
            color: #fff;
            background-color: #ff5f00; /* เปลี่ยนสีปุ่มเป็นส้มเข้ม */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            margin: 0 auto;
        }
        button:hover {
            background-color: #ff3d00; /* เปลี่ยนสีเมื่อชี้ */
        }
    </style>
</head>
<body>

<div class="container">
    <h1>ข้อมูลพร้อมใช้งาน</h1>
    <button onclick="location.href='testpostmancode.php'">กดเพื่อแสดงข้อมูล</button>
</div>

</body>
</html>




