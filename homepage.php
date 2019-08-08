<?php
// core configuration
include_once "config/core.php";
 
// set page title
$page_title="Valgfri uddannelsesspecifikke fag";

// include classes
include_once 'config/database.php';

// get database connection
$database = new Database();
$db = $database->getConnection();


// include page header HTML
include_once 'layot_head.php';
echo "<div class='container'>";
  echo "<div class='jumbotron'>";
    
  echo "</div>";
echo "</div>";

echo "<div class='col-md-12'>";

// actual HTML Homepage form
echo "<div class='page'>";


    echo "<p>Elev og virksomhed skal evt. i samarbejde med skolen
    tage stilling til, hvilke valgfri uddannelsesspecifikke
    fag de finder hensigtsmæssige i forhold til virksomhedens arbejdsopgaver.
    Valget skal finde sted indenfor det første år af elevens uddannelsesår efter grundforløbet.
    Når fagene er valgt vil det fremgå af elevens
    personlige uddannelsesplan. Det sørger Mercantec
    for.
    Undervisningen i de valgfri uddannelsesspecifikke
    fag udgør nedenstående antal uger alt efter bekendtgørelse og speciale.</p>";
    echo "<div class='grid-container' style='width:1130px;height:400px;overflow:auto; background:White;'>";
        echo "<div class='kapsule'>";
            echo "<h3>Auto</h3>";
            echo "<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Consequatur iure ullam harum totam dolorem tempora, esse natus quo eius.
             Mollitia asperiores vitae ab saepe nemo ducimus laudantium porro reiciendis doloribus. </p>";
        echo "</div>";
        echo "<div class='kapsule'>";
            echo "<h3>Data</h3>";
            echo "<p>Du har mulighed for at tage fagene i hovedforløbet på
            et højere niveau. Du kan i samarbejde med din kontaktlærer vælge at løfte niveauet til
             “Rutineret, avanceret og ekspert”. Dit valg skal godkendes af kontaktlæreren.
            Vedrørende indhold af de enkelte valgfri uddannelsesspecifikke fag, henvises der til </p> <a href='//www.eud-adm.dk'>www.eud-adm.dk</a>
            ";
           echo "<a href='https://mars.tekkom.dk/w/images/5/52/2019_Faktaark_TVC_Valgfri_uddannelsesspecifikke_fag.pdf'>Læs mere her</a>";
        echo "</div>";
        echo "<div class='kapsule'>";
            echo "<h3>Automatiktekniker</h3>";
            echo "<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
             Consequatur iure ullam harum totam dolorem tempora, esse natus quo eius.
              Mollitia asperiores vitae ab saepe nemo ducimus laudantium porro reiciendis doloribus.</p>";
        echo "</div>";
    echo "</div>";
    echo "<h2>Kontakt personer</h2>";
    echo "<div class='kontakt' style='width:1130px;height:255px;overflow:auto'>";
    echo "<div class='personer'>";
       echo "<img class='profile-img' src='images/Ib.gif' >";
        echo "<p> Studievejleder & Praktikpladskonsulent <br> Ib wittenhoff haubo <br> Teknologisk Videncenter
         <br> Tlf. +45 8950 3436 <br> Mobil +45 2043 7255 <br> iwje@mercantec.dk</p>";
        echo  "</div>";
        echo "<div class='personer'>";
       echo "<img class='profile-img' src='images/lapj.jpg' >";
        echo "<p> Studievejleder & Praktikpladskonsulent <br> Lars Milter Jensen <br> Teknologisk Videncenter
         <br> Tlf. +45 8950 3426 <br> Mobil +45 5132 4276 <br> lapj@mercantec.dk</p>";
        echo  "</div>";
        echo "<div class='personer'>";
        echo "<img class='profile-img' src='images/giso.jpg' >";
         echo "<p> Studiesekretær <br> Gitte Sommer Jersen <br> Teknologisk Videncenter
          <br> Tlf. +45 8950 3345 <br> Mobil +45 <br> giso@mercantec.dk</p>";
         echo  "</div>";
         echo "<div class='personer'>";
         echo "<img class='profile-img' src='images/mosi.jpg' >";
          echo "<p> Praktikpladskonsulent & studievejleder <br> Morten Simonsen <br> Byggetek
           <br> Tlf. +45 8950 3300 <br> Mobil +45 4041 5367 <br> mosi@mercantec.dk</p>";
          echo  "</div>";
          echo "<div class='personer'>";
          echo "<img class='profile-img' src='images/inph.jpg' >";
           echo "<p> Praktikpladskonsulent og Erhvervs- og uddannelsesvejleder <br> Inger Philipsen <br> Hotel- & Restaurantskolen
            <br> Tlf. +45 8950 3300 <br> Mobil +45 4023 8958 <br> inph@mercantec.dk</p>";
           echo  "</div>";
           echo "<div class='personer'>";
           echo "<img class='profile-img' src='images/pete.jpg' >";
            echo "<p> Underviser, Vejleder & Praktikpladskonsulent <br> Per Tegtmeier <br> Teknologisk Videncenter
             <br> Tlf. +45 8950 3719br> Mobil +45 2016 7856 <br> pete@mercantec.dk</p>";
            echo  "</div>";
    echo  "</div>";
echo "</div>";
   
// to identify page for paging
$page_url="homepage.php?";
echo "</div>";
echo "<div>";
echo "<p>Mercantec H.C. Andersens Vej 9, 8800 Viborg <br> Tlf. +4589503300 <br> mercantec@nercantec.dk
 <br> EAN-nr. 5798000556676 <br> CVR-nr. 14940596 </p>";
echo "</div>";

// footer HTML and JavaScript codes
include 'layot_foot.php';

?>