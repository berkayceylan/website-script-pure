<?php

    class BcFollow extends BcDb{
    
    function verifyEmail(){
    
    
    
    }
    
    
    
    function followWebsite($email, $aCode){
    
      $query = $GLOBALS["db"] -> prepare("INSERT INTO bc_emails (email, date, a_state, n_categ, a_code) VALUES(?,?,?,?, ?)");
    
      $query -> execute(array($email, "-1", "0", "-1", $aCode));
    
    }
    
    function activateEmail($email){
    
      $query = $GLOBALS["db"] -> prepare("UPDATE bc_emails SET a_state = ? WHERE email = ?");
    
      $query -> execute(array(1, $email));
    
    }
    
    }
?>