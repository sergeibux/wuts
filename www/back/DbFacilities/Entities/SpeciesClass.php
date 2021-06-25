<?php
include_once 'SpeciesBranch.php';
include_once  $_SERVER['DOCUMENT_ROOT'] . "/back/DbFacilities/Dbo.php";

class SpeciesClass
{
    private $id;
    private $scientificTerms;
    private $descriptive;
    private $frenchTerms;
    private $id_specieBranch;
    
    
    /**
     * use this functiononly if you do not know ID
     */
    public function __construct(string $scientificTerms, string $descriptive, string $frenchTerms,
        SpeciesBranch $speciesBranch){
        
            $this->scientificTerms = $scientificTerms;
            $this->descriptive = $descriptive;
            $this->frenchTerms = $frenchTerms;
            $this->id_specieBranch = $speciesBranch->getId();
            $this->id = $this->dbSave();
    }
    
    public function dbSave(){
        $db = new Dbo();
        $table = "speciesClass";
        $columns = array("scientificTerms", "descriptive", "frenchTerms", "id_speciesBranch");
        $values = array($this->scientificTerms, $this->descriptive, $this->frenchTerms, $this->id_specieBranch);
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
    public function getId_specieBranch()
    {
        return $this->id_specieBranch;
    }

    public function setId_specieClassPrimaire(int $id_specieClassPrimaire)
    {
        $this->id_specieClassPrimaire = $id_specieClassPrimaire;
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

    public function setId_specieBranch(int $id_specieBranch)
    {
        $this->id_specieBranch = $id_specieBranch;
    }
    
    static function getAllClasses(){
        $db = new Dbo();
        $table = "speciesClass";
        $list = array("id", "scientificTerms", "descriptive", "frenchTerms", "id_speciesBranch");
        $hays = array("scientificTerms", "frenchTerms");
        $sort = "ASC";
        $limit = 500;
        $result = $db->listSomeMatchesFromTable($list, $table, (array) "", $hays, $sort, $limit);
        return $result;
    }
    
    static function getSomeClassesMatchingBranches(array $needles, int $limit){
        $db = new Dbo();
        $table = "speciesClass";
        $list = array("id", "scientificTerms", "frenchTerms", "id_speciesBranch");
        $hays = array("id_speciesBranch");
        $sort = "ASC";
        $preciseMatching = true;
        $result = $db->listSomeMatchesFromTable($list, $table, $needles, $hays, $sort, $limit, $preciseMatching);
        return $result;
    }
    
}

