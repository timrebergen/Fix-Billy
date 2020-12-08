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
$product->kenniskaart_id = $data->kenniskaart_id;
  
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
}
  
// if unable to update the product, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update product."));
}
?>

<!DOCTYPE html>
<html>
<head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<script>
function validateForm() {
    let elemlength = document.getElementById('invulveld').value.length;
    if (elemlength > 350) {
        alert("De beschrijving mag niet langer dan 350 karakters zijn");
        return false;
    } else {
        post_description()
        return true;
    }
}
</script>

<style>
* {
  box-sizing: border-box;

}
.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  width: 70%;
  display: inline-block;
  position: relative;
  font-family: Arial, Helvetica, sans-serif;
  left: 15%;
  margin-top: 15px;
}

html{
  background-image: url(css/Showcase_back_main.png);
  width: 75%;
}

#editwindow{
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  min-width: 25%;
  width: 30%;
  display: inline-block;
  position: relative;
  font-family: Arial, Helvetica, sans-serif;
  left: 65%;
  margin-top: 15px;
  position: fixed;
}

#alerttitle{
  font-size: 24px;
}

#alertmessage{
  font-size: 18px;
  font-weight: lighter;
}

#invulveld:focus {
	position: relative;
	width: 100%;
	height: 40px;
	border: none;
	box-shadow: none;
	outline: none;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border-radius: 4px;
  resize: vertical;
  font-size: 18px;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  margin-top: 55px;
  padding: 5px;
  border: solid;
  border-color: #ccc;
  border-width: 2px;
  transition-duration: .3s;
  border-radius: 5px;
  cursor: pointer;
  float: right;
  font-size: 24px;
}

input[type=submit]:hover {
    background-color: #ed0010;
    color: white;
}

.row label{
    font-weight: bold
}
.column-25 {
  float: left;
  margin-left: 15px;
  width: 25%;
  margin-top: 6px;
  transition-duration: 0.5s;
}

.column-75 {
  float: left;
  margin-left: 25px;
  width: 55%;
  margin-top: 15px;
  transition-duration: 0.5s;
}


.row:after {
  content: "";
  display: table;
  clear: both;
}


.HBO-block, .skill, .rol  {
    margin-top: 15px;
    border-style: solid;
    border-radius: 5px;
    border-width: 2px;
    padding: 5px;
    border-color: #ed0010;
}

#invulveld{
  border-width: 2px;
  border-right-style: solid;
  border-color: #ed0010;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 800px) {
  .column-25, .column-75, input[type=submit], #editwindow {
    width: 100%;
    margin-top: 25px;
    margin-left: 1px;
    margin-right: 10px;
    padding: 10px;
    font-size: 14px;
  }
}
@media screen and (max-width: 900px) {
  #editwindow{
  width: 100%;
  left: 0%;
  position: relative;
  }
}


</style>
</head>
<body>

<aside id="editwindow">
    <img 
        src="css/Alert.png" width="25%" alt="">
    </img>
    <h1 id="alerttitle">Bewerkingspagina</h1>
    <h2 id="alertmessage">Jij bevind je nu op de bewerkingspagina van het kenniskaartje.</h2>
</aside>

<section class="container">
    <section id="what-why-how-picture">
        <form name="myForm" onsubmit="return validateForm()" method="post">
            <div class="row">
              <div class="column-25">
                <label for="invulveld">Onderwerp</label>
              </div>
              <div class="column-75">
                <textarea id="invulveld" name="subject" placeholder="Wat is het onderwerp?" style="height:100px" required></textarea></div>
            </div>
        
            <div class="row">
              <div class="column-25">
                <label for="wat" id="wat">What</label>
              </div>
              <div class="column-75">
                <textarea id="invulveld" name="subject" placeholder="Wat doet het (What)?" style="height:100px" required></textarea></div>
            </div>
        
            <div class="row">
              <div class="column-25">
                <label for="why" id="why">Why</label>
              </div>
              <div class="column-75">
                <textarea id="invulveld" name="subject" placeholder="Waarom wordt het toegepast (Why)?" style="height:100px" required></textarea></div>
            </div>
            <div class="row">
              <div class="column-25">
                <label for="how" id="how">How</label>
              </div>
              <div class="column-75">
                <textarea id="invulveld" name="subject" placeholder="Hoe wordt het toegepast (How)?" style="height:100px" required></textarea>
              </div>
            </div>
            <div class="row">
                <div class="column-25">
                  <label for="plaatje" id="plaatje">Upload afbeelding</label>
                </div>
                <div class="column-75">
                  <textarea id="invulveld" name="subject" placeholder="Plaats hier de URL van de afbeelding" style="height:100px" required></textarea>
                </div>
            <div class="row">
                <div class="column-25">
                  <label for="bronnen" id="bronnen">Bronnen</label>
                </div>
                <div class="column-75">
                  <textarea id="invulveld" name="subject" placeholder="Zet hier je bronnen neer" style="height:100px" required></textarea>
                </div>
            </div>
      <h1>Kies je niveau</h1>
      <aside class="skill">
        <div class="niveau_block" required>
          <input class="invulbox" type = "checkbox" id="niveau1" name = "niveau[]" value="Beginner">
          <label class="checkbox"for ="niveau1">Beginner</label><br>
          <input class="invulbox" type = "checkbox" id="niveau2" name = "niveau[]" value="Gevorderde">
          <label class="checkbox"for ="niveau2">Gevorderde</label><br>
          <input class="invulbox" type = "checkbox" id="niveau3" name = "niveau[]" value="Expert">
          <label class="checkbox"for ="niveau3">Expert</label><br>
          <script type="text/javascript">
              $('.invulbox').on('change', function() {
                  $('.invulbox').not(this).prop('checked', false);  
              });
          </script>
      </aside>
      <h1>Kies je Rol</h1>
      <aside class="rol">
        <div class="check_block" required>
          <input class="invulbox2" type = "checkbox" id="rol1" name = "rol[]" value="FE">
          <label class="checkbox2"for ="niveau1">Front-end</label><br>
          <input class="invulbox2" type = "checkbox" id="rol2" name = "rol[]" value="BE">
          <label class="checkbox2"for ="niveau2">Back-end</label><br>
          <input class="invulbox2" type = "checkbox" id="rol3" name = "rol[]" value="AI">
          <label class="checkbox2"for ="niveau3">Artificial Intelligence</label><br>
          <input class="invulbox2" type = "checkbox" id="rol4" name = "rol[]" value="PO">
          <label class="checkbox2"for ="niveau1">Product Owner</label><br>
          <input class="invulbox2" type = "checkbox" id="rol5" name = "rol[]" value="CSC">
          <label class="checkbox2"for ="niveau2">Cyber Security & Cloud</label><br>
          <input class="invulbox2" type = "checkbox" id="rol6" name = "rol[]" value="UX Designer">
          <label class="checkbox2"for ="niveau3">User Experience</label><br>
        </div>
      </aside>
      <aside class="HBO-I" required>
        <h1 class="HBO-title">Gebruikersinteractie</h1>
          <div class="HBO-block" id="gebruikersinteractie">
            <input class="invulbox3" type = "checkbox" id="competentie1" name="competentie[]" value="Gebruikersinteractie Analyseren">
            <label class="checkbox3" for ="competentie1">Gebruikersinteractie Analyseren</label><br>
            <input class="invulbox3" type = "checkbox" id="competentie2" name="competentie[]" value="Gebruikersinteractie Adviseren">
            <label class="checkbox3" for ="competentie2">Gebruikersinteractie Adviseren</label><br>
            <input class="invulbox3" type = "checkbox" id="competentie3" name="competentie[]" value="Gebruikersinteractie Ontwerpen">
            <label class="checkbox3" for ="competentie3">Gebruikersinteractie Ontwerpen</label><br>
            <input class="invulbox3" type = "checkbox" id="competentie4" name="competentie[]" value="Gebruikersinteractie Realiseren">
            <label class="checkbox3" for ="competentie4">Gebruikersinteractie Realiseren</label><br>
            <input class="invulbox3" type = "checkbox" id="competentie5" name="competentie[]" value="Gebruikersinteractie Manage & control">
            <label class="checkbox3" for ="competentie5">Gebruikersinteractie Manage & control</label>
          </div>

          <h1 class="HBO-title">Organisatieprocessen</h1>
          <div class="HBO-block" id="organisatieprocessen">
            <input class="invulbox3" type = "checkbox" id="competentie" name="competentie[]" value="Organisatieprocessen Analyseren">
            <label class="checkbox3" for ="competentie6">Organisatieprocessen Analyseren</label><br>
            <input class="invulbox3" type = "checkbox" id="competentie7" name="competentie[]" value="Organisatieprocessen Adviseren">
            <label class="checkbox3" for ="competentie7">Organisatieprocessen Adviseren</label><br>
            <input class="invulbox3" type = "checkbox" id="competentie8" name="competentie[]" value="Organisatieprocessen Ontwerpen">
            <label class="checkbox3" for ="competentie8">Organisatieprocessen Ontwerpen</label><br>
            <input class="invulbox3" type = "checkbox" id="competentie9" name="competentie[]" value="Organisatieprocessen Realiseren">
            <label class="checkbox3" for ="competentie9">Organisatieprocessen Realiseren</label><br>
            <input class="invulbox3" type = "checkbox" id="competentie10" name="competentie[]" value="Organisatieprocessen Manage & control">
            <label class="checkbox3" for ="competentie10">Organisatieprocessen Manage & control</label><br>    
          </div>

          <h1 class="HBO-title">Infrastructuur</h1>
          <div class="HBO-block" id="Infrastructuur">
            <input class="invulbox3" type = "checkbox" id="competentie11" name="competentie[]" value="Infrastructuur Analyseren">
            <label class="checkbox3" for ="competentie11">Infrastructuur Analyseren</label><br>
            <input class="invulbox3" type = "checkbox" id="competentie12" name="competentie[]" value="Infrastructuur Adviseren">
            <label class="checkbox3" for ="competentie12">Infrastructuur Adviseren</label><br>
            <input class="invulbox3" type = "checkbox" id="competentie13" name="competentie[]" value="Infrastructuur Ontwerpen">
            <label class="checkbox3" for ="competentie13">Infrastructuur Ontwerpen</label><br>
            <input class="invulbox3" type = "checkbox" id="competentie14" name="competentie[]" value="Infrastructuur Realiseren">
            <label class="checkbox3" for ="competentie14">Infrastructuur Realiseren</label><br>
            <input class="invulbox3" type = "checkbox" id="competentie15" name="competentie[]" value="Infrastructuur Manage & control">
            <label class="checkbox3" for ="competentie15">Infrastructuur Manage & control</label><br>
          </div>
    
          <h1 class="HBO-title">Software</h1>
          <div class="HBO-block" id="Software">
            <input class="invulbox3" type = "checkbox" id="competentie11" name="competentie[]" value="Infrastructuur Analyseren">
            <label class="checkbox3" for ="competentie11">Infrastructuur Analyseren</label><br>
            <input class="invulbox3" type = "checkbox" id="competentie12" name="competentie[]" value="Infrastructuur Adviseren">
            <label class="checkbox3" for ="competentie12">Infrastructuur Adviseren</label><br>
            <input class="invulbox3" type = "checkbox" id="competentie13" name="competentie[]" value="Infrastructuur Ontwerpen">
            <label class="checkbox3" for ="competentie13">Infrastructuur Ontwerpen</label><br>
            <input class="invulbox3" type = "checkbox" id="competentie14" name="competentie[]" value="Infrastructuur Realiseren">
            <label class="checkbox3" for ="competentie14">Infrastructuur Realiseren</label><br>
            <input class="invulbox3" type = "checkbox" id="competentie15" name="competentie[]" value="Infrastructuur Manage & control">
            <label class="checkbox3" for ="competentie15">Infrastructuur Manage & control</label><br>
          </div>

          <h1 class="HBO-title">Hardware Interfacing</h1>
          <div class="HBO-block" id="Hardware-Interfacing">
            <input class="invulbox3" type = "checkbox" id="competentie21" name="competentie[]" value="Hardware interfacing Analyseren">
            <label class="checkbox3" for ="competentie21">Hardware interfacing Analyseren</label><br>
            <input class="invulbox3" type = "checkbox" id="competentie22" name="competentie[]" value="Hardware interfacing Adviseren">
            <label class="checkbox3" for ="competentie22">Hardware interfacing Adviseren</label><br>
            <input class="invulbox3" type = "checkbox" id="competentie23" name="competentie[]" value="Hardware interfacing Ontwerpen">
            <label class="checkbox3" for ="competentie23">Hardware interfacing Ontwerpen</label><br>
            <input class="invulbox3" type = "checkbox" id="competentie24" name="competentie[]" value="Hardware interfacing Realiseren">
            <label class="checkbox3" for ="competentie24">Hardware interfacing Realiseren</label><br>
            <input class="invulbox3" type = "checkbox" id="competentie25" name="competentie[]" value="Hardware interfacing Manage & control">
            <label class="checkbox3" for ="competentie25">Hardware interfacing Manage & control</label><br>

            <div class="button" type="button">
              <input type="submit" type="submit" value="Kenniskaartje opslaan" name="save">
          </div>
        </form>
    </section>
</body>
</html>
