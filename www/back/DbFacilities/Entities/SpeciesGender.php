<?php
include_once 'SpeciesFamily.php';
include_once  $_SERVER['DOCUMENT_ROOT'] . "/back/DbFacilities/Dbo.php";

class SpeciesGender
{
    private $id;
    private $scientificTerms;
    private $frenchTerms;
    private $descriptive;
    private $id_speciesFamily;
    
    
    public function __construct(string $scientificTerms, string $frenchTerms, string $descriptive,
        SpeciesFamily $speciesFamily){
        
            $this->scientificTerms = $scientificTerms;
            $this->frenchTerms = $frenchTerms;    
            $this->descriptive = $descriptive;    
            $this->id_speciesFamily = $speciesFamily->getId();
            $this->id = $this->dbSave();
    }
    
    public function dbSave(){
        $db = new Dbo();
        $table = "speciesGender";
        $columns = array("scientificTerms", "descriptive", "frenchTerms", "id_speciesFamily");
        $values = array($this->scientificTerms, $this->descriptive, $this->frenchTerms, $this->id_speciesFamily);
        $this->id = $db->addToTable($table, $columns, $values);
        return $this->id;
    }
    
    public function getIdByName(string $name){
        //todo find into DB
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
    public function getFrenchTerms()
    {
        return $this->frenchTerms;
    }

    /**
     * @return string
     */
    public function getDescriptive()
    {
        return $this->descriptive;
    }

    /**
     * @return int
     */
    public function getId_specieFamily()
    {
        return $this->id_specieFamily;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setScientificTerms(string $scientificTerms)
    {
        $this->scientificTerms = $scientificTerms;
    }

    public function setFrenchTerms(string $frenchTerms)
    {
        $this->frenchTerms = $frenchTerms;
    }

    public function setDescriptive(string $descriptive)
    {
        $this->descriptive = $descriptive;
    }

    public function setId_specieFamily(int $id_specieFamily)
    {
        $this->id_specieFamily = $id_specieFamily;
    }
    
    static function getAllGenders(){
        $db = new Dbo();
        $table = "speciesGender";
        $list = array("id", "scientificTerms", "descriptive", "frenchTerms", "id_speciesFamily");
        $hays = array("scientificTerms", "frenchTerms");
        $sort = "ASC";
        $limit = 500;
        $result = $db->listSomeMatchesFromTable($list, $table, (array) "", $hays, $sort, $limit);
        return $result;
    }
    
    static function getSomeGendersMatchingFamilies(array $needles, int $limit){
        $db = new Dbo();
        $table = "speciesGender";
        $list = array("id", "scientificTerms", "descriptive", "frenchTerms", "id_speciesFamily");
        $hays = array("id_speciesFamily");
        $sort = "ASC";
        $preciseMatching = true;
        $result = $db->listSomeMatchesFromTable($list, $table, $needles, $hays, $sort, $limit, $preciseMatching);
        return $result;
    }

}

