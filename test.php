<script
    src="https://code.jquery.com/jquery-3.7.0.js"
    integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script>
<script>
    var settings = {
        "async": true,
        "crossDomain": true,
        "url": "http://soundcloud.com/oembed",
        "method": "POST",
        "headers": {},
        "data": {
            "format": "json",
            "url": "http://soundcloud.com/forss/flickermood"
        }
    }

    $.ajax(settings).done(function (response) {
        console.log(response);
    });
</script>

