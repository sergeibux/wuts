<?php

class SpeciesBranch
{
    private $id_specieBranchPrimaire;
    private $scientificTerms;
    private $frenchTerms;
    private $descriptive;
    
    public function __construct(int $id, string $scientificTerms, string $frenchTerms, string $descriptive){
        $this->$id_specieBranchPrimaire = $id;
        $this->$scientificTerms = $scientificTerms;
        $this->$frenchTerms = $frenchTerms;
        $this->$descriptive = $descriptive;
    }
    
    /**
     * use this functiononly if you do not know ID
     */
    public function __construct(string $scientificTerms, string $frenchTerms, string $descriptive){
        $this->$scientificTerms = $scientificTerms;
        $this->$frenchTerms = $frenchTerms;
        $this->$descriptive = $descriptive;
    }
    
    /**
     * @return int
     */
    public function getId_specieBranchPrimaire()
    {
        return $this->id_specieBranchPrimaire;
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

}

