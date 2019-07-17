$(".subSideMenu").click(function(){
  var select = ".subSideMenu:eq(" + $(this).index() + ") .subSide";

  if($(select).css("display") == "none"){
    $(select).css("display", "inherit");
  }else{
    $(select).css("display", "none");
  }

});
$(".subSide").click(function(){
  

});
