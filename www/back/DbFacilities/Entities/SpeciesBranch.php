<?php
include_once  $_SERVER['DOCUMENT_ROOT'] . "/back/DbFacilities/Dbo.php";

class SpeciesBranch
{
    private $id;
    private $scientificTerms;
    private $frenchTerms;
    private $descriptive;
    
    public function __construct(string $scientificTerms, string $frenchTerms, string $descriptive){
        $this->scientificTerms = $scientificTerms;
        $this->frenchTerms = $frenchTerms;
        $this->descriptive = $descriptive;
        $this->id = $this->dbSave();
    }
    
    public function dbSave(){
        $db = new Dbo();
        $table = "speciesBranch";
        $columns = array("id", "scientificTerms", "frenchTerms", "descriptive");
        $values = array($this->scientificTerms, $this->frenchTerms, $this->descriptive);
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

    public function setId_specieBranchPrimaire(int $id_specieBranchPrimaire)
    {
        $this->id_specieBranchPrimaire = $id_specieBranchPrimaire;
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
    
    static function getAllBranches(){
        $db = new Dbo();
        $table = "speciesBranch";
        $list = array("id", "scientificTerms", "frenchTerms", "descriptive");
        $result = $db->listAllFromTable($list, $table);
        return $result;
    }

}

