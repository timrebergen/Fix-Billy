<?php
    class Database2{

        // specify your own database credentials
        private $host = "localhost";
        private $port = "5432";
        private $db_name = "EBilly";
        private $username = "postgres";
        private $password = "WelKom7993";
        private static $conn;

        // get the database connection
        public function getConnection(){

            $conn = null;

            try{
                $pdo = new PDO("pgsql: host=" . $this->host . "; port=" . $this->port . " dbname=" . $this->db_name . " user=" . $this->username . " password=" . $this->password);
                $pdo->exec("set names utf8");

                $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

                return $pdo;

            }catch(PDOException $exception){
                echo "Connection error: " . $exception->getMessage();
            }

            return $this->conn;
        }

        public static function get() {
            if (null === static::$conn) {
                static::$conn = new static();
            }

            return static::$conn;
        }
    }

    Class Update{
        // database connection and table name
        private $conn;
        public $table = "sch_map.kenniskaart";

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

        function update(){
            // UPDATE query
            $stmt = $this->pdo->query(
                'SELECT kenniskaart_id, onderwerp, rol, competentie, wat, why, how, plaatje, bronnen, niveau, studieduur, rating'
                . 'FROM sch_map.kenniskaart '
                . 'ORDER BY onderwerp');

            $kaart = [];

            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $kaart[] = [
                    'kenniskaart_id' => $row['kenniskaart_id'],
                    'onderwerp' => $row['onderwerp'],
                    'rol' => $row['rol'],
                    'competentie' => $row['competentie'],
                    'wat' => $row['wat'],
                    'why' => $row['why'],
                    'how' => $row['how'],
                    'plaatje' => $row['plaatje'],
                    'bronnen' => $row['bronnen'],
                    'niveau' => $row['niveau'],
                    'studieduur' => $row['studieduur'],
                    'rating' => $row['rating']
                ];
            }
            return $kaart;
        }
    }

    if (
        isset($_POST['opslaan'])
        and $_POST['plaatje'] <> "" and $_POST['rol'] <> "" and $_POST['onderwerp'] <> "" and $_POST['competentie'] <> "" and $_POST['wat'] <> "" and $_POST['why'] <> "" and $_POST['how'] <> ""  and $_POST['bronnen'] <> "" and $_POST['niveau'] <> "" and $_POST['studieduur'] <> "" and $_POST['rating'] <> ""
    ) {

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
    } try{
        $pdo = Database2::get()->getConnection();
        $sql_insert_naam = "UPDATE sch_map.kenniskaart
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
                 WHERE kenniskaart_id = '$_POST[kenniskaart_id]' ";

        $stmt = $pdo->query($sql_insert_naam);

        if($stmt === false){
            die("Error executing the query: $sql_get_depts");
        }
    }
    catch (PDOException $e){
        echo $e->getMessage();
    }


    $sql_get_kaart = "SELECT onderwerp, rol, competentie, wat, why, how, plaatje, bronnen, niveau, studieduur, rating FROM sch_map.kenniskaart ORDER BY onderwerp;";

    try {
        $pdo = Database2::get()->getConnection();
        #echo 'A connection to the PostgreSQL database sever has been established successfully.';
        //
        $stmt = $pdo->query($sql_get_kaart);

        if($stmt === false){
            die("Error executing the query: $sql_get_depts");
        }

    }catch (PDOException $e){
        echo $e->getMessage();
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
        <form name="myForm" onsubmit="return validateForm()" action="../index.html" method="post">
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
