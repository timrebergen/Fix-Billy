<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    // get database connection and object files
    include_once '../config/database.php';
    include_once '../objects/product.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // prepare product object
    $product = new Product($db);

    // get posted data
    $data = json_decode(file_get_contents("php://input"));

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
        header("Location:http://billy.hu-open-ict.nl/?status=success");//redirect to your html with status
    }
  
    // if unable to create the product, tell the user
    // set response code - 503 service unavailable
    elseif (http_response_code(503)){

        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
        //header("Location:../kenniskaartaanmaken/aanmaken.html?status=failure #1");//redirect to your html with status
    }
    // tell the user data is incomplete
    else{

        // set response code - 400 bad request
        http_response_code(400);

        // tell the user
        echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
        header("Location:../kenniskaartaanmaken/aanmaken.html?status=failure 2#");//redirect to your html with status
    }

?>