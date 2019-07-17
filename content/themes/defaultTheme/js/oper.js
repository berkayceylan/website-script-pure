$(document).click(function(){

  if($(".myProfileMenu").css("display") == "inline-block")
    $(".myProfileMenu").css("display", "none");

});

$(".myProfile").click(function(){
  if($(".myProfileMenu").css("display") == "none"){
    $(".myProfileMenu").css("display", "inline-block");

  }else{
    $(".myProfileMenu").css("display", "none");
  }

});
$(".editComment").click(function(){
  comInx = $(this).parent().parent().parent().index() - 1; // düzeltilecek

  var com = $(".artc1:eq(" + comInx + ") #commentContent").text();
  $(".artc1:eq(" + comInx + ") #commentContent").html('<textarea class = "textr1" id = "cContent">' + com + "</textarea>");
  $(this).text("Kaydet");
  $(this).addClass("changeComment");
  $(".artc1:eq(" + comInx + ") #deleteComment").css("display", "inline-block");

});
$("#followNewButton").click(function(){

  if($(".followNewRegistry").css("display") == "none"){
    $(".followNewRegistry").css("display", "inline-block");
  }else{
    $(".followNewRegistry").css("display", "none");
  }
});
$("title").html("B.C. Websitesi");
