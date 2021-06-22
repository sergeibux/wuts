<?php


include_once '../DbFacilities/Dbo.php';
include_once '../DbFacilities/Entities/SpeciesBranch.php';
// include_once '../DbFacilities/DbSucker.php';
// include_once '../Logger.php';

  $request_method = $_SERVER["REQUEST_METHOD"];
  
//   echo "012<br>";

  header('Content-Type: application/json');
  switch($request_method)
  {
      case 'GET':
//       echo "0";
          if(!empty($_GET["id"])){
//               echo "0id";
              $id = intval($_GET["id"]);
              getSpecies($id);
//               echo "1";
          } else if(!empty($_GET["ok"])){
              testOk($_GET["ok"]);
          } else if(!empty($_GET["branches"])){
              getBranches($_GET["branches"]);
          } else {
              //TODO have to chage this : remote db => our DB
              getSpecies();
          }
          break;
      default:
//           echo "0def";
          // Requête invalide
          header("HTTP/1.0 405 Method Not Allowed");
          break;
  }
  
//   function getSpecies(int $id){
//       //TODO
//       define("LIMIT", 1);
//       $dataSrc = DbSucker::MNHN;
//       $jsonTab = $DbSucker->getSpeciesByIdRange($dataSrc, $i, LIMIT);
//       $tabSize = sizeof($jsonTab);
//           for ($j=0; $j<$tabSize; ){
//               $distSpecies = $jsonTab[$j];
//               $id = $j + $i;
//               //                 $species[$id] = new Specimen(); //TODO do not works
//               $j++;
//           }
//           header('Content-Type: application/json');
//           echo json_encode($jsonTab, JSON_PRETTY_PRINT);
//           return;
//   }
  
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
  
  /*
   * Recover all species from outside database
   * //TODO have to chage this : remote db => our DB
   * -> MNHM
   */
  function getSpecies(){
// header('Content-Type: application/json');
// //       echo json_encode($jsonTab, JSON_PRETTY_PRINT);
//       //TODO
// //       echo "<br>get all species";
//       define("LIMIT", 10);
//       $dataSrc = DbSucker::MNHN;
//       $totalAmount = $DbSucker->getSpeciesCount($dataSrc, LIMIT);
//       $json;
//       for ($i = 0; $i <= $totalAmount; ){
//           $jsonTab = $DbSucker->getSpeciesByIdRange($dataSrc, $i, LIMIT);
//           $tabSize = sizeof($jsonTab);
//           for ($j=0; $j<$tabSize; ){
//               $distSpecies = $jsonTab[$j];
//               $id = $j + $i;
// //                 $species[$id] = new Specimen(); //TODO do not works
//               $j++;
//           }
// //           header('Content-Type: application/json');
// //           header("Content-type: text/javascript");
//           $i += LIMIT;
//           $json = array_push($json, $jsonTab);
//       }
//       $tab["result"] = "???";
//           echo json_encode($tab, JSON_PRETTY_PRINT);
  }
  
  function getBranches($which){
      switch ($which){
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