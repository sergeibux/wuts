<?php
include_once 'SpeciesOrder.php';
include_once  $_SERVER['DOCUMENT_ROOT'] . "/back/DbFacilities/Dbo.php";

class speciesFamily
{
    private $id;
    private $scientificTerms;
    private $descriptive;
    private $frenchTerms;
    private $id_specieOrder;
    
    
    public function __construct(string $scientificTerms, string $descriptive, string $frenchTerms,
        SpeciesOrder $speciesOrder){
        $this->scientificTerms = $scientificTerms;
        $this->descriptive = $descriptive;
        $this->frenchTerms = $frenchTerms;
        $this->id_specieOrder = $speciesOrder->getId();
        $this->id = $this->dbSave();
    }
    
    public function dbSave(){
        $db = new Dbo();
        $table = "speciesFamily";
        $columns = array("scientificTerms", "descriptive", "frenchTerms", "id_speciesOrder");
        $values = array($this->scientificTerms, $this->descriptive, $this->frenchTerms, $this->id_specieOrder);
        $this->id = $db->addToTable($table, $columns, $values);
        return $this->id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getScientificTerms()
    {
        return $this->scientificTerms;
    }

    /**
     * @return string
     */
    public function getDescriptive()
    {
        return $this->descriptive;
    }

    /**
     * @return string
     */
    public function getFrenchTerms()
    {
        return $this->frenchTerms;
    }

    /**
     * @return int
     */
    public function getId_specieOrder()
    {
        return $this->id_specieOrder;
    }

    public function setId_specieFamily(int $id_specieFamily)
    {
        $this->id = $id_specieFamily;
    }

    public function setScientificTerms(string $scientificTerms)
    {
        $this->scientificTerms = $scientificTerms;
    }

    public function setDescriptive(string $descriptive)
    {
        $this->descriptive = $descriptive;
    }

    public function setFrenchTerms(string $frenchTerms)
    {
        $this->frenchTerms = $frenchTerms;
    }

    public function setId_specieOrder(int $id_specieOrder)
    {
        $this->id_specieOrder = $id_specieOrder;
    }
    
    static function getAllFamilies(){
        $db = new Dbo();
        $table = "speciesFamily";
        $list = array("id", "scientificTerms", "descriptive", "frenchTerms", "id_speciesOrder");
        $hays = array("scientificTerms", "frenchTerms");
        $sort = "ASC";
        $limit = 500;
        $result = $db->listSomeMatchesFromTable($list, $table, (array) "", $hays, $sort, $limit);
        return $result;
    }
    
    static function getSomeFamiliesMatchingOrders(array $needles, int $limit){
        $db = new Dbo();
        $table = "speciesFamily";
        $list = array("id", "scientificTerms", "descriptive", "frenchTerms", "id_speciesOrder");
        $hays = array("id_speciesOrder");
        $sort = "ASC";
        $preciseMatching = true;
        $result = $db->listSomeMatchesFromTable($list, $table, $needles, $hays, $sort, $limit, $preciseMatching);
        return $result;
    }
    
}

