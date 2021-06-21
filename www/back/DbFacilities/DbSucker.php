<?php
ini_set('display_errors', 1);
include_once '../Logger.php';
include_once '../DbFacilities/Entities/Species.php';
include_once '../DbFacilities/Entities/SpeciesGender.php';
include_once '../DbFacilities/Entities/SpeciesFamily.php';
include_once '../DbFacilities/Entities/SpeciesOrder.php';
include_once '../DbFacilities/Entities/SpeciesClass.php';
include_once '../DbFacilities/Entities/SpeciesBranch.php';
// set_time_limit(8640000); TODO

class DbSucker{
    const FISHBASE = "Fishbase";
    const MNHN = "Mnhm";
    
    function __construct(){
        loggerLog('calling DbSucker ... 0', 'DbSucker()', 'dboLog.txt', true, false);
//         $this->fishbase_sucker();
        $this->mnhn_sucker();
        loggerLog('calling DbSucker ... 0000', 'DbSucker()', 'dboLog.txt', true, false);
        
    }
    
    /*
     * this link returns 10 first elements and a 'count' element :
     * https://fishbase.ropensci.org/taxa/
     * then, we'll can use 
     * https://fishbase.ropensci.org/taxa?limit=5000&offset=0
     *  where limit is number of records to return
     *  and offset the first record to return
     * 
     * one el looks like this
     * {
     "      "SpecCode": 3379,
     "      "Genus": "Lepomis",             // Genus is gender 
     "      "Species": "punctatus",
     "      "SpeciesRefNo": 5723,
     "      "Author": "(Valenciennes, 1831)",
     "      "FBname": "Spotted sunfish",
     "      "SubFamily": null,
     "      "FamCode": 302,
     "      "Remark": null,
     "      "Family": "Centrarchidae",
     "      "Order": "Perciformes",
     "      "Class": "Actinopterygii",
     "      "GenCode": 4789,
     "      "SubGenCode": null
     "  }
     * 
     */
    function fishbase_sucker(){
        define("LIMIT", 4000);
        loggerLog('calling DbSucker ... 1', 'fishbase_suscker()', 'dboLog.txt', true, false);
        $dataSrc = DbSucker::FISHBASE;
        loggerLog('calling DbSucker ... 2', 'fishbase_suscker()', 'dboLog.txt', true, false);
        $totalAmount = $this->getSpeciesCount($dataSrc);
        loggerLog('calling DbSucker ... 3', 'fishbase_suscker()', 'dboLog.txt', true, false);
        echo "<h3>
                We found $totalAmount species
            </h3>";
        for ($i = 0; $i <= $totalAmount; ){
            $jsonTab = $this->getSpeciesByIdRange($dataSrc, $i, LIMIT);
            echo "<hr><h4>species from $i to " . (($i + LIMIT) - 1) . "</h4>";
            $tabSize = sizeof($jsonTab);
            for ($j=0; $j<$tabSize; ){
                echo "espèce #débutfin<br>";
                $distSpecies = $jsonTab[$j]["Species"];
                $id = $j + $i;
                $species[$id] = new Species();
                echo "espèce #" . ($id) . " : " . $species . "<br>";
                $j++;
                echo "espèce #fin<br>";
            }
            echo "espèce #after<br>";
            $i += LIMIT;
        }
    }
    
    function mnhn_sucker(){
        define("LIMIT", 4000);
        loggerLog('limit defined ... 1', 'mnhn_suscker()', 'dboLog.txt', true, false);
        $dataSrc = DbSucker::MNHN;
        loggerLog('dataSrc set ... 2', 'mnhn_suscker()', 'dboLog.txt', true, false);
        $totalAmount = $this->getSpeciesCount($dataSrc);
        loggerLog('speciesCount = ' . $totalAmount . ' ... 3', 'mnhn_suscker()', 'dboLog.txt', true, false);
        echo "<h3>
                We found $totalAmount species
            </h3>";
        if ($totalAmount <= 0){
            return;
        }
        for ($i = 0; $i < $totalAmount; ){
            $jsonTab = $this->getSpeciesByIdRange($dataSrc, $i, LIMIT);
            echo "<hr><h4>species from $i to " . (($i + LIMIT) - 1) . "</h4>";
            $tabSize = sizeof($jsonTab);
            for ($j=0; $j<$tabSize; $j++){
                $distSpecies = $jsonTab[$j];
                echo "<br>Create new branch ??<br>";
                
                $phylumName = $distSpecies["phylumName"] != null ? $distSpecies["phylumName"] : "";
                $vernacularGroup1 = $distSpecies["vernacularGroup1"] != null ? $distSpecies["vernacularGroup1"] : "";
                $branch = new SpeciesBranch($phylumName, $vernacularGroup1, "");
                
                $className = $distSpecies["className"] != null ? $distSpecies["className"] : "";
                $vernacularClassName = $distSpecies["vernacularClassName"] != null ? $distSpecies["vernacularClassName"] : "";
                $class = new SpeciesClass($className, $vernacularClassName, "", $branch);
                
                $orderName = $distSpecies["orderName"] != null ? $distSpecies["orderName"] : "";
                $order = new SpeciesOrder($orderName, "", "", $class);
                
                $familyName = $distSpecies["familyName"] != null ? $distSpecies["familyName"] : "";
                $family = new SpeciesFamily($familyName, "", "", $order);
                
                $genusName = $distSpecies["genusName"] != null ? $distSpecies["genusName"] : "";
                $gender = new SpeciesGender($genusName, "", "", $family);
                
                $scientificName =  $distSpecies["scientificName"] != null ? $distSpecies["scientificName"] : "";
                $frenchVernacularName =  $distSpecies["frenchVernacularName"] != null ? $distSpecies["frenchVernacularName"] : "";
                $englishVernacularName =  $distSpecies["englishVernacularName"] != null ? $distSpecies["englishVernacularName"] : "";
                $species = new Species(
                    $scientificName,
                    $frenchVernacularName,
                    $englishVernacularName,
                    "defaultPict.png",
                    "",
                    $gender
                    );
                echo "j = $j<br>Specie #$species->getId() recorded into db.<hr><br>";
            }
            $i += LIMIT;
            echo "i = $i";
        }
    }
    
    function getSpeciesByIdRange(string $source, int $from, int $limit){
        loggerLog('calling DbSucker ... 5', 'getSpeciesByIdRange()', 'dboLog.txt', true, false);
        $jsonTab;
        if ($source == DbSucker::FISHBASE){
            loggerLog('calling DbSucker ... 6', 'getSpeciesByIdRange()', 'dboLog.txt', true, false);
            $url = "https://fishbase.ropensci.org/taxa?limit=" . $limit . "&offset=" . $from;
//             $curl = curl_init();
//             curl_setopt($curl, CURLOPT_GET, 1);
//             curl_setopt($curl, CURLOPT_URL, $uri);
//             curl_setopt($curl, CURLOPT_HTTPHEADER, array(
//                 'Content-Type: application/json',
//             ));
//             curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//             $result = curl_exec($curl);
//             curl_close($curl);
            $result = curl($url, $cookie = false, $post = false, $header = false, $follow_location = false, $referer=false, $proxy=false);
            if (!$result) {
                loggerLog('No data found.', 'getSpeciesByIdRange(' . $source . ')', 'dboLog.txt', true, false);
                return 0;
            }
            loggerLog('calling DbSucker ... 7', 'getSpeciesByIdRange()', 'dboLog.txt', true, false);
            $apiResult_decoded = json_decode($result, true);
            $jsonTab = $apiResult_decoded["data"];
        } elseif ($source == DbSucker::MNHN){
            //TODO test
            loggerLog('calling DbSucker ... 6', 'getSpeciesByIdRange()', 'dboLog.txt', true, false);
            $page=(floor($from/$limit)) + 1;
            loggerLog('Get page ' . $page, 'getSpeciesByIdRange(' . $source . ')', 'dboLog.txt', true, false);
            $url = "https://taxref.mnhn.fr/api/taxa/search?domain=marin&page=$page&size=$limit";
            $result = curl($url, $cookie = false, $post = false, $header = false, $follow_location = false, $referer=false, $proxy=false);
            if (!$result) {
                echo "Result : " . var_dump($result);
                loggerLog('No data found.', 'getSpeciesByIdRange(' . $source . ')', 'dboLog.txt', true, false);
                return 0;
            }
            loggerLog('calling DbSucker ... 7', 'getSpeciesByIdRange()', 'dboLog.txt', true, false);
            $apiResult_decoded = json_decode($result, true);
            $jsonTab = $apiResult_decoded["_embedded"]["taxa"];
        }
        loggerLog('calling DbSucker ... 8', 'getSpeciesByIdRange()', 'dboLog.txt', true, false);
        return $jsonTab;
    }
    
    function getSpeciesCount(string $source, int $limit=1){
        loggerLog('calling DbSucker ... 9', 'getSpeciesCount()', 'dboLog.txt', true, false);
        $total;
        if ($source == DbSucker::FISHBASE){
            loggerLog('calling DbSucker ... 10', 'getSpeciesCount()', 'dboLog.txt', true, false);
            $url = "https://fishbase.ropensci.org/taxa/";
//             $curl = curl_init();
//             curl_setopt($curl, CURLOPT_GET, 1);
//             curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla HotFox 1.0');
//             curl_setopt($curl, CURLOPT_URL, $uri);
//             curl_setopt($curl, CURLOPT_HTTPHEADER, array(
//                 'Content-Type: application/json',
//             ));
//             curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//             $result = curl_exec($curl);
//             curl_close($curl);
            $result = curl($url, $cookie = false, $post = false, $header = false, $follow_location = false, $referer=false, $proxy=false);
            if (!$result) {
                loggerLog('No data found (uri = ' . $uri . ').', 'getSpeciesCount(' . $source . ')', 'dboLog.txt', true, true);
                return 0;
            }
            loggerLog('calling DbSucker ... 11', 'getSpeciesCount()', 'dboLog.txt', true, false);
            $apiResult_decoded = json_decode($result, true);
            $total = $apiResult_decoded["count"];
        } elseif ($source == DbSucker::MNHN){
            //TODO test
            loggerLog('calling DbSucker ... 12', 'getSpeciesCount()', 'dboLog.txt', true, false);
            $url = "https://taxref.mnhn.fr/api/taxa/search?domain=marin&page=1&size=$limit";
            loggerLog('Calling DbSucker ... 12.1 :.: url = ' . $url, 'getSpeciesCount()', 'dboLog.txt', true, false);
            $result = curl($url, $cookie = false, $post = false, $header = false, $follow_location = false, $referer=false, $proxy=false);
            loggerLog('calling DbSucker ... 12.2 :: result = ...', 'getSpeciesCount()', 'dboLog.txt', true, false);
            loggerLog('calling DbSucker ... 12.2 :: result = ' . json_decode($result, true), 'getSpeciesCount()', 'dboLog.txt', true, false);
            if (!$result) {
//                 echo 'result :__: ' . var_dump($result);
                loggerLog('No data found (uri = ' . $uri . ') : curl ' . var_dump($curl) . '.', 'getSpeciesCount(' . $source . ')', 'dboLog.txt', true, true);
                return 0;
            }
            loggerLog('calling DbSucker ... 13', 'getSpeciesCount()', 'dboLog.txt', true, false);
            
            $apiResult_decoded = json_decode($result, true);
            $total = $apiResult_decoded["page"]["totalElements"];
        }
        loggerLog('calling DbSucker ... 14', 'getSpeciesCount()', 'dboLog.txt', true, false);
        return $total;
    }

}

function curl($url, $cookie = false, $post = false, $header = false, $follow_location = false, $referer=false,$proxy=false){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_REFERER, $referer);
    curl_setopt($ch, CURLOPT_HEADER, $header);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
    ));
    curl_setopt($ch, CURLOPT_PROXY, $proxy);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $follow_location);
    if ($cookie) {
        curl_setopt ($ch, CURLOPT_COOKIE, $cookie);
    }
    if ($post) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    $response = curl_exec ($ch);
    curl_close($ch);
    return $response;
}

?>