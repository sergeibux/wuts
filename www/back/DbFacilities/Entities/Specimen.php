<?php


class Specimen
{
    private $id;
    private $scientificName;
    private $frenchName;
    private $devStage;
    private $picture;
    private $behaviorNotes;
    private $genericNote;
    private $characteristics;
    private $identKeys;
    private $id_statusIndex;
    private $id_specieGender;
    
    public function __construct(){
        echo "<h1>=>test</h1><hr>";
    }

    function newSpecimen(
        int $id,
        string $scientificName,
        string $frenchName,
        string $devStage,
        string $picture,
        string $behaviorNotes,
        string $genericNote,
        string $characteristics,
        string $identKeys,
        int $id_statusIndex,
        int $id_specieGender
        ){
            
            $this->$id = $id;
            $this->scientificName = $scientificName;
            $this->frenchName = $frenchName;
            $this->$devStage = $devStage;
            $this->$picture = $picture;
            $this->$behaviorNotes = $behaviorNotes;
            $this->$genericNote = $genericNote;
            $this->$characteristics = $characteristics;
            $this->$identKeys = $identKeys;
            $this->$id_statusIndex = $id_statusIndex;
            $this->$id_specieGender = $id_specieGender;
    }
        
//     public function __construct(
//         string $scientificName,
//         string $frenchName,
//         int $observedQuantity,
//         string $devStage,
//         string $picture,
//         string $behaviorNotes,
//         string $genericNote,
//         string $characteristics,
//         string $identKeys,
//         int $id_statusIndex,
//         int $id_specieGender
//         ){
            
//             $this->scientificName = $scientificName;
//             $this->frenchName = $frenchName;
//             $this->observedQuantity = $observedQuantity;
//             $this->stageOfDevelopment = $devStage;
//             $this->picture = $picture;
//             $this->behaviorNotes = $behaviorNotes;
//             $this->genericNote = $genericNote;
//             $this->characteristics = $characteristics;
//             $this->identificationKeys = $identKeys;
//             $this->id_statusIndex = $id_statusIndex;
//             $this->id_specieGender = $id_specieGender;
//     }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getScientificName()
    {
        return $this->scientificName;
    }
    
    public function getFrenchName()
    {
        return $this->frenchName;
    }

    public function getStageOfDevelopment()
    {
        return $this->stageOfDevelopment;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function getBehaviorNotes()
    {
        return $this->behaviorNotes;
    }

    public function getGenericNote()
    {
        return $this->genericNote;
    }

    public function getCharacteristics()
    {
        return $this->characteristics;
    }

    public function getIdentificationKeys()
    {
        return $this->identificationKeys;
    }

    public function getId_statusIndex()
    {
        return $this->id_statusIndex;
    }

    public function getId_specieGender()
    {
        return $this->id_specieGender;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
    
    public function setScientificName(string $name)
    {
        $this->scientificName = $name;
    }
    
    public function setFrenchName(string $name)
    {
        $this->frenchName = $name;
    }

    public function setStageOfDevelopment(string $devStage)
    {
        $this->stageOfDevelopment = $devStage;
    }

    public function setPicture(string $picture)
    {
        $this->picture = $picture;
    }

    public function setBehaviorNotes(string $behaviorNotes)
    {
        $this->behaviorNotes = $behaviorNotes;
    }

    public function setGenericNote(string $genericNote)
    {
        $this->genericNote = $genericNote;
    }

    public function setCharacteristics(string $characteristics)
    {
        $this->characteristics = $characteristics;
    }

    public function setIdentificationKeys(string $identKeys)
    {
        $this->identificationKeys = $identKeys;
    }

    public function setId_statusIndex(int $id_statusIndex)
    {
        $this->id_statusIndex = $id_statusIndex;
    }

    public function setId_specieGender(int $id_specieGender)
    {
        $this->id_specieGender = $id_specieGender;
    }

    
}

