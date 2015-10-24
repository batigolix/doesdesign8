jQuery(function () {

      // console.log(drupalSettings.dd8_tools);
      var block_items = drupalSettings.dd8_tools.flickr.flickr_items;
      jQuery(document).ready(function () {

        // Calls Flickr, gets details of recent 20 images of flickr id
        // e.g. batigolix 62546836@N00. Structure of call
        // $.getJSON("http://api.flickr.com/services/feeds/groups_pool.gne?id=998875@N22&lang=en-us&format=json&jsoncallback=?", displayImages);
        jQuery.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?id=23406248@N05&lang=en-en&format=json&jsoncallback=?", displayImages);
        function displayImages(data) {

          // Constructs the HTML string
          var htmlString = "<ul>";

          // Cycles through our array of Flickr photo details.
          jQuery.each(data.items, function (i, item) {

            // Fetches thumbnails.
            var sourceSquare = (item.media.m).replace("_m.jpg", "_s.jpg");

            // Constructs the individual thumbnail HTML
            htmlString += '<li><a href="' + item.link + '" >';
            htmlString += '<img title="' + item.title + '" src="' + sourceSquare;
            htmlString += '" alt="';
            htmlString += item.title + '" />';
            htmlString += '</a></li>';
            return i < 11;
          });

          // Pops HTML in the #images DIV.
          jQuery('#flickr_images').html(htmlString + "</ul>");
        }
      });

});;
