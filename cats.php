<?php
include 'includes/header.php';
include 'includes/config.php';
include 'includes/connect.php'; 
?>

<body>
<main class="container-main">    
<form action="" method="POST">
<button id="login-btn" type="submit" name="breed" >Breed</button>

<?php

if(isset($_POST['breed'])) {
 
// create curl resource
//reference : https://stackoverflow.com/questions/48555522/using-curl-to-return-json-from-api-in-php/48555635
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://catfact.ninja/breeds?limit=1");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

// $result contains the output array
$headers = array();
$headers[] = "Accept: application/json";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);


$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}else{
    
//make jsonarray to php array
$obj = json_decode($result, true);
 
$resultBreed =$obj['data'][0]['breed'];
echo $resultBreed;
}

curl_close ($ch);

}   
?>

<button id="login-btn" type="submit" name="fact">Fun Fact</button>

<?php

if(isset($_POST['fact'])) {
 
// create curl resource
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://catfact.ninja/fact");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

// $result contains the output array
$headers = array();
$headers[] = "Accept: application/json";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

//
$resultFact = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}else{

$objFact = json_decode($resultFact, true);
 
$resultFact =$objFact['fact'];
echo $resultFact;
}

curl_close ($ch);

}   
?>
</form>
</main>


<?php

include 'includes/footer.php';

?>