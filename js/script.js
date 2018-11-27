$(document).ready(function(){
   //var cari = document.getElementById("cari");
   
   $("#cari").on("keyup", function(){
      var url = window.location.search;
      if($("#cari").val()!=''){
         $("#content").load("control/cari.php?key=" + $("#cari").val());
      }else{
         // $(document).load("home.php");
         $(location).attr('href', url);
         // $(location).attr('href', 'home.php');
      }
   });

});