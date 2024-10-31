<?php
//This is a class file for the wdv341_events table
//Documentation
//Author:Amy Miles
//Date: 10/24/2024

class Event {
    //Properties
    //Constructor method sets the default values of the properties in the new object
    //Methods
    //Setters/Getters or Accessors/Mutators
    //processing methods
    public $eventsID;
    public $eventsName;
    public $eventsDescription;
    public $eventsPresenter;


    //Default Values Constructor
    function __construct(){
        $this->eventsID = null;
        $this->eventsName = "";
        $this->eventsDescription = "";
        $this->eventsPresenter = "";
    }

    // Getters and Setters
    function setID($inID){
        $this->eventsID = $inID;
    }
    function getID(){
        return $this->eventsID;
    }

    function setName($inName){
        $this->eventsName = $inName;
    }
    function getName(){
        return $this->eventsName;
    }

    function setDescription($inDesc){
        $this->eventsDescription = $inDesc;
    }
    function getDescription(){
        return $this->eventsDescription;
    }

    function setPresenter($inPresenter){
        $this->eventsPresenter = $inPresenter;
    }
    function getPresenter(){
        return $this->eventsPresenter;
    }
    //End Getters and Setters



}






















?>