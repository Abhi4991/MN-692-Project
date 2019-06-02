<html>  
  <head><title>YQL and RSS: Yahoo Top News Stories</title>  
  <style type='text/css'>  
    #results{ width: 40%; margin-left: 30%; border: 1px solid gray; padding: 5px; height: 200px; overflow: auto; }   
  </style>  
  <script type='text/javascript'>  
    // Parses returned response and extracts  
    // the title, links, and text of each news story.  
    function top_stories(o){  
      var items = o.query.results.item;  
      var output = '';  
      var no_items=items.length;  
      for(var i=0;i<no_items;i++){  
        var title = items[i].title;  
        var link = items[i].link;  
        var desc = items[i].description;  
        output += "<h3><a href='" + link + "'>"+title+"</a></h3>" + desc + "<hr/>";  
      }  
      // Place news stories in div tag  
      document.getElementById('results').innerHTML = output;    
    }  
    </script>  
  </head>  
  <body>  
    <!-- Div tag for stories results -->  
    <div id='results'></div>  
    <!-- The YQL statment will be assigned to src. -->  
    <script src=''></script>  
  </body>  
</html>  