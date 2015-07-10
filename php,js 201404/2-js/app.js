var apiurl, myresult, apiurl_size, selected_size;
apiurl = "https://api.flickr.com/services/rest/?method=flickr.photos.getRecent&api_key=b4852521c4eb8521fbf20c1676f52ab2&per_page=10&format=json&nojsoncallback=1";

$(document).ready(function () {

    $.getJSON(apiurl, function (json) {

        photoSizes = [];
        $.each(json.photos.photo, function (i, myresult) {
            apiurl_size = "https://api.flickr.com/services/rest/?method=flickr.photos.getSizes&api_key=b4852521c4eb8521fbf20c1676f52ab2&photo_id=" + myresult.id + "&format=json&nojsoncallback=1";
            
            $.getJSON(apiurl_size, function (size) {

                $.each(size.sizes.size, function (j, myresult_size) {
                    if (myresult_size.width == 640) {
                        photoSizes[myresult.id] = myresult_size.source;
                    }
                })

                $.each(size.sizes.size, function (i, myresult_size) {
                    if (myresult_size.width == 100) {

                        $("#results").append('<tr><td><a href="javascript:ShowImage(' + myresult.id + ');" target="_blank"><img src="' + myresult_size.source + '"/></a></td><td style="cursor: pointer; cursor: hand;" onclick="javascript:ShowImage(' + myresult.id + ');" width="80%">' + myresult.title + '</td><td><a target="_blank" href="http://www.flickr.com/photos/' + myresult.owner + '/' + myresult.id + '">&gt;&gt;</a></td></tr>');
                        console.log(photoSizes);
                    }
                })
            })
            
        });
      
    });

});

function ShowImage(id) {
    $.featherlight(photoSizes[id], {});
}

