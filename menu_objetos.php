<?php
$db = new PDO('mysql:host=localhost;dbname=vistausuario', 'root', '');



function drawMenu($db, $parent, $level = null) {
    $m = $db->prepare(" SELECT * FROM menu_objetos where Menu_Padre =  $parent");
    $m->execute();


    foreach ($m->fetchAll() as $row) {
        $m = $db->prepare("SELECT count(*) FROM menu_objetos where Menu_Padre = " . $row['Cve_Menu'] . "");
        $m->execute();

        if($row['Menu_Padre'] !== '0' && $level !== 0){ 
            echo "<li> <a class=\"dropdown-item\" href=\"#\">" . $row['Descripcion'] . "</a></li>\n";
            echo " <ul class=\"submenu dropdown-menu\">";
            drawSubMenu($db, $row[0], $level - 1);
        }
        else { 
            validarMenu($db,$row[0],$row['Descripcion']);

        }
    }
}

function drawSubMenu($db2, $parent2, $level2 = null) {
    $m2 = $db2->prepare(" SELECT * FROM menu_objetos where Menu_Padre =  $parent2");
    $m2->execute();

    echo " <ul class=\"submenu dropdown-menu\">";

    foreach ($m2->fetchAll() as $row) {
        $m = $db2->prepare("SELECT count(*) FROM menu_objetos where Menu_Padre = " . $row['Cve_Menu'] . "");
        $m->execute();

        if($row['Menu_Padre'] !== '0' && $level2 !== 0){ 
            // echo "<li> <a class=\"dropdown-item\" href=\"#\">" . $row['label'] . "</a></li>\n";
            validarMenu($db2,$row[0],$row['Descripcion']);
        }
        else { // The item is a leaf or we reach the end level, i.e. base case, so do print the item label 
           
        }
    }
    echo "</ul>\n";

}
function validarMenu($db3,$parent3,$label = null){
    $m3 = $db3->prepare("SELECT COUNT(*) FROM menu_objetos where Menu_Padre = $parent3");
    $m3-> execute();

    foreach ($m3->fetchAll() as $row) {
        if($row['0'] !== '0'){ 
            echo "<li> <a class=\"dropdown-item\" href=\"#\">" . $label . "&raquo; </a>\n";
            drawSubMenu($db3,$parent3,null);
        }
        else{
            echo "<li> <a class=\"dropdown-item\" href=\"#\">" . $label . "</a></li>\n";
        }
    }

}
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style>
    /* ============ desktop view ============ */
      @media all and (min-width: 992px) {
      
        .dropdown-menu li{
          position: relative;
        }
        .dropdown-menu .submenu{ 
          display: none;
          position: absolute;
          left:100%; top:-7px;
        }
        .dropdown-menu .submenu-left{ 
          right:100%; left:auto;
        }
      
        .dropdown-menu > li:hover{ background-color: #f1f1f1 }
        .dropdown-menu > li:hover > .submenu{
          display: block;
        }
      }	
      /* ============ desktop view .end// ============ */
      
      /* ============ small devices ============ */
      @media (max-width: 991px) {
      
      .dropdown-menu .dropdown-menu{
          margin-left:0.7rem; margin-right:0.7rem; margin-bottom: .5rem;
      }
      
      }	
      /* ============ small devices .end// ============ */
      
      </style>
      
      
      <script type="text/javascript">
      //	window.addEventListener("resize", function() {
      //		"use strict"; window.location.reload(); 
      //	});
      
      
        document.addEventListener("DOMContentLoaded", function(){
              
      
            /////// Prevent closing from click inside dropdown
          document.querySelectorAll('.dropdown-menu').forEach(function(element){
            element.addEventListener('click', function (e) {
              e.stopPropagation();
            });
          })
      
      
      
          // make it as accordion for smaller screens
          if (window.innerWidth < 992) {
      
            // close all inner dropdowns when parent is closed
            document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){
              everydropdown.addEventListener('hidden.bs.dropdown', function () {
                // after dropdown is hidden, then find all submenus
                  this.querySelectorAll('.submenu').forEach(function(everysubmenu){
                    // hide every submenu as well
                    everysubmenu.style.display = 'none';
                  });
              })
            });
            
            document.querySelectorAll('.dropdown-menu a').forEach(function(element){
              element.addEventListener('click', function (e) {
          
                  let nextEl = this.nextElementSibling;
                  if(nextEl && nextEl.classList.contains('submenu')) {	
                    // prevent opening link if link needs to open dropdown
                    e.preventDefault();
                    console.log(nextEl);
                    if(nextEl.style.display == 'block'){
                      nextEl.style.display = 'none';
                    } else {
                      nextEl.style.display = 'block';
                    }
      
                  }
              });
            })
          }
          // end if innerWidth
      
        }); 
        // DOMContentLoaded  end
      </script>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"  aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main_nav">
        <ul class="navbar-nav">
            <li class="nav-item dropdown" id="myDropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">  Menú  
                   
                </a>
                <?php
                   echo ' <ul class="dropdown-menu">';
                   drawMenu($db, 0, 1); // all levels
                   echo "</ul>";
                   ?> 
            </li>

        </ul>

        </div>
    </div>
</nav>





<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous"></script>
      
</body>
</html>