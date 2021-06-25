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
              $key = strval($_GET["species"]);
              getSpecies($key);
          } else if(!empty($_GET["genders"])){
              getGenders($_GET["genders"]);
          } else if(!empty($_GET["families"])){
              getFamilies($_GET["families"]);
          } else if(!empty($_GET["orders"])){
              getOrders($_GET["orders"]);
          } else if(!empty($_GET["classes"])){
              getClasses($_GET["classes"]);
          }else if(!empty($_GET["branches"])){
              getBranches($_GET["branches"]);
          }
          break;
      default:
          header("HTTP/1.0 405 Method Not Allowed");
          break;
  }
  
  function getSpecies(string $key){
      switch ($key){
          case 'all' :
              echo json_encode(Species::getAllSpecies(), JSON_PRETTY_PRINT);
              break;
          case 'match' :
              if (!empty($_GET["search"])
              && !empty($_GET["limit"])){
                  echo json_encode(Species::getSomeSpeciesMatching(strval($_GET["search"]), intval($_GET["limit"])), JSON_PRETTY_PRINT);
              }
              break;
          case 'byGendersId' :
              if (!empty($_GET["search"])
              && !empty($_GET["limit"])){
                  $arraySearch = explode("#", strval($_GET["search"]));
                  echo json_encode(Species::getSpeciesWithGenderId($arraySearch, intval($_GET["limit"])), JSON_PRETTY_PRINT);
              }
              break;
          default :
              echo json_encode(Species::getAllSpecies(), JSON_PRETTY_PRINT);
              break;
      }
  }
  
  function getGenders(string $key){
      switch ($key){
          case 'all' :
              echo json_encode(SpeciesGender::getAllGenders(), JSON_PRETTY_PRINT);
              break;
          case 'match' :
              if (!empty($_GET["search"])
              && !empty($_GET["limit"])){
                  echo json_encode(SpeciesGender::getSomeGendersMatching(strval($_GET["search"]), intval($_GET["limit"])), JSON_PRETTY_PRINT);
              }
              break;
          case 'byFamiliesId' :
              if (!empty($_GET["search"])
              && !empty($_GET["limit"])){
                  $arraySearch = explode("#", strval($_GET["search"]));
                  echo json_encode(SpeciesGender::getSomeGendersMatchingFamilies($arraySearch, intval($_GET["limit"])), JSON_PRETTY_PRINT);
              }
              break;
          default :
              echo json_encode(SpeciesGender::getAllGenders(), JSON_PRETTY_PRINT);
              break;
      }
  }
  
  function getFamilies(string $key){
      switch ($key){
          case 'all' :
              echo json_encode(SpeciesFamily::getAllFamilies(), JSON_PRETTY_PRINT);
              break;
          case 'match' :
              if (!empty($_GET["search"])
              && !empty($_GET["limit"])){
                  echo json_encode(SpeciesFaimly::getSomeFamiliesMatching(strval($_GET["search"]), intval($_GET["limit"])), JSON_PRETTY_PRINT);
              }
              break;
          case 'byOrdersId' :
              if (!empty($_GET["search"])
              && !empty($_GET["limit"])){
                  $arraySearch = explode("#", strval($_GET["search"]));
                  echo json_encode(SpeciesFamily::getSomeFamiliesMatchingOrders($arraySearch, intval($_GET["limit"])), JSON_PRETTY_PRINT);
              }
              break;
          default :
              echo json_encode(SpeciesFamily::getAllFamililes(), JSON_PRETTY_PRINT);
              break;
      }
  }
  
  function getOrders(string $key){
      switch ($key){
          case 'all' :
              echo json_encode(SpeciesOrder::getAllOrders(), JSON_PRETTY_PRINT);
              break;
          case 'match' :
              if (!empty($_GET["search"])
              && !empty($_GET["limit"])){
                  echo json_encode(SpeciesOrder::getSomeOrdersMatching(strval($_GET["search"]), intval($_GET["limit"])), JSON_PRETTY_PRINT);
              }
              break;
          case 'byClassesId' :
              if (!empty($_GET["search"])
              && !empty($_GET["limit"])){
                  $arraySearch = explode("#", strval($_GET["search"]));
                  echo json_encode(SpeciesOrder::getSomeOrdersMatchingClasses($arraySearch, intval($_GET["limit"])), JSON_PRETTY_PRINT);
              }
              break;
          default :
              echo json_encode(SpeciesOrder::getAllOrders(), JSON_PRETTY_PRINT);
              break;
      }
  }
  
  function getClasses(string $key){
      switch ($key){
          case 'all' :
              echo json_encode(SpeciesClass::getAllClasses(), JSON_PRETTY_PRINT);
              break;
          case 'match' :
              if (!empty($_GET["search"])
              && !empty($_GET["limit"])){
                  echo json_encode(SpeciesClass::getSomeClassesMatching(strval($_GET["search"]), intval($_GET["limit"])), JSON_PRETTY_PRINT);
              }
              break;
          case 'byBranchesId' :
              if (!empty($_GET["search"])
              && !empty($_GET["limit"])){
                  $arraySearch = explode("#", strval($_GET["search"]));
                  echo json_encode(SpeciesClass::getSomeClassesMatchingBranches($arraySearch, intval($_GET["limit"])), JSON_PRETTY_PRINT);
              }
              break;
          default :
              echo json_encode(SpeciesClass::getAllClasses(), JSON_PRETTY_PRINT);
              break;
      }
  }
  
  
function getBranches($key){
      switch ($key){
          case 'all' :
              echo json_encode(SpeciesBranch::getAllBranches(), JSON_PRETTY_PRINT);
              break;
          default : 
              echo json_encode(SpeciesBranch::getAllBranches(), JSON_PRETTY_PRINT);
              break;
      }
  }
  
?>