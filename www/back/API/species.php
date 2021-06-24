<?php


include_once '../DbFacilities/Dbo.php';
include_once '../DbFacilities/Entities/SpeciesBranch.php';
include_once '../DbFacilities/Entities/Species.php';
// include_once '../DbFacilities/DbSucker.php';
// include_once '../Logger.php';

  $request_method = $_SERVER["REQUEST_METHOD"];
  
//   echo "012<br>";

  header('Content-Type: application/json');
  switch($request_method)
  {
      case 'GET':
//       echo "0";
          if(!empty($_GET["species"])){
              $key = intval($_GET["species"]);
              getSpecies($key);
          } else if(!empty($_GET["branches"])){
              getBranches($_GET["branches"]);
          }
          break;
      default:
//           echo "0def";
          // Requête invalide
          header("HTTP/1.0 405 Method Not Allowed");
          break;
  }
  
  function getSpecies(int $key){
      switch ($key){
          case 'all' :
              //Get all branches name and descriptions
              echo json_encode(Species::getAllSpecies(), JSON_PRETTY_PRINT);
              break;
          case 'match' :
              if (!empty($_GET["search"])
              && !empty($_GET["limit"])){
                  echo json_encode(Species::getSomeSpeciesMatching($_GET["search"], $_GET["limit"]), JSON_PRETTY_PRINT);
              }
              break;
          default :
              echo json_encode(Species::getAllSpecies(), JSON_PRETTY_PRINT);
              break;
      }
  }
  
  function testOk($ok){
//       $tab = array();
      if ($ok == "tab"){
          $content[0] = "number 0";
          $content[1] = 1;
          $content[2] = "rest API working with PHP";
//            $tab = $content;
          $tab["result"] = $content;
      } else {
          $tab["result"] = "OK : $ok";
      }
      echo json_encode($tab, JSON_PRETTY_PRINT);
  }
  
function getBranches($key){
      switch ($key){
          case 'all' :
              //Get all branches name and descriptions
              echo json_encode(SpeciesBranch::getAllBranches(), JSON_PRETTY_PRINT);
              break;
          default : 
              echo json_encode(SpeciesBranch::getAllBranches(), JSON_PRETTY_PRINT);
              break;
      }
  }
  
?>