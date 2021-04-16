<?php

class Specimen
{
    private $id;
    private $scientificName;
    private $frenchName;
    private $observedQuantity;
    private $stageOfDevelopment;
    private $picture;
    private $behaviorNotes;
    private $genericNote;
    private $characteristics;
    private $identificationKeys;
    private $id_statusIndex;
    private $id_specieGender;
    
    public function __construct(){
        
    }
        
    public function __construct(
        int $id,
        string $scientificName,
        string $frenchName,
        int $observedQuantity,
        string $stageOfDevelopment,
        string $picture,
        string $behaviorNotes,
        string $genericNote,
        string $characteristics,
        string $identificationKeys,
        string $id_statusIndex,
        string $id_specieGender
        ){
            
            $this->$id = $id;
            $this->scientificName = $scientificName;
            $this->frenchName = $frenchName;
            $this->$observedQuantity = $observedQuantity;
            $this->$stageOfDevelopment = $stageOfDevelopment;
            $this->$picture = $picture;
            $this->$behaviorNotes = $behaviorNotes;
            $this->$genericNote = $genericNote;
            $this->$characteristics = $characteristics;
            $this->$identificationKeys = $identificationKeys;
            $this->$id_statusIndex = $id_statusIndex;
            $this->$id_specieGender = $id_specieGender;
    }
    
    public function __construct(
        string $scientificName,
        string $frenchName,
        int $observedQuantity,
        string $stageOfDevelopment,
        string $picture,
        string $behaviorNotes,
        string $genericNote,
        string $characteristics,
        string $identificationKeys,
        string $id_statusIndex,
        string $id_specieGender
        ){
            
            $this->scientificName = $scientificName;
            $this->frenchName = $frenchName;
            $this->$observedQuantity = $observedQuantity;
            $this->$stageOfDevelopment = $stageOfDevelopment;
            $this->$picture = $picture;
            $this->$behaviorNotes = $behaviorNotes;
            $this->$genericNote = $genericNote;
            $this->$characteristics = $characteristics;
            $this->$identificationKeys = $identificationKeys;
            $this->$id_statusIndex = $id_statusIndex;
            $this->$id_specieGender = $id_specieGender;
    }
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

    public function getObservedQuantity()
    {
        return $this->observedQuantity;
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

    public function setObservedQuantity(int $observedQuantity)
    {
        $this->observedQuantity = $observedQuantity;
    }

    public function setStageOfDevelopment(string $stageOfDevelopment)
    {
        $this->stageOfDevelopment = $stageOfDevelopment;
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

    public function setIdentificationKeys(string $identificationKeys)
    {
        $this->identificationKeys = $identificationKeys;
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

