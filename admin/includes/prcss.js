var url = "http://localhost/myScript/Script1/admin/";

function post(type_,postComp){

  var data = {};



  postComp.forEach(function(element){

    data[element] = $("#"+element).val();



  });

  data["type"] = type_;

  data["_token"] = $("#_token").val();

  $.ajax({

    method: "post",

    url: url + "includes/posts.php",

    data: data



  }).done(function(data){

    alert(data);

  });

}

function postData(type_,postComp,img){

  var data = new FormData();

  data.append("type", type_);

  //data.append("_token",$("#_token").val());

  data.append("_token",$("#_token").val());

  postComp.forEach(function(element){

    data.append(element, $("#"+element).val());



  });

  if(img != ""){

    data.append(img, $("#" + img)[0].files[0]);

  }



  $.ajax({

    method: "post",

    url: url + "includes/posts.php",

    data: data,

    processData: false,

    contentType: false



  }).done(function(data){

    alert(data);

  });

}

$("#ipBtn").click(function(){
  var data = new FormData();
  data.append("type", "insert-post");
  data.append("_token", $("#_token").val());
  data.append("ipContent", $("#ipContent").val());
  data.append("ipTitle", $("#ipTitle").val());
  data.append("ipPreview", $("#ipPreview").is(":checked"));
  data.append("ipPublish", $("#ipPublish").is(":checked"));

  
  data.append("ipImage", $("#ipImage")[0].files[0]);
  $.post({
    url: url + "includes/posts.php",
    data: data,
    processData: false,
    contentType: false
  }).done(function(data){
    alert(data);
  });

  //postData("insert-post", ["ipContent","ipTitle","ipPreview","ipPublish"], "ipImage");

});

$("#iuBtn").click(function(){

  postData("insert-user",["iuNick","iuPassword","iuEMail","iuPIUrl","iuRDate","iuIsActive"], "iuPIUrl");

});



$("#saveSetting").click(function(){

  post("insert-setting",["setting", "value"]);

});

$("#cSndBtn").click(function(){

  post("insert-comment",["pId", "cDate","cAuthor","cContent"]);

});

$("#changeComment").click(function(){

  post("edit-comment",["pId", "cDate","cAuthor","cContent","id"]);

});

$("#changePost").click(function(){

  postData("edit-post",["pDate","pAuthor","pContent","id","pName"],"pImage");

});

$("#changeUser").click(function(){

  postData("edit-user",["id","uNick","uPw","uEmail","uRDate","uPIUrl","uIsActive"], "uPIUrl");

});

$("#imBtn").click(function(){

  post("insert-message",["mHead","mContent","sId","rIds","sDate","aState"]);

});

$("#changeMessage").click(function(){

  post("edit-message",["id","mHead","mContent","sId","rIds","sDate","aState"]);

});

$("#signUp").click(function(){

  post("sign-up", ["uNick", "pw", "rPw","email"])

});

