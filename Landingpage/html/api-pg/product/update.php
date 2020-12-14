<?php
  // required headers
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
  // include database and object files
  include_once '../config/database.php';
  include_once '../objects/product.php';
    
  // get database connection
  $database = new Database();
  $db = $database->getConnection();
    
  // prepare product object
  $product = new Product($db);
    
  // get id of product to be edited
  $data = json_decode(file_get_contents("php://input"));
  
  // set ID property of product to be edited
  $product->onderwerp = $data->onderwerp;

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

  // update the product
  if($product->update()){
    
      // set response code - 200 ok
      http_response_code(200);
    
      // tell the user
      echo json_encode(array("message" => "Product was updated."));
      header("Location:http://billy.hu-open-ict.nl/?status=success");//redirect to your html with status
  }
    
  // if unable to update the product, tell the user
  else{
    
      // set response code - 503 service unavailable
      http_response_code(503);

      // tell the user
      echo json_encode(array("message" => "Unable to update product."));
      header("Location:../kenniskaartbewerken/bewerken.html?status=failure");//redirect to your html with status
  }
?>
