<?php

include_once 'Logger.php';
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
        loggerLog('calling DbSucker ... 1', 'mnhn_suscker()', 'dboLog.txt', true, false);
        $dataSrc = DbSucker::MNHN;
        loggerLog('calling DbSucker ... 2', 'mnhn_suscker()', 'dboLog.txt', true, false);
        $totalAmount = $this->getSpeciesCount($dataSrc, LIMIT);
        loggerLog('calling DbSucker ... 3', 'mnhn_suscker()', 'dboLog.txt', true, false);
        echo "<h3>
                We found $totalAmount species
            </h3>";
        $totalAmount = 5;
        for ($i = 0; $i <= $totalAmount; ){
            $jsonTab = $this->getSpeciesByIdRange($dataSrc, $i, LIMIT);
            echo "<hr><h4>species from $i to " . (($i + LIMIT) - 1) . "</h4>";
            $tabSize = sizeof($jsonTab);
            for ($j=0; $j<$tabSize; ){
                $distSpecies = $jsonTab[$j];
                $id = $j + $i;
//                 $species[$id] = new Specimen(); //TODO do not works
                echo "espèce #$id<br>";
                 echo "espèce #$id : " . $distSpecies["vernacularFamilyName"] . " : " . $distSpecies["fullName"] . "<br>";
                $j++;
            }
return;
            $i += LIMIT;
         }
    }
    
    function getSpeciesByIdRange(string $source, int $from, int $limit){
        loggerLog('calling DbSucker ... 5', 'getSpeciesByIdRange()', 'dboLog.txt', true, false);
        $jsonTab;
        if ($source == DbSucker::FISHBASE){
            loggerLog('calling DbSucker ... 6', 'getSpeciesByIdRange()', 'dboLog.txt', true, false);
            $uri = "https://fishbase.ropensci.org/taxa?limit=" . $limit . "&offset=" . $from;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_GET, 1);
            curl_setopt($curl, CURLOPT_URL, $uri);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
            ));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($curl);
            curl_close($curl);
            if (!$result) {
                loggerLog('No data found.', 'getSpeciesByIdRange(' . $source . ')', 'dboLog.txt', true, true);
                return 0;
            }
            loggerLog('calling DbSucker ... 7', 'getSpeciesByIdRange()', 'dboLog.txt', true, false);
            $apiResult_decoded = json_decode($result, true);
            $jsonTab = $apiResult_decoded["data"];
        } elseif ($source == DbSucker::MNHN){
            //TODO test
            loggerLog('calling DbSucker ... 6', 'getSpeciesByIdRange()', 'dboLog.txt', true, false);
            $page=($from/$limit) + 1;
            $uri = "https://taxref.mnhn.fr/api/taxa/search?domain=marin&page=$page&size=$limit";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_GET, 1);
            curl_setopt($curl, CURLOPT_URL, $uri);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
            ));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($curl);
            curl_close($curl);
            if (!$result) {
                loggerLog('No data found.', 'getSpeciesByIdRange(' . $source . ')', 'dboLog.txt', true, true);
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
    
    function getSpeciesCount(string $source, int $limit=5000){
        loggerLog('calling DbSucker ... 5', 'getSpeciesCount()', 'dboLog.txt', true, false);
        $total;
        if ($source == DbSucker::FISHBASE){
            loggerLog('calling DbSucker ... 6', 'getSpeciesCount()', 'dboLog.txt', true, false);
            $uri = "https://fishbase.ropensci.org/taxa/";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_GET, 1);
            curl_setopt($curl, CURLOPT_URL, $uri);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
            ));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($curl);
            curl_close($curl);
            if (!$result) {
                loggerLog('No data found.', 'getSpeciesCount(' . $source . ')', 'dboLog.txt', true, true);
                return 0;
            }
            loggerLog('calling DbSucker ... 7', 'getSpeciesCount()', 'dboLog.txt', true, false);
            $apiResult_decoded = json_decode($result, true);
            $total = $apiResult_decoded["count"];
        } elseif ($source == DbSucker::MNHN){
            //TODO test
            loggerLog('calling DbSucker ... 6', 'getSpeciesCount()', 'dboLog.txt', true, false);
            $uri = "https://taxref.mnhn.fr/api/taxa/search?domain=marin&page=1&size=$limit";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_GET, 1);
            curl_setopt($curl, CURLOPT_URL, $uri);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
            ));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($curl);
            curl_close($curl);
            if (!$result) {
                loggerLog('No data found.', 'getSpeciesCount(' . $source . ')', 'dboLog.txt', true, true);
                return 0;
            }
            loggerLog('calling DbSucker ... 7', 'getSpeciesCount()', 'dboLog.txt', true, false);
            $apiResult_decoded = json_decode($result, true);
            $total = $apiResult_decoded["page"]["totalElements"];
        }
        loggerLog('calling DbSucker ... 8', 'getSpeciesCount()', 'dboLog.txt', true, false);
        return $total;
    }
}
?>