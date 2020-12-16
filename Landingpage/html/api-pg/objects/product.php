<<<<<<< Updated upstream
<?php
class Product{
  
    // database connection and table name
    private $conn;
    private $table_name = "sch_map.kenniskaart";
  
    // object properties
    public $kenniskaart_id;
    public $onderwerp;
    public $wat;
    public $why;
    public $how;
    public $plaatje;
    public $niveau;
    public $rol;
    public $competentie;
    public $studieduur;
    public $rating;
    public $bronnen;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    ". $this->table_name . " 
                ORDER BY
                    onderwerp DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();

        return $stmt;
    }
    
    // create product
    function create(){

        // makes niveau/rol/competentie multiple values
        $checkbox1=$_POST['niveau'];
        $niveau="";
        foreach($checkbox1 as $niveau1)
        {
            $niveau .= $niveau1."";
        }

        $checkbox2=$_POST['rol'];
        $rol="";
        foreach($checkbox2 as $rol1)
        {
            $rol .= $rol1.",";
        }

        $checkbox3=$_POST['competentie'];
        $competentie="";
        foreach($checkbox3 as $competentie1)
        {
            $competentie .= $competentie1.",";
        }

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "(onderwerp, rol, competentie, wat, why, how, plaatje, bronnen, niveau, studieduur, rating)
                VALUES(
                    '$_POST[onderwerp]',
                    '$rol',
                    '$competentie',
                    '$_POST[wat]',
                    '$_POST[why]',
                    '$_POST[how]',
                    '$_POST[plaatje]',
                    '$_POST[bronnen]',
                    '$niveau',
                    '$_POST[studieduur]',
                    '$_POST[rating]'
                     )";

        echo $query;

        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->onderwerp=htmlspecialchars($this->onderwerp);
        $this->wat=htmlspecialchars($this->wat);
        $this->why=htmlspecialchars($this->why);
        $this->how=htmlspecialchars($this->how);
        $this->plaatje=htmlspecialchars($this->plaatje);
        $this->niveau=htmlspecialchars($this->niveau);
        $this->rol=htmlspecialchars($this->rol);
        $this->competentie=htmlspecialchars($this->competentie);
        $this->studieduur=htmlspecialchars($this->studieduur);
        $this->rating=htmlspecialchars($this->rating);
        $this->bronnen=htmlspecialchars($this->bronnen);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // used when filling up the update product form
    function readOne(){
    
        // query to read single record
        $query =    "SELECT
                        *
                    FROM
                        ". $this->table_name . " 
                    WHERE 
                        kenniskaart_id = ?
                    LIMIT
                        0,1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->onderwerp = $row['onderwerp'];
        $this->wat = $row['wat'];
        $this->why = $row['why'];
        $this->how = $row['how'];
        $this->plaatje = $row['plaatje'];
        $this->niveau = $row['niveau'];
        $this->rol = $row['rol'];
        $this->competentie = $row['competentie'];
        $this->studieduur = $row['studieduur'];
        $this->rating = $row['rating'];
        $this->bronnen = $row['bronnen'];
    }

    // update the product
    function update(){

        // makes niveau/rol/competentie multiple values
        $checkbox1=$_POST['niveau'];
        $niveau="";
        foreach($checkbox1 as $niveau1)
        {
            $niveau .= $niveau1."";
        }

        $checkbox2=$_POST['rol'];
        $rol="";
        foreach($checkbox2 as $rol1)
        {
            $rol .= $rol1.",";
        }

        $checkbox3=$_POST['competentie'];
        $competentie="";
        foreach($checkbox3 as $competentie1)
        {
            $competentie .= $competentie1.",";
        }

        // update query
        $query = "UPDATE " . $this->table_name . " 
                 SET 
                     onderwerp = '$_POST[onderwerp]',
                     rol = '$rol',
                     competentie = '$competentie',
                     wat = '$_POST[wat]',
                     why = '$_POST[why]',
                     how = '$_POST[how]',
                     plaatje = '$_POST[plaatje]',
                     bronnen = '$_POST[bronnen]',
                     niveau = '$niveau',
                     studieduur = '$_POST[studieduur]',
                     rating = '$_POST[rating]'
                 WHERE onderwerp = '$_POST[onderwerp]' ";

        // prepare query statement
        echo $query;
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->onderwerp=htmlspecialchars($this->onderwerp);
        $this->wat=htmlspecialchars($this->wat);
        $this->why=htmlspecialchars($this->why);
        $this->how=htmlspecialchars($this->how);
        $this->plaatje=htmlspecialchars($this->plaatje);
        $this->niveau=htmlspecialchars($this->niveau);
        $this->rol=htmlspecialchars($this->rol);
        $this->competentie=htmlspecialchars($this->competentie);
        $this->studieduur=htmlspecialchars($this->studieduur);
        $this->rating=htmlspecialchars($this->rating);
        $this->bronnen=htmlspecialchars($this->bronnen);

        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // delete the product
    function delete(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE kenniskaart_id = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->kenniskaart_id=htmlspecialchars($this->kenniskaart_id);
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->kenniskaart_id);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // search products
    function search($keywords){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    onderwerp LIKE ? OR wat LIKE ? OR why LIKE ? OR how LIKE ?
                ORDER BY
                    kenniskaart DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $keywords=htmlspecialchars($keywords);
        $keywords = "%{$keywords}%";
    
        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // read products with pagination
    public function readPaging($from_record_num, $records_per_page){
    
        // select query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                ORDER BY onderwerp DESC
                LIMIT ?, ?";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind variable values
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
    
        // execute query
        $stmt->execute();
    
        // return values from database
        return $stmt;
    }

    // used for paging products
    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $row['total_rows'];
    }
}
=======
<<<<<<< HEAD
<<<<<<< HEAD
<?php
class Product{
  
    // database connection and table name
    private $conn;
    private $table_name = "sch_map.kenniskaart";
  
    // object properties
    public $kenniskaart_id;
    public $onderwerp;
    public $wat;
    public $why;
    public $how;
    public $plaatje;
    public $niveau;
    public $rol;
    public $competentie;
    public $studieduur;
    public $rating;
    public $bronnen;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
    
        // select all query
        $query = "SELECT
<<<<<<< Updated upstream
                    *
=======
                    kenniskaart_id, onderwerp, wat, why, how, plaatje, niveau, rol, competentie, studieduur, rating, bronnen
>>>>>>> Stashed changes
                FROM
                    ". $this->table_name . " 
                ORDER BY
                    onderwerp DESC";
<<<<<<< Updated upstream

=======
    
>>>>>>> Stashed changes
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
<<<<<<< Updated upstream

=======
    
>>>>>>> Stashed changes
        return $stmt;
    }
    
    // create product
    function create(){
<<<<<<< Updated upstream

        // makes niveau/rol/competentie multiple values
        $checkbox1=$_POST['niveau'];
        $niveau="";
        foreach($checkbox1 as $niveau1)
        {
            $niveau .= $niveau1."";
        }

        $checkbox2=$_POST['rol'];
        $rol="";
        foreach($checkbox2 as $rol1)
        {
            $rol .= $rol1.",";
        }

        $checkbox3=$_POST['competentie'];
        $competentie="";
        foreach($checkbox3 as $competentie1)
        {
            $competentie .= $competentie1.",";
        }

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "(onderwerp, rol, competentie, wat, why, how, plaatje, bronnen, niveau, studieduur, rating)
                VALUES(
                    '$_POST[onderwerp]',
                    '$rol',
                    '$competentie',
                    '$_POST[wat]',
                    '$_POST[why]',
                    '$_POST[how]',
                    '$_POST[plaatje]',
                    '$_POST[bronnen]',
                    '$niveau',
                    '$_POST[studieduur]',
                    '$_POST[rating]'
                     )";

        echo $query;

=======
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    onderwerp=:onderwerp, wat=:wat, why=:why, how=:how, plaatje=:plaatje, niveau=:niveau, rol=:rol, competentie=:competentie, studieduur=:studieduur, rating=:rating, bronnen=:bronnen";
    
>>>>>>> Stashed changes
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
<<<<<<< Updated upstream
        $this->onderwerp=htmlspecialchars($this->onderwerp);
        $this->wat=htmlspecialchars($this->wat);
        $this->why=htmlspecialchars($this->why);
        $this->how=htmlspecialchars($this->how);
        $this->plaatje=htmlspecialchars($this->plaatje);
        $this->niveau=htmlspecialchars($this->niveau);
        $this->rol=htmlspecialchars($this->rol);
        $this->competentie=htmlspecialchars($this->competentie);
        $this->studieduur=htmlspecialchars($this->studieduur);
        $this->rating=htmlspecialchars($this->rating);
        $this->bronnen=htmlspecialchars($this->bronnen);
=======
        $this->onderwerp=htmlspecialchars(strip_tags($this->onderwerp));
        $this->wat=htmlspecialchars(strip_tags($this->wat));
        $this->why=htmlspecialchars(strip_tags($this->why));
        $this->how=htmlspecialchars(strip_tags($this->how));
        $this->plaatje=htmlspecialchars(strip_tags($this->plaatje));
        $this->niveau=htmlspecialchars(strip_tags($this->niveau));
        $this->rol=htmlspecialchars(strip_tags($this->rol));
        $this->competentie=htmlspecialchars(strip_tags($this->competentie));
        $this->studieduur=htmlspecialchars(strip_tags($this->studieduur));
        $this->rating=htmlspecialchars(strip_tags($this->rating));
        $this->bronnen=htmlspecialchars(strip_tags($this->bronnen));
    
        // bind values
        $stmt->bindParam(":onderwerp", $this->onderwerp);
        $stmt->bindParam(":wat", $this->wat);
        $stmt->bindParam(":why", $this->why);
        $stmt->bindParam(":how", $this->how);
        $stmt->bindParam(":plaatje", $this->plaatje);
        $stmt->bindParam(":niveau", $this->niveau);
        $stmt->bindParam(":rol", $this->rol);
        $stmt->bindParam(":competentie", $this->competentie);
        $stmt->bindParam(":studieduur", $this->studieduur);
        $stmt->bindParam(":rating", $this->rating);
        $stmt->bindParam(":bronnen", $this->bronnen);
>>>>>>> Stashed changes
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // used when filling up the update product form
    function readOne(){
    
        // query to read single record
        $query =    "SELECT
<<<<<<< Updated upstream
                        *
=======
                        kenniskaart_id, onderwerp, wat, why, how, plaatje, niveau, rol, competentie, studieduur, rating, bronnen
>>>>>>> Stashed changes
                    FROM
                        ". $this->table_name . " 
                    WHERE 
                        kenniskaart_id = ?
                    LIMIT
                        0,1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->onderwerp = $row['onderwerp'];
        $this->wat = $row['wat'];
        $this->why = $row['why'];
        $this->how = $row['how'];
        $this->plaatje = $row['plaatje'];
        $this->niveau = $row['niveau'];
        $this->rol = $row['rol'];
        $this->competentie = $row['competentie'];
        $this->studieduur = $row['studieduur'];
        $this->rating = $row['rating'];
        $this->bronnen = $row['bronnen'];
    }

    // update the product
    function update(){
<<<<<<< Updated upstream

        // makes niveau/rol/competentie multiple values
        $checkbox1=$_POST['niveau'];
        $niveau="";
        foreach($checkbox1 as $niveau1)
        {
            $niveau .= $niveau1."";
        }

        $checkbox2=$_POST['rol'];
        $rol="";
        foreach($checkbox2 as $rol1)
        {
            $rol .= $rol1.",";
        }

        $checkbox3=$_POST['competentie'];
        $competentie="";
        foreach($checkbox3 as $competentie1)
        {
            $competentie .= $competentie1.",";
        }

        // update query
        $query = "UPDATE " . $this->table_name . " 
                 SET 
                     onderwerp = '$_POST[onderwerp]',
                     rol = '$rol',
                     competentie = '$competentie',
                     wat = '$_POST[wat]',
                     why = '$_POST[why]',
                     how = '$_POST[how]',
                     plaatje = '$_POST[plaatje]',
                     bronnen = '$_POST[bronnen]',
                     niveau = '$niveau',
                     studieduur = '$_POST[studieduur]',
                     rating = '$_POST[rating]'
                 WHERE onderwerp = '$_POST[onderwerp]' ";

        // prepare query statement
        echo $query;
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->onderwerp=htmlspecialchars($this->onderwerp);
        $this->wat=htmlspecialchars($this->wat);
        $this->why=htmlspecialchars($this->why);
        $this->how=htmlspecialchars($this->how);
        $this->plaatje=htmlspecialchars($this->plaatje);
        $this->niveau=htmlspecialchars($this->niveau);
        $this->rol=htmlspecialchars($this->rol);
        $this->competentie=htmlspecialchars($this->competentie);
        $this->studieduur=htmlspecialchars($this->studieduur);
        $this->rating=htmlspecialchars($this->rating);
        $this->bronnen=htmlspecialchars($this->bronnen);
=======
    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    onderwerp = :onderwerp,
                    wat = :wat,
                    why = :why,
                    how = :how,
                    plaatje = :plaatje,
                    niveau = :niveau,
                    rol = :rol,
                    competentie = :competentie, 
                    studieduur = :studieduur, 
                    rating = :rating, 
                    bronnen = :bronnen

                WHERE
                    kenniskaart_id = :kenniskaart_id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->onderwerp=htmlspecialchars(strip_tags($this->onderwerp));
        $this->wat=htmlspecialchars(strip_tags($this->wat));
        $this->why=htmlspecialchars(strip_tags($this->why));
        $this->how=htmlspecialchars(strip_tags($this->how));
        $this->plaatje=htmlspecialchars(strip_tags($this->plaatje));
        $this->niveau=htmlspecialchars(strip_tags($this->niveau));
        $this->rol=htmlspecialchars(strip_tags($this->rol));
        $this->competentie=htmlspecialchars(strip_tags($this->competentie));
        $this->studieduur=htmlspecialchars(strip_tags($this->studieduur));
        $this->rating=htmlspecialchars(strip_tags($this->rating));
        $this->bronnen=htmlspecialchars(strip_tags($this->bronnen));

        // bind values
        $stmt->bindParam(":onderwerp", $this->onderwerp);
        $stmt->bindParam(":wat", $this->wat);
        $stmt->bindParam(":why", $this->why);
        $stmt->bindParam(":how", $this->how);
        $stmt->bindParam(":plaatje", $this->plaatje);
        $stmt->bindParam(":niveau", $this->niveau);
        $stmt->bindParam(":rol", $this->rol);
        $stmt->bindParam(":competentie", $this->competentie);
        $stmt->bindParam(":studieduur", $this->studieduur);
        $stmt->bindParam(":rating", $this->rating);
        $stmt->bindParam(":bronnen", $this->bronnen);
>>>>>>> Stashed changes

        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // delete the product
    function delete(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE kenniskaart_id = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
<<<<<<< Updated upstream
        $this->kenniskaart_id=htmlspecialchars($this->kenniskaart_id);
=======
        $this->kenniskaart_id=htmlspecialchars(strip_tags($this->kenniskaart_id));
>>>>>>> Stashed changes
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->kenniskaart_id);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // search products
    function search($keywords){
    
        // select all query
        $query = "SELECT
<<<<<<< Updated upstream
                    *
=======
                    kenniskaart_id, onderwerp, wat, why, how, plaatje, niveau, rol, competentie, studieduur, rating, bronnen
>>>>>>> Stashed changes
                FROM
                    " . $this->table_name . "
                WHERE
                    onderwerp LIKE ? OR wat LIKE ? OR why LIKE ? OR how LIKE ?
                ORDER BY
                    kenniskaart DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
<<<<<<< Updated upstream
        $keywords=htmlspecialchars($keywords);
=======
        $keywords=htmlspecialchars(strip_tags($keywords));
>>>>>>> Stashed changes
        $keywords = "%{$keywords}%";
    
        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // read products with pagination
    public function readPaging($from_record_num, $records_per_page){
    
        // select query
        $query = "SELECT
<<<<<<< Updated upstream
                    *
=======
                    kenniskaart_id, onderwerp, wat, why, how, plaatje, niveau, rol, competentie, studieduur, rating, bronnen
>>>>>>> Stashed changes
                FROM
                    " . $this->table_name . " 
                ORDER BY onderwerp DESC
                LIMIT ?, ?";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind variable values
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
    
        // execute query
        $stmt->execute();
    
        // return values from database
        return $stmt;
    }

    // used for paging products
    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $row['total_rows'];
    }
}
=======
<?php
class Product{
  
    // database connection and table name
    private $conn;
    private $table_name = "sch_map.kenniskaart";
  
    // object properties
    public $kenniskaart_id;
    public $onderwerp;
    public $wat;
    public $why;
    public $how;
    public $plaatje;
    public $niveau;
    public $rol;
    public $competentie;
    public $studieduur;
    public $rating;
    public $bronnen;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    ". $this->table_name . " 
                ORDER BY
                    onderwerp DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();

        return $stmt;
    }
    
    // create product
    function create(){

        // makes niveau/rol/competentie multiple values
        $checkbox1=$_POST['niveau'];
        $niveau="";
        foreach($checkbox1 as $niveau1)
        {
            $niveau .= $niveau1."";
        }

        $checkbox2=$_POST['rol'];
        $rol="";
        foreach($checkbox2 as $rol1)
        {
            $rol .= $rol1.",";
        }

        $checkbox3=$_POST['competentie'];
        $competentie="";
        foreach($checkbox3 as $competentie1)
        {
            $competentie .= $competentie1.",";
        }

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "(onderwerp, rol, competentie, wat, why, how, plaatje, bronnen, niveau, studieduur, rating)
                VALUES(
                    '$_POST[onderwerp]',
                    '$rol',
                    '$competentie',
                    '$_POST[wat]',
                    '$_POST[why]',
                    '$_POST[how]',
                    '$_POST[plaatje]',
                    '$_POST[bronnen]',
                    '$niveau',
                    '$_POST[studieduur]',
                    '$_POST[rating]'
                     )";

        echo $query;

        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->onderwerp=htmlspecialchars($this->onderwerp);
        $this->wat=htmlspecialchars($this->wat);
        $this->why=htmlspecialchars($this->why);
        $this->how=htmlspecialchars($this->how);
        $this->plaatje=htmlspecialchars($this->plaatje);
        $this->niveau=htmlspecialchars($this->niveau);
        $this->rol=htmlspecialchars($this->rol);
        $this->competentie=htmlspecialchars($this->competentie);
        $this->studieduur=htmlspecialchars($this->studieduur);
        $this->rating=htmlspecialchars($this->rating);
        $this->bronnen=htmlspecialchars($this->bronnen);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // used when filling up the update product form
    function readOne(){
    
        // query to read single record
        $query =    "SELECT
                        *
                    FROM
                        ". $this->table_name . " 
                    WHERE 
                        kenniskaart_id = ?
                    LIMIT
                        0,1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->onderwerp = $row['onderwerp'];
        $this->wat = $row['wat'];
        $this->why = $row['why'];
        $this->how = $row['how'];
        $this->plaatje = $row['plaatje'];
        $this->niveau = $row['niveau'];
        $this->rol = $row['rol'];
        $this->competentie = $row['competentie'];
        $this->studieduur = $row['studieduur'];
        $this->rating = $row['rating'];
        $this->bronnen = $row['bronnen'];
    }

    // update the product
    function update(){

        // makes niveau/rol/competentie multiple values
        $checkbox1=$_POST['niveau'];
        $niveau="";
        foreach($checkbox1 as $niveau1)
        {
            $niveau .= $niveau1."";
        }

        $checkbox2=$_POST['rol'];
        $rol="";
        foreach($checkbox2 as $rol1)
        {
            $rol .= $rol1.",";
        }

        $checkbox3=$_POST['competentie'];
        $competentie="";
        foreach($checkbox3 as $competentie1)
        {
            $competentie .= $competentie1.",";
        }

        // update query
        $query = "UPDATE " . $this->table_name . " 
                 SET 
                     onderwerp = '$_POST[onderwerp]',
                     rol = '$rol',
                     competentie = '$competentie',
                     wat = '$_POST[wat]',
                     why = '$_POST[why]',
                     how = '$_POST[how]',
                     plaatje = '$_POST[plaatje]',
                     bronnen = '$_POST[bronnen]',
                     niveau = '$niveau',
                     studieduur = '$_POST[studieduur]',
                     rating = '$_POST[rating]'
                 WHERE onderwerp = '$_POST[onderwerp]' ";

        // prepare query statement
        echo $query;
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->onderwerp=htmlspecialchars($this->onderwerp);
        $this->wat=htmlspecialchars($this->wat);
        $this->why=htmlspecialchars($this->why);
        $this->how=htmlspecialchars($this->how);
        $this->plaatje=htmlspecialchars($this->plaatje);
        $this->niveau=htmlspecialchars($this->niveau);
        $this->rol=htmlspecialchars($this->rol);
        $this->competentie=htmlspecialchars($this->competentie);
        $this->studieduur=htmlspecialchars($this->studieduur);
        $this->rating=htmlspecialchars($this->rating);
        $this->bronnen=htmlspecialchars($this->bronnen);

        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // delete the product
    function delete(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE kenniskaart_id = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->kenniskaart_id=htmlspecialchars($this->kenniskaart_id);
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->kenniskaart_id);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // search products
    function search($keywords){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    onderwerp LIKE ? OR wat LIKE ? OR why LIKE ? OR how LIKE ?
                ORDER BY
                    kenniskaart DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $keywords=htmlspecialchars($keywords);
        $keywords = "%{$keywords}%";
    
        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // read products with pagination
    public function readPaging($from_record_num, $records_per_page){
    
        // select query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                ORDER BY onderwerp DESC
                LIMIT ?, ?";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind variable values
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
    
        // execute query
        $stmt->execute();
    
        // return values from database
        return $stmt;
    }

    // used for paging products
    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $row['total_rows'];
    }
}
>>>>>>> a100a847fd5f07fe90888908521a677d15bc302c
=======
<?php
class Product{
  
    // database connection and table name
    private $conn;
    private $table_name = "sch_map.kenniskaart";
  
    // object properties
    public $kenniskaart_id;
    public $onderwerp;
    public $wat;
    public $why;
    public $how;
    public $plaatje;
    public $niveau;
    public $rol;
    public $competentie;
    public $studieduur;
    public $rating;
    public $bronnen;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read(){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    ". $this->table_name . " 
                ORDER BY
                    onderwerp DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();

        return $stmt;
    }
    
    // create product
    function create(){

        // makes niveau/rol/competentie multiple values
        $checkbox1=$_POST['niveau'];
        $niveau="";
        foreach($checkbox1 as $niveau1)
        {
            $niveau .= $niveau1."";
        }

        $checkbox2=$_POST['rol'];
        $rol="";
        foreach($checkbox2 as $rol1)
        {
            $rol .= $rol1.",";
        }

        $checkbox3=$_POST['competentie'];
        $competentie="";
        foreach($checkbox3 as $competentie1)
        {
            $competentie .= $competentie1.",";
        }

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "(onderwerp, rol, competentie, wat, why, how, plaatje, bronnen, niveau, studieduur, rating)
                VALUES(
                    '$_POST[onderwerp]',
                    '$rol',
                    '$competentie',
                    '$_POST[wat]',
                    '$_POST[why]',
                    '$_POST[how]',
                    '$_POST[plaatje]',
                    '$_POST[bronnen]',
                    '$niveau',
                    '$_POST[studieduur]',
                    '$_POST[rating]'
                     )";

        echo $query;

        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->onderwerp=htmlspecialchars($this->onderwerp);
        $this->wat=htmlspecialchars($this->wat);
        $this->why=htmlspecialchars($this->why);
        $this->how=htmlspecialchars($this->how);
        $this->plaatje=htmlspecialchars($this->plaatje);
        $this->niveau=htmlspecialchars($this->niveau);
        $this->rol=htmlspecialchars($this->rol);
        $this->competentie=htmlspecialchars($this->competentie);
        $this->studieduur=htmlspecialchars($this->studieduur);
        $this->rating=htmlspecialchars($this->rating);
        $this->bronnen=htmlspecialchars($this->bronnen);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // used when filling up the update product form
    function readOne(){
    
        // query to read single record
        $query =    "SELECT
                        *
                    FROM
                        ". $this->table_name . " 
                    WHERE 
                        kenniskaart_id = ?
                    LIMIT
                        0,1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->onderwerp = $row['onderwerp'];
        $this->wat = $row['wat'];
        $this->why = $row['why'];
        $this->how = $row['how'];
        $this->plaatje = $row['plaatje'];
        $this->niveau = $row['niveau'];
        $this->rol = $row['rol'];
        $this->competentie = $row['competentie'];
        $this->studieduur = $row['studieduur'];
        $this->rating = $row['rating'];
        $this->bronnen = $row['bronnen'];
    }

    // update the product
    function update(){

        // makes niveau/rol/competentie multiple values
        $checkbox1=$_POST['niveau'];
        $niveau="";
        foreach($checkbox1 as $niveau1)
        {
            $niveau .= $niveau1."";
        }

        $checkbox2=$_POST['rol'];
        $rol="";
        foreach($checkbox2 as $rol1)
        {
            $rol .= $rol1.",";
        }

        $checkbox3=$_POST['competentie'];
        $competentie="";
        foreach($checkbox3 as $competentie1)
        {
            $competentie .= $competentie1.",";
        }

        // update query
        $query = "UPDATE " . $this->table_name . " 
                 SET 
                     onderwerp = '$_POST[onderwerp]',
                     rol = '$rol',
                     competentie = '$competentie',
                     wat = '$_POST[wat]',
                     why = '$_POST[why]',
                     how = '$_POST[how]',
                     plaatje = '$_POST[plaatje]',
                     bronnen = '$_POST[bronnen]',
                     niveau = '$niveau',
                     studieduur = '$_POST[studieduur]',
                     rating = '$_POST[rating]'
                 WHERE onderwerp = '$_POST[onderwerp]' ";

        // prepare query statement
        echo $query;
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->onderwerp=htmlspecialchars($this->onderwerp);
        $this->wat=htmlspecialchars($this->wat);
        $this->why=htmlspecialchars($this->why);
        $this->how=htmlspecialchars($this->how);
        $this->plaatje=htmlspecialchars($this->plaatje);
        $this->niveau=htmlspecialchars($this->niveau);
        $this->rol=htmlspecialchars($this->rol);
        $this->competentie=htmlspecialchars($this->competentie);
        $this->studieduur=htmlspecialchars($this->studieduur);
        $this->rating=htmlspecialchars($this->rating);
        $this->bronnen=htmlspecialchars($this->bronnen);

        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // delete the product
    function delete(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE kenniskaart_id = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->kenniskaart_id=htmlspecialchars($this->kenniskaart_id);
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->kenniskaart_id);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

    // search products
    function search($keywords){
    
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . "
                WHERE
                    onderwerp LIKE ? OR wat LIKE ? OR why LIKE ? OR how LIKE ?
                ORDER BY
                    kenniskaart DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $keywords=htmlspecialchars($keywords);
        $keywords = "%{$keywords}%";
    
        // bind
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // read products with pagination
    public function readPaging($from_record_num, $records_per_page){
    
        // select query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " 
                ORDER BY onderwerp DESC
                LIMIT ?, ?";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind variable values
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
    
        // execute query
        $stmt->execute();
    
        // return values from database
        return $stmt;
    }

    // used for paging products
    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
    
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $row['total_rows'];
    }
}
>>>>>>> a100a847fd5f07fe90888908521a677d15bc302c
>>>>>>> Stashed changes
?>