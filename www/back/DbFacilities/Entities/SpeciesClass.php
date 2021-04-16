<?php

class SpeciesClass
{
    private $id_specieClassPrimaire;
    private $scientificTerms;
    private $descriptive;
    private $frenchTerms;
    private $id_specieBranch;
    
    public function __construct(int $id, string $scientificTerms, string $descriptive, string $frenchTerms, int $id_specieBranch){
        $this->$id_specieClassPrimaire = $id;
        $this->$scientificTerms = $scientificTerms;
        $this->$descriptive = $descriptive;
        $this->$frenchTerms = $frenchTerms;
        $this->$id_specieBranch = $id_specieBranch;
    }
    
    /**
     * use this functiononly if you do not know ID
     */
    public function __construct(string $scientificTerms, string $descriptive, string $frenchTerms, int $id_specieBranch){
        $this->$scientificTerms = $scientificTerms;
        $this->$descriptive = $descriptive;
        $this->$frenchTerms = $frenchTerms;
        $this->$id_specieBranch = $id_specieBranch;
    }
    
    /**
     * @return int
     */
    public function getId_specieClassPrimaire()
    {
        return $this->id_specieClassPrimaire;
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
    
}

