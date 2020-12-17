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

   //     echo  $_POST[onderwerp];
//        $onderwerp = htmlspecialchars($_POST[onderwerp]);
        $onderwerp = $_POST[onderwerp];
//        $onderwerp =htmlspecialchars('äé');
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "(onderwerp, rol, competentie, wat, why, how, plaatje, bronnen, niveau, studieduur, rating)
                VALUES(
                    '$onderwerp' ,
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

        // prepare query
        $stmt = $this->conn->prepare($query);


        echo $query;
        echo '<BR><BR>WTF';

        // sanitize
        $this->onderwerp=htmlspecialchars($this->onderwerp, ENT_NOQUOTES);
        $this->wat=htmlspecialchars($this->wat, ENT_NOQUOTES);
        $this->why=htmlspecialchars($this->why, ENT_NOQUOTES);
        $this->how=htmlspecialchars($this->how, ENT_NOQUOTES);
        $this->plaatje=htmlspecialchars($this->plaatje, ENT_NOQUOTES);
        $this->niveau=htmlspecialchars($this->niveau, ENT_NOQUOTES);
        $this->rol=htmlspecialchars($this->rol, ENT_NOQUOTES);
        $this->competentie=htmlspecialchars($this->competentie, ENT_NOQUOTES);
        $this->studieduur=htmlspecialchars($this->studieduur, ENT_NOQUOTES);
        $this->rating=htmlspecialchars($this->rating, ENT_NOQUOTES);
        $this->bronnen=htmlspecialchars($this->bronnen, ENT_NOQUOTES);


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
?>