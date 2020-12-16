<<<<<<< Updated upstream
<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate product object
include_once '../objects/product.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$product = new Product($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->onderwerp) &&
    !empty($data->wat) &&
    !empty($data->why) &&
    !empty($data->how) &&
    !empty($data->plaatje) &&
    !empty($data->niveau) &&
    !empty($data->rol) &&
    !empty($data->competentie) &&
    !empty($data->studieduur) &&
    !empty($data->rating) &&
    !empty($data->bronnen) 
){
  
    // set product property values
    $product->onderwerp = $data->onderwerp;
    $product->wat = $data->wat;
    $product->why = $data->why;
    $product->how = $data->how;
    $product->plaatje = $data->plaatje;
    $product->niveau = $data->niveau;
    $product->rol = $data->rol;
    $product->competentie = $data->competentie;
    $product->studieduur = $data->studieduur;
    $product->rating = $data->rating;
    $product->bronnen = $data->bronnen;
  
    // create the product
    if($product->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Product was created."));
        //header("Location:http://billy.hu-open-ict.nl/?status=success");//redirect to your html with status
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
        //header("Location:../kenniskaartaanmaken/aanmaken.html?status=failure");//redirect to your html with status
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
    //header("Location:../kenniskaartaanmaken/aanmaken.html?status=failure");//redirect to your html with status
}
=======
<<<<<<< HEAD
<<<<<<< HEAD
<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate product object
include_once '../objects/product.php';
<<<<<<< Updated upstream

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
=======
  
$database = new Database();
$db = $database->getConnection();
  
>>>>>>> Stashed changes
$product = new Product($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
<<<<<<< Updated upstream
=======
    !empty($data->kenniskaarT_id) &&
>>>>>>> Stashed changes
    !empty($data->onderwerp) &&
    !empty($data->wat) &&
    !empty($data->why) &&
    !empty($data->how) &&
    !empty($data->plaatje) &&
    !empty($data->niveau) &&
    !empty($data->rol) &&
    !empty($data->competentie) &&
    !empty($data->studieduur) &&
    !empty($data->rating) &&
    !empty($data->bronnen) 
){
  
    // set product property values
    $product->onderwerp = $data->onderwerp;
    $product->wat = $data->wat;
    $product->why = $data->why;
    $product->how = $data->how;
    $product->plaatje = $data->plaatje;
    $product->niveau = $data->niveau;
    $product->rol = $data->rol;
    $product->competentie = $data->competentie;
    $product->studieduur = $data->studieduur;
    $product->rating = $data->rating;
    $product->bronnen = $data->bronnen;
  
    // create the product
    if($product->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Product was created."));
<<<<<<< Updated upstream
        //header("Location:http://billy.hu-open-ict.nl/?status=success");//redirect to your html with status
=======
>>>>>>> Stashed changes
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
<<<<<<< Updated upstream
        //header("Location:../kenniskaartaanmaken/aanmaken.html?status=failure");//redirect to your html with status
=======
>>>>>>> Stashed changes
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
<<<<<<< Updated upstream
    //header("Location:../kenniskaartaanmaken/aanmaken.html?status=failure");//redirect to your html with status
=======
>>>>>>> Stashed changes
}
=======
<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate product object
include_once '../objects/product.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$product = new Product($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->onderwerp) &&
    !empty($data->wat) &&
    !empty($data->why) &&
    !empty($data->how) &&
    !empty($data->plaatje) &&
    !empty($data->niveau) &&
    !empty($data->rol) &&
    !empty($data->competentie) &&
    !empty($data->studieduur) &&
    !empty($data->rating) &&
    !empty($data->bronnen) 
){
  
    // set product property values
    $product->onderwerp = $data->onderwerp;
    $product->wat = $data->wat;
    $product->why = $data->why;
    $product->how = $data->how;
    $product->plaatje = $data->plaatje;
    $product->niveau = $data->niveau;
    $product->rol = $data->rol;
    $product->competentie = $data->competentie;
    $product->studieduur = $data->studieduur;
    $product->rating = $data->rating;
    $product->bronnen = $data->bronnen;
  
    // create the product
    if($product->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Product was created."));
        //header("Location:http://billy.hu-open-ict.nl/?status=success");//redirect to your html with status
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
        //header("Location:../kenniskaartaanmaken/aanmaken.html?status=failure");//redirect to your html with status
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
    //header("Location:../kenniskaartaanmaken/aanmaken.html?status=failure");//redirect to your html with status
}
>>>>>>> a100a847fd5f07fe90888908521a677d15bc302c
=======
<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate product object
include_once '../objects/product.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$product = new Product($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->onderwerp) &&
    !empty($data->wat) &&
    !empty($data->why) &&
    !empty($data->how) &&
    !empty($data->plaatje) &&
    !empty($data->niveau) &&
    !empty($data->rol) &&
    !empty($data->competentie) &&
    !empty($data->studieduur) &&
    !empty($data->rating) &&
    !empty($data->bronnen) 
){
  
    // set product property values
    $product->onderwerp = $data->onderwerp;
    $product->wat = $data->wat;
    $product->why = $data->why;
    $product->how = $data->how;
    $product->plaatje = $data->plaatje;
    $product->niveau = $data->niveau;
    $product->rol = $data->rol;
    $product->competentie = $data->competentie;
    $product->studieduur = $data->studieduur;
    $product->rating = $data->rating;
    $product->bronnen = $data->bronnen;
  
    // create the product
    if($product->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Product was created."));
        //header("Location:http://billy.hu-open-ict.nl/?status=success");//redirect to your html with status
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
        //header("Location:../kenniskaartaanmaken/aanmaken.html?status=failure");//redirect to your html with status
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
    //header("Location:../kenniskaartaanmaken/aanmaken.html?status=failure");//redirect to your html with status
}
>>>>>>> a100a847fd5f07fe90888908521a677d15bc302c
>>>>>>> Stashed changes
?>