<?php
// core configuration
include_once "config/core.php";
 
// set page title
$page_title="";


// include classes
include_once 'config/database.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// include page header HTML
include_once 'layot_head.php';

echo "<div class='col-md-12'>";

// actual HTML Homepage form
echo "<div class='page'>";
    echo "<h2>Valgfri uddannelsesspecifikke fag</h2>";
    echo "<p>Elev og virksomhed skal evt. i samarbejde med skolen
    tage stilling til, hvilke valgfri uddannelsesspecifikke
    fag de finder hensigtsmæssige i forhold til virksomhedens arbejdsopgaver.
    Valget skal finde sted indenfor det første år af elevens uddannelsesår efter grundforløbet.
    Når fagene er valgt vil det fremgå af elevens
    personlige uddannelsesplan. Det sørger Mercantec
    for.
    Undervisningen i de valgfri uddannelsesspecifikke
    fag udgør nedenstående antal uger alt efter bekendtgørelse og speciale.</p>";
    echo "<div class='grid-container'>";
        echo "<div class='kapsule'>";
            echo "<h3>Auto</h3>";
            echo "<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Consequatur iure ullam harum totam dolorem tempora, esse natus quo eius.
             Mollitia asperiores vitae ab saepe nemo ducimus laudantium porro reiciendis doloribus. </p>";
        echo "</div>";
        echo "<div class='kapsule'>";
            echo "<h3>Data</h3>";
            echo "<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Consequatur iure ullam harum totam dolorem tempora, esse natus quo eius.
             Mollitia asperiores vitae ab saepe nemo ducimus laudantium porro reiciendis doloribus. </p>";
           echo "<a href='https://mars.tekkom.dk/w/images/5/52/2019_Faktaark_TVC_Valgfri_uddannelsesspecifikke_fag.pdf'>Læs mere her</a>";
        echo "</div>";
        echo "<div class='kapsule'>";
            echo "<h3>Elektrikker</h3>";
            echo "<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
             Consequatur iure ullam harum totam dolorem tempora, esse natus quo eius.
              Mollitia asperiores vitae ab saepe nemo ducimus laudantium porro reiciendis doloribus.</p>";
        echo "</div>";
    echo "</div>";
    echo "<h2>Kontakt personer</h2>";
    echo "<div class='kontakt'>";
    echo "<div class='personer'>";
       echo "<img class='profile-img' src='image/Ib.jpg' >";
        echo "<p> Ib wittenhoff haubo <br> Teknologisk Videncenter
         <br> Tlf. +4589503436 <br> Mobil +4520437255 <br> iwje@mercantec.dk</p>";
        echo  "</div>";
        echo "<div class='personer'>";
       echo "<img class='profile-img' src='image/lapj.jpg' >";
        echo "<p> Lars Milter Jensen <br> Teknologisk Videncenter
         <br> Tlf. +4589503476 <br> Mobil +4551324276 <br> lapj@mercantec.dk</p>";
        echo  "</div>";
    echo  "</div>";
echo "</div>";
   
    
echo "</div>";
echo "<div>";
echo "<p>Mercantec H.C. Andersens Vej 9, 8800 Viborg <br> Tlf. +4589503300 <br> mercantec@nercantec.dk
 <br> EAN-nr. 5798000556676 <br> CVR-nr. 14940596 </p>";
echo "</div>";

// footer HTML and JavaScript codes
include 'layot_foot.php';

?>