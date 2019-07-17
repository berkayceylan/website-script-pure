<?php 
    class BcPost extends BcDb{

        private $arrPosts;
      
        public $currentPost = 0;
      
        private $postCount;
      
        public $post;
      
      
      
      
      
        function __construct(){
      
          $this -> arrPosts = $this -> fetchId("bc_posts");
      
          $this -> postCount = count($this -> arrPosts);
      
          $this -> postCount2 = count($this -> arrPosts);
          
          $this -> limit2 = $this -> postCount;
          
          $this -> writedPost = 0;
        }
      
        public function havePosts($rewindPost = 0, $limit2 = 0){
          //echo($this -> postCount2);
          if($limit2 != 0){
              $this -> limit2 = $limit2;
          }
          
          
          if($rewindPost == 1){
      
            $this -> currentPost = $this -> postCount + 1;
      
            if($this -> writedPost < $this -> limit2){
      
      
      
              
              $this -> writedPost++;
              
              $this -> currentPost -= 1;
      
              $this -> postCount -= 1;
      
              return true;
      
            }
      
            $this -> postCount = count($this -> arrPosts);
      
            return false;
      
          }
      
          if($this -> currentPost < $this -> postCount){
      
      
      
      
      
      
           
           
            
            $this -> currentPost += 1;
          
      
            return true;
      
          }else
      
            return false;
      
        }
          public function nextPost($rewind = 0){
              if($rewind == 1){
                  
                  
              
                  $this -> currentPost -= 1;
          
                  $this -> postCount -= 1;
              }
          }
        public function returnPreview($column, $length){
          $text = $this -> returnPost($column);
      
          $text = str_replace(["\n", "<br>", "&nbsp"],["a","a"," "], $text);
          return substr($text, 0, $length);
        }
        public function returnPost($column, $is_preview = false){
      
      
      
          $fetch = $this -> fetchColumn("bc_posts",$column,"id", $this -> currentPost);
      
          //$isPublish = $this -> fetchColumn("bc_posts","is_publish","id", $this -> currentPost)["is_publish"];
      
      
      
      
          $rpost = $fetch[$column];
          /* ispublish burada uygulanabilir */
          if(!$is_preview)
            $rpost = nl2br(str_replace("  ", "&nbsp&nbsp",( $fetch[$column])));
          if($is_preview)
            $rpost = str_replace(["<center>","</center>"],["",""],$rpost);
          if($column == "p_date"){
      
            $time = strtotime($rpost);
      
            $forView = date("d/m/Y G:i", $time);
      
      
      
            return $forView;
      
          }
      
          return $rpost;
      
        }
      
        public function insertPost($insertArray){
      
          if(trim($insertArray["pTitle"]) == "" || trim($insertArray["pContent"]) == ""){
      
            echo("Başlık ve ya konu boş olamaz !");
      
            return;
      
          }
      
      
      
          $pQuery = $GLOBALS["db"] -> prepare("INSERT INTO bc_posts (p_title,p_date,p_author,s_id,p_content,p_comments,p_categ,image_url,is_publish,is_preview) VALUES (?,?,?,?,?,?,?,?,?,?)");
      
          $pQuery -> execute(array(
      
            $insertArray["pTitle"],$insertArray["pDate"],$insertArray["pAuthor"],
      
              $insertArray["sId"],$insertArray["pContent"],$insertArray["pComments"],$insertArray["pCateg"],$insertArray["imageUrl"],$insertArray["isPublish"],$insertArray["isPreview"]));
      
        }
      
        public function editPost($editArray){
      
          if(trim($editArray["img"]) == ""){
      
            $editArray["img"] = $this -> fetchColumn("bc_posts", "image_url", "id", $editArray["id"])["image_url"];
      
          }
      
          $query = $GLOBALS["db"] -> prepare("UPDATE bc_posts SET p_title = ?,p_date = ?,p_author = ?,p_content = ?,is_publish = ?,image_url = ? WHERE id = ?");
      
          $query -> execute(array($editArray["pTitle"],$editArray["pDate"],$editArray["pAuthor"],$editArray["pContent"],1,$editArray["img"],$editArray["id"]));
      
        }
      
        public function uploadImage($arrFile, $newFilePreName){
      
          $fileName = $arrFile["name"];
      
          $ext = explode(".", $fileName)[count(explode(".", $fileName)) - 1];
      
          $numb = rand(0,999999);
      
          $filePath =
      
            $this -> fetchSetting("path") . "content/images/" . $newFilePreName ."_" . $numb . "." .$ext;
      
          $fileUrl = $this -> fetchSetting("url") . "content/images/" . $newFilePreName ."_" . $numb . "." .$ext;
      
          move_uploaded_file($arrFile["tmp_name"], $filePath);
      
          return $fileUrl;
      
        }
        public function returnUrl(){
          $url = $this -> fetchSetting("url") . "konu/" . $this -> returnPost("p_title");
          return $url; 
        }
        public function returnDate(){
      
          /*is_publish*/
      
      
      
        }
      
      
      }


?>