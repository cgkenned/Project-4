console.log("flickrcalled")
  var html = ""
  var apiurl = "http://api.flickr.com/services/feeds/photos_public.gne?tags=sexualassaultsurvivor&tagmode=any&format=json&jsoncallback=?"
  $(document).ready(function(){
          console.log("document ready")
          $.getJSON(apiurl,function(json){
              console.log(json);
              <!-- $("#flickr").append('<p>"'+json.title+'"</p>'); -->

              $.each(json.items,function(i,data){
                  html += '<a href="' + data.link + '" target="_blank"><img src ="' + data.media.m + '" style="width: 100%"></a>';
                  html += '<div class="flickrinfo"><h3>' + data.title + '</h3></div>';
                  // html += data.description.title + '</div>';
                  });
              console.log(html);
              $("#flickr").append(html);
          });

          // $.readyFn.execute();


  });
