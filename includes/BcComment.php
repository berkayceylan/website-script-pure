<?php 
    class BcComment extends BcDb{

        public $currentComment = 0;
      
        private $countComment = 0;
      
        function __construct(){
      
          $this -> countComment = count($this -> fetchId("bc_comments"));
      
        }
      
        function haveComment(){
      
          if($this -> currentComment < $this -> countComment){
      
      
      
      
      
            $this -> currentComment++;
      
      
      
            return true;
      
          }
      
          return false;
      
        }
      
        function returnComment($column, $pId = ""){
      
          $fetched = "";
      
      
      
          $fetch = $this -> fetchColumn("bc_comments",$column,"id", $this -> currentComment);
      
          $query = $GLOBALS["db"] -> prepare("SELECT $column FROM bc_comments WHERE id = ? AND p_id = ?");
      
          $query -> execute(array($this -> currentComment, $pId));
      
          $fetchB = $query -> fetch(PDO::FETCH_ASSOC);
      
      
      
          if($pId == "")
      
            $fetched = ($fetch[$column]);
      
          else
      
            $fetched = ($fetchB[$column]);
      
      
      
          if($column == "c_date"){
      
            $date = strtotime($fetched);
      
            $forViewDate = date("d/m/Y G:i", $date);
      
            return $forViewDate;
      
          }
      
      
      
          return $fetched;
      
      
      
        }
      
        function editComment($commentArr){
      
          $query = $GLOBALS["db"] -> prepare("UPDATE bc_comments SET c_content = ? WHERE id = ?");
      
          $query -> execute($commentArr);
      
        }
      
        function deleteComment($id){
      
          $query = $GLOBALS["db"] -> prepare("UPDATE bc_comments SET is_active = ? WHERE id = ?");
      
          $query -> execute(array(0,$id));
      
        }
      
        function insertComment($commentArr){
      
          if(trim($commentArr["c_content"]) == ""){
      
            echo("Yorum boş olmamalıdır.");
      
            return false;
      
          }
      
      
      
          $query = $GLOBALS["db"] -> prepare("INSERT INTO bc_comments(p_id,c_date,c_author,c_content,is_active,s_id) VALUES(?,?,?,?,?,?)");
      
          $query -> execute(array($commentArr["p_id"], $commentArr["c_date"], $commentArr["c_author"], $commentArr["c_content"], $commentArr["is_active"], $commentArr["s_id"]));
      
          return true;
      
        }
      
      }

?>