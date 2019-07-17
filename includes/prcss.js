var postUrl = "http://localhost/myScript/Script1/includes/posts.php";

function post(type_,postComp){
  var data = {};

  postComp.forEach(function(element){
    data[element] = $("#"+element).val();

  });
  data["type"] = type_;
  data["_token"] = $("#_token").val();
  $.ajax({
    method: "post",
    url: postUrl,
    data: data

  }).done(function(data){
    alert(data);
    if(data.indexOf("login success") != -1){
      location.href = "./";
    }
    if(data.indexOf("lang") != -1){
      location.reload();
    }
  });
}
function postv2(type_,postComp,image){
  var data = new FormData();

  postComp.forEach(function(element){
    data.append(element, $("#"+element).val());

  });
  if(image != ""){
    data.append("img", $("#" + image)[0].files[0]);
  }
  data.append("type", type_);
  data.append("_token", $("#_token").val());
  $.ajax({
    method: "post",
    url: postUrl,
    data: data,
    processData: false,
    contentType: false

  }).done(function(data){
    alert(data);
    location.reload();
    if(data.indexOf("login success") != -1){
      location.href = "../";
    }

  });
}
$("#signUp").click(function(){

  post("sign-up",["uNick","pw","rPw","email"]);
});
$("#login").click(function(){

  post("login",["uNick","uPw","remember"]);
});
$("#uPw").keypress(function(e){
  if(e.which == 13){
    post("login",["uNick","uPw","remember"]);
  }

});
$("#changeProfile").click(function(){
  postv2("change-profile", ["id", "email", "pw", "rPw", "oPw"],"uImage");
});
$("#sendComment").click(function(){
  post("insert-comment",["comment","pId"]);
});
$("#sendMessage").click(function(){
  post("send-message",["mTitle","mContent","receiver"]);
});
var comInx = -1;
  $(".editComment").click(function(){
    //

    if($(".editComment").hasClass("changeComment")){

      $.post({
        url: postUrl,
        data:{
          _token: $("#_token").val(),
          cContent: $(".artc1:eq(" + comInx + ") #cContent").val(),
          id: $(".artc1:eq(" + comInx + ") #id").val(),
          type: "change-comment"
        }
      }).done(function(data){
        location.reload();
      });


    }


  });

$("#deleteComment").click(function(){
  post("delete-comment",["id"]);
  location.reload();
});
$("#userQuit").click(function(){
  post("quit-user", []);

});
$("#receiver").text($("#receiver").text().trim());
var mInx = -1;
$(".mSelect").click(function(){
  mInx = $(this).parent().parent().index();
  $(".mSelect").prop("checked", false);
  $(this).prop("checked", true);
});

function postTrash(type){
  if(mInx == -1){
    return false;
  }
  var m_id = $("#mTable tr:eq(" + mInx + ") #m_id").val();

  $.post({
    url: postUrl,
    data:{
      _token: $("#_token").val(),
      type: type,
      m_id: m_id
    }
  }).done(function(data){
    location.reload();

  });
}

$("#sendToTrash").click(function(){
  postTrash("send-trash");
});
$("#removeFromTrash").click(function(){
  postTrash("remove-from-trash");
});
$("#remove").click(function(){
  postTrash("remove");
});
$("#followWebsite").click(function(){
    post("followWebsite", ["followEmail", "followEmailCode"]);

});
$("#forgetPassword").click(function(){
    post("change-password", ["fEmailCode", "email"]);
});
$("#setTurkish").click(function(){
  post("setTurkish",[]);
});
$("#setEnglish").click(function(){
  post("setEnglish",[]);
});