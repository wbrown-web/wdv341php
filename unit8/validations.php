<?php

function validateName( $inName ) {
	//cannot be empty
	
	if( empty($inName) ) {
		return false;	//Failed validation
	}
	else {
		return true;	//Passes validation	
	}	
}//end validateName()

function validateSoc( $inSoc) {
	//cannot be empty
	//must be numeric
	//must be greater than zero
	
	if( empty($inSoc) ) {
		return false;	//Failed validation
	}
	else {
		if( is_numeric($inSoc) && ($inSoc > 0) ){
			return true;		//Passes validation	
		}
		else {
			return false;	
		}
	}		
}//end validateSoc

function validateResp( $inResp ) {
	//Must select a color
	if( $inResp === "") {
		return false;
	}
	else {
		return true;
	}
	
}//end validateResp()

