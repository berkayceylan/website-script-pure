<?php 
    class BcMessage extends BcDb{

        private $countMessage;
      
        private $countMessage2;
      
        public $currentMessage = 0;
      
        function __construct(){
      
          $this -> countMessage = count($this -> fetchId("bc_messages"));
      
          $this -> countMessage2 = count($this -> fetchId("bc_messages"));
      
        }
      
        function haveMessages($rewind = 0){
      
          if($rewind == 1){
      
            $this -> currentMessage = $this -> countMessage + 1;
      
      
      
            if($this -> currentMessage > 0 ){
      
      
      
      
      
              $this -> currentMessage -= 1;
      
              $this -> countMessage -= 1;
      
              return true;
      
            }
      
            $this -> countMessage = count($this -> fetchId("bc_messages"));
      
            return false;
      
          }
      
          if($this -> currentMessage < $this -> countMessage){
      
            $this -> currentMessage++;
      
      
      
            return true;
      
          }
      
          return false;
      
        }
      
      
      
        function returnMessage($column){
      
          $fetch = $this -> fetchColumn("bc_messages", $column, "id", $this -> currentMessage);
      
          return $fetch[$column];
      
        }
      
        function insertMessage($messageTitle, $messageContent, $receiverIds, $senderId, $sendDate, $activeState, $mId = ""){
      
          $query = $GLOBALS["db"] ->
      
            prepare("INSERT INTO bc_messages(m_title, m_content, r_ids, s_id, s_date, a_state, m_id, s_read) VALUES (?,?,?,?,?,?,?,?)");
      
          $query -> execute(array(htmlspecialchars($messageTitle), htmlspecialchars($messageContent), $receiverIds, $senderId, $sendDate, $activeState, $mId, 0));
      
        }
      
        function editMessage($id, $messageTitle, $messageContent, $receiverIds, $senderId, $sendDate, $activeState){
      
          $query = $GLOBALS["db"] -> prepare("UPDATE bc_messages SET m_title = ?, m_content = ?, r_ids = ?, s_id = ?, s_date = ?, a_state = ? WHERE id = ?");
      
          $query -> execute(array($messageTitle, $messageContent, $receiverIds, $senderId, $sendDate, $activeState,$id));
      
        }
      
        function state($type, $aState, $val){
      
          $query = $GLOBALS["db"] -> prepare("UPDATE bc_messages SET a_state = ? WHERE $type = ?");
      
          $query -> execute(array($aState, $val));
      
        }
      
        function isMessage($uType, $nick){
      
          if($uType == "s_id"){
      
            if($this -> returnMessage("s_id") == $nick && $this -> returnMessage("a_state_sender") == 1){
      
              return true;
      
            }
      
            return false;
      
          }else if($uType == "r_ids"){
      
            if($this -> returnMessage("r_ids") == $nick && $this -> returnMessage("a_state") == 1){
      
              return true;
      
            }
      
            return false;
      
          }else if($uType == "trash"){
      
            if($this -> returnMessage("r_ids") == $nick && $this -> returnMessage("a_state") == 2){
      
              return true;
      
            }else if($this -> returnMessage("s_id") == $nick && $this -> returnMessage("a_state_sender") == 2){
      
              return true;
      
            }
      
            return false;
      
          }
      
        }
      
        //insertMessage fonksiyonu
      
      }
?>