<?php
// src/Model/MowerInterface.php
namespace App\Model;

/**
 * An interface that the invoice Subject object should implement.
 * In most circumstances, only a single object should implement
 * this interface as the ResolveTargetEntityListener can only
 * change the target to a single object.
 */

interface MowerInterface
{
    // List any additional methods that your Mower
    // will need to access on the subject so that you can
    // be sure that you have access to those methods.

    // set the cardinal direction
    public function setDirection($d);
    // set the X Axis of the mower
    public function setXAxis($x);
    //set the y Axix of the mower
    public function setYAxis($y);
    //set the lawn 
    public function setLawn($lawn);
    // get the cardinal direction of the mower
    public function getDirection();
    //get the X Axis
    public function getXAxis();
    // get Y Axis of the mower
    public function getYAxis();
    // get the lawn 
    public function getLawn();
    // get cardinate (N,E,S,O)
    public function getCardinate();
    // move the mower 
    public function move($d);
    // rotate the mower in the new left direction
    public function rotateLeft();
    // rotate the mower in the new right direction
    public function rotateRight();
    // move the mower forward
    public function moveForward ();

    }