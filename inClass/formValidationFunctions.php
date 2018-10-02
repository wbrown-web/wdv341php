<?php 

function validateProdName($inName) {
    //cannot be empty
    if ( empty($inName) ) {
        return false; //Failed Validation

    }
    else {
        return true; //Passes Validation
    }
}

?>