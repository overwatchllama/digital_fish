<!doctype html>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    };
include "pass.php";
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <script src="js/jquery.js"></script>
    <script src="js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="css/fa/css/fontawesome-all.min.css">
    <!-- <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet"> -->


    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <title>J5</title>
  </head>
  


<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">DigitalFish</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php?page=home">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=dash">Dashboard</a>
      </li>


<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Info
        </a>
<div class="dropdown-menu" aria-labelledby="navbarDropdown">
 <a class="dropdown-item" href="index.php?page=phases"><i class="fas fa-info-circle" style="padding-right:5px;"></i>Phase Status</a><div class="dropdown-divider"></div>
 <a class="dropdown-item" href="index.php?page=rssfeed"><i class="fas fa-info-circle" style="padding-right:5px;"></i>RSS Log</a>

 
</div>
        
      </li>

 <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Configuration
        </a>
<div class="dropdown-menu" aria-labelledby="navbarDropdown">
 <a class="dropdown-item" href="index.php?page=thermedit"><i class="fas fa-wrench" style="padding-right:5px;"></i>Therm Config</a><div class="dropdown-divider"></div>
 <a class="dropdown-item" href="index.php?page=atoconfig"><i class="fas fa-wrench" style="padding-right:5px;"></i>ATO Config</a><div class="dropdown-divider"></div>
 <a class="dropdown-item" href="index.php?page=phaseconfig"><i class="fas fa-wrench" style="padding-right:5px;"></i>Phase Lengths</a><div class="dropdown-divider"></div>
 <a class="dropdown-item" href="index.php?page=gpio"><i class="far fa-question-circle" style="padding-right:5px;"></i>GPIO Check</a><div class="dropdown-divider"></div>
 <a class="dropdown-item" href="index.php?page=services"><i class="far fa-question-circle" style="padding-right:5px;"></i>Service Check</a><div class="dropdown-divider"></div>
 <a class="dropdown-item" href="index.php?page=userconfig"><i class="fas fa-user" style="padding-right:5px;"></i>User Password</a>
 
</div>
        
      </li>


    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Modules
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="index.php?page=filtration"><i class="fas fa-filter" style="padding-right:5px;"></i>Filtration</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="index.php?page=thermgraphs"><i class="fas fa-thermometer-half" style="padding-right:5px;"></i>Therm Graphs</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="index.php?page=dosing"><i class="fas fa-vial" style="padding-right:5px;"></i>Dosing</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="index.php?page=atostats"><i class="fas fa-tint" style="padding-right:5px;"></i>ATO Statistics</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="index.php?page=lddlights"><i class="far fa-lightbulb" style="padding-right:5px;"></i>LDD Lights</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="index.php?page=wavemaker"><i class="far fa-lightbulb" style="padding-right:5px;"></i>Wavemaker/Pulsor</a>
        </div>
      </li>


       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Water
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="index.php?page=waterchange"><i class="fas fa-tint" style="padding-right:5px;"></i>Water Change Log</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="index.php?page=chemedit"><i class="fas fa-tint" style="padding-right:5px;"></i>Chem: View/Edit/Add</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="chem_graph.php"><i class="fas fa-tint" style="padding-right:5px;"></i>Chem: Graphs</a>
        
        <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="index.php?page=chemtable"><i class="fas fa-tint" style="padding-right:5px;"></i>Chem: Age Linear</a>
        
     

<div class="dropdown-divider"></div>
          <a class="dropdown-item" href="index.php?page=chemread"><i class="fas fa-tint" style="padding-right:5px;"></i>Chem: Quick Readings</a>


        </div>
      </li>
     
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Inhabitants
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="index.php?page=inhabitants">View/Edit/Add</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="index.php?page=inhabitantsreport">Health Report</a>
        </div>
      </li>
    
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Relays
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="index.php?page=relaystable">Relays Quick Set</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="index.php?page=relays">Relay Full Config</a>
        </div>
      </li>
    </ul>
    <span class="navbar-text">
      <a href="logout.php">LOGOUT</a>
    </span>
  </div>
</nav>

