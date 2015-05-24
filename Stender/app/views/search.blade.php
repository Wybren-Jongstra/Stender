<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Autocomplete - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    
    $( "#search" ).autocomplete(
    {
        source: 'search/autocomplete',
        select: function( event, ui ) {
            $( "#search" ).val( ui.item.label + " / " + ui.item.actor );
            return false;
        }
    }).data( "autocomplete" )._renderItem = function( ul, item ) {
        return $( "<li></li>" )
            .data( "item.autocomplete", item )
            .append( "<a><strong>" + item.label + "</strong> / " + item.actor + "</a>" )
            .appendTo( ul );
        };  
  });
  </script>
</head>
<body>
 
<div class="ui-widget">
  <label for="search">Tags: </label>
  <input id="search">
</div>
 
 
</body>
</html>