<?php

include_once 'Logger.php';
include_once 'Entities/Specimen.php';
set_time_limit(8640000);

class DbSucker{
    const FISHBASE = "Fishbase";
    const MNHN = "Mnhm";
    
    function DbSucker(){
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
                $distSpecies = $jsonTab[$j]["Species"];
                $id = $j + $i;
                $species[$id] = new Specimen();
                echo "espèce #" . ($id) . " : " . $species . "<br>";
                $j++;
            }
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
        for ($i = 0; $i <= $totalAmount; ){
            var_dump($distSpecies);
            $jsonTab = $this->getSpeciesByIdRange($dataSrc, $i, LIMIT);
            echo "<hr><h4>species from $i to " . (($i + LIMIT) - 1) . "</h4>";
            $tabSize = sizeof($jsonTab);
            for ($j=0; $j<$tabSize; ){
                $distSpecies = $jsonTab[$j];
                $id = $j + $i;
                echo "Id = $id<br>";
                echo "espèce #$id : " . $distSpecies["scientificName"] . " : " . $distSpecies["frenchVernacularName"] . "<br>";
                $species[$id] = new Specimen();
                $species[$id]->newSpecimen(
                    $id,
                    $distSpecies["scientificName"],
                    $distSpecies["frenchVernacularName"],
                    "null",
                    "null",
                    "null",
                    "null",
                    "null",
                    "null",
                    0,
                    0
                    );
                    loggerLog('new specimen created : ' . $species[$id]->getScientificName(), 'mnhn_suscker()', 'dboLog.txt', true, false);
                    //TODO save into DB
                $j++;
                echo "j = $j<hr>";
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
        echo "JSON : <br>" . $jsonTab;
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
            $result = curl($url, $cookie = false, $post = false, $header = false, $follow_location = false, $referer=false, $proxy=false);
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