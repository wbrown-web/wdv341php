<?php
class Emailer {  //class name and file name have to be exactly the same.

//property declaration for the class
  private $messageLine = "";
  private $senderAddress = ""; //Variables must have a scope (public "global", private "local", protected)
  private $sendToAddress = ""; //Most of the time you will want to use private variables inside a class.
  private $subjectLine = "";      //Always give the variables a default value


//define methods of the class

//constructor method

public function __construct() {

}


//set methods (called when you want to pass a value into the object and store it in a property)

public function setMessageLine($inMessageLine) { //set methods must be public followed by the word "set" then the name of the property

  $this->messageLine = $inMessageLine;  //'$this->' shortcut reference to current class/object
}

public function setSenderAddress($inSenderAddress) {

  $this->senderAddress = $inSenderAddress;
}

public function setSendToAddress($inSendToAddress){

  $this->sendToAddress = $inSendToAddress;
}

public function setSubjectLine($inSubjectLine) {

  $this->subjectLine = $inSubjectLine;
}

//get methods
public function getMessageLine() {

    return $this->messageLine;
}

public function getSenderAddress() {

    return  $this->senderAddress;
}

public function getSendToAddress(){

    return $this->sendToAddress;
}

public function getSubjectLine() {

    return $this->subjectLine;
}

//processing methods

public function sendPHPEmail() {
  
}

}
?>
