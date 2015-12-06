function search(){
  console.log("got here");
  var url = "./?search=" + $('input#search').val();
  window.location.replace(url);
}


$(document).ready(function(){
  $("input#search").keyup(function(event){
    if(event.keyCode == 13)
      search();
  });
});
