<<<<<<< Updated upstream
<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/product.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$product = new Product($db);
  
// set ID property of record to read
$product->kenniskaart_id = isset($_GET['kenniskaart_id']) ? $_GET['kenniskaart_id'] : die();
  
// read the details of product to be edited
$product->readOne();
  
if($product->onderwerp!=null){
    // create array
    $product_arr = array(
        "kenniskaart_id" =>  $product->kenniskaart_id,
        "onderwerp" => $product->onderwerp,
        "wat" => $product->wat,
        "why" => $product->why,
        "how" => $product->how,
        "plaatje" => $product->plaatje,
        "niveau" => $product->niveau,
        "rol" => $product->rol,
        "competentie" => $product->competentie,
        "studieduur" => $product->studieduur,
        "rating" => $product->rating,
        "bronnen" => $product->bronnen
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($product_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Product does not exist."));
}
=======
<<<<<<< HEAD
<<<<<<< HEAD
<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/product.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$product = new Product($db);
  
// set ID property of record to read
$product->kenniskaart_id = isset($_GET['kenniskaart_id']) ? $_GET['kenniskaart_id'] : die();
  
// read the details of product to be edited
$product->readOne();
  
if($product->onderwerp!=null){
    // create array
    $product_arr = array(
        "kenniskaart_id" =>  $product->kenniskaart_id,
        "onderwerp" => $product->onderwerp,
        "wat" => $product->wat,
        "why" => $product->why,
        "how" => $product->how,
        "plaatje" => $product->plaatje,
        "niveau" => $product->niveau,
        "rol" => $product->rol,
        "competentie" => $product->competentie,
        "studieduur" => $product->studieduur,
        "rating" => $product->rating,
        "bronnen" => $product->bronnen
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($product_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Product does not exist."));
}
=======
<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/product.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$product = new Product($db);
  
// set ID property of record to read
$product->kenniskaart_id = isset($_GET['kenniskaart_id']) ? $_GET['kenniskaart_id'] : die();
  
// read the details of product to be edited
$product->readOne();
  
if($product->onderwerp!=null){
    // create array
    $product_arr = array(
        "kenniskaart_id" =>  $product->kenniskaart_id,
        "onderwerp" => $product->onderwerp,
        "wat" => $product->wat,
        "why" => $product->why,
        "how" => $product->how,
        "plaatje" => $product->plaatje,
        "niveau" => $product->niveau,
        "rol" => $product->rol,
        "competentie" => $product->competentie,
        "studieduur" => $product->studieduur,
        "rating" => $product->rating,
        "bronnen" => $product->bronnen
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($product_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Product does not exist."));
}
>>>>>>> a100a847fd5f07fe90888908521a677d15bc302c
=======
<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/product.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$product = new Product($db);
  
// set ID property of record to read
$product->kenniskaart_id = isset($_GET['kenniskaart_id']) ? $_GET['kenniskaart_id'] : die();
  
// read the details of product to be edited
$product->readOne();
  
if($product->onderwerp!=null){
    // create array
    $product_arr = array(
        "kenniskaart_id" =>  $product->kenniskaart_id,
        "onderwerp" => $product->onderwerp,
        "wat" => $product->wat,
        "why" => $product->why,
        "how" => $product->how,
        "plaatje" => $product->plaatje,
        "niveau" => $product->niveau,
        "rol" => $product->rol,
        "competentie" => $product->competentie,
        "studieduur" => $product->studieduur,
        "rating" => $product->rating,
        "bronnen" => $product->bronnen
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($product_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Product does not exist."));
}
>>>>>>> a100a847fd5f07fe90888908521a677d15bc302c
>>>>>>> Stashed changes
?>