$(function () {
  if ($("target").length > 0) {
    var element = "#" + $("target").attr("target");
    alert(element);
  }

  dynamicLoad();
  function  () {
    $("[realtime]").click(function () {
      var page = $(this).attr("realtime");
      $(".container-main").hide();
      $(".container-main").load(page + ".php");

      $(".container-main").fadeIn(1000);
      return false;
    });
  }

});


