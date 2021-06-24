<?php

class UserWuts
{
    private $id;
    private $password;
    private $firstName;
    private $lastName;
    private $picture;
    private $email;
    private $placeOfResidence;
    private $divingLevel;
    private $role;
    private $pseudo;
    
    public function __construct(
        int $id,
        string $password,
        string $firstName,
        string $lastName,
        string $picture,
        string $email,
        string $placeOfResidence,
        string $divingLevel,
        string $role,
        string $pseudo
        ){
            
            $this->$id = $id;
            $this->$password = $password;
            $this->$firstName = $firstName;
            $this->$lastName = $lastName;
            $this->$picture = $picture;
            $this->$email = $email;
            $this->$placeOfResidence = $placeOfResidence;
            $this->$divingLevel = $divingLevel;
            $this->$role = $role;
            $this->$pseudo = $pseudo;
    }
    public function __construct(
        string $password,
        string $firstName,
        string $lastName,
        string $picture,
        string $email,
        string $placeOfResidence,
        string $divingLevel,
        string $role,
        string $pseudo
        ){
            
            $this->$password = $password;
            $this->$firstName = $firstName;
            $this->$lastName = $lastName;
            $this->$picture = $picture;
            $this->$email = $email;
            $this->$placeOfResidence = $placeOfResidence;
            $this->$divingLevel = $divingLevel;
            $this->$role = $role;
            $this->$pseudo = $pseudo;
    }
    public function getId()
    {
        return $this->id;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPlaceOfResidence()
    {
        return $this->placeOfResidence;
    }

    public function getDivingLevel()
    {
        return $this->divingLevel;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    public function setPicture(string $picture)
    {
        $this->picture = $picture;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setPlaceOfResidence(string $placeOfResidence)
    {
        $this->placeOfResidence = $placeOfResidence;
    }

    public function setDivingLevel(string $divingLevel)
    {
        $this->divingLevel = $divingLevel;
    }

    public function setRole(string $role)
    {
        $this->role = $role;
    }

    public function setPseudo(string $pseudo)
    {
        $this->pseudo = $pseudo;
    }

}

