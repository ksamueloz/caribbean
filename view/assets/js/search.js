$(document).ready(function() {
    searchSites();
    uploadScript();
});

function searchSites() {
    $(document).on("click", "#btnSearchSites", function() {
        let nameSites = $.trim($("#search-sites").val());

        if (nameSites == "") {
            emptyFieldsOr("Completa el campo para así buscar información del sitio.");
        } else {
            $.ajax({
                url: "search.php",
                method: "POST",
                data: { nameSites: nameSites, option: "searchSites" },
                success: function(data) {
                    data = $.parseJSON(data);
                    console.log(data);

                    if (data.site) {
                        console.log(data.site);
                        $("#nameSiteSearch").val(data.site["name"]);
                        $("#descriptionSiteSearch").val(data.site["description"]);
                        $("#photoSiteSearch").attr("src", data.site["picture"]);

                        initialize(data.site["latitude"], data.site["longitude"], data.site["name"]);
                        // (38.3489719, -0.4780289000000266), santa marta = (11.2407900, -74.1990400)

                    }
                    if (data.status == "Hubo un problema") {
                        console.log("No encontramos información sobre este sitio :(");
                    }
                    // if (data == "success") {
                    //     console.log(data.cards);
                    //     $(".row.cards-products").html(data.cards);
                    // }
                },
                error: function(e) {
                    console.log(e);
                }
            });
        }
    });
}

// Mapa de los sitios turísticos 


function uploadScript() {
    var script = document.createElement('script');
    script.src = 'http://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize';
    document.body.appendChild(script);
}

// Inicializar el mapa.

function initialize(lat, lng, title) {
    if (!lat || !lng || !title) {
        lat = 38.3489719;
        lng = -0.4780289000000266;
        title = "Continente lejano";
    }
    //Opciones del mapa
    let mapOptions = {
        center: new google.maps.LatLng(lat, lng),
        mapTypeId: google.maps.MapTypeId.SATELLITE, //ROADMAP  SATELLITE HYBRID TERRAIN
        zoom: 6
    };

    let myMap;
    //constructor
    myMap = new google.maps.Map(document.getElementById('mapa'), mapOptions);

    //Añadimos el marcador
    let marker = new google.maps.Marker({
        position: new google.maps.LatLng(lat, lng),
        map: myMap,
        title: title
    });
}
// Mensajes de error y éxito.

function emptyFieldsOr(message) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: message
    })
}