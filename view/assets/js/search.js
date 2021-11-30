$(document).ready(function() {
    searchSites();
    searchSeller();
    uploadScript();

    // Botón de información sobre la búsqueda.
    search();
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
                    console.log(data.status);

                    if (data.site) {
                        console.log(data.site);
                        $("#nameSiteSearch").val(data.site["name"]);
                        $("#descriptionSiteSearch").val(data.site["description"]);
                        $("#photoSiteSearch").attr("src", data.site["picture"]);

                        initialize(data.site["latitude"], data.site["longitude"], data.site["name"]);
                        // (38.3489719, -0.4780289000000266), santa marta = (11.2407900, -74.1990400)

                    }
                    if (data.status == "Hubo un problema") {
                        emptyFieldsOr("No encontramos información sobre este sitio :(");
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


// Búsqueda de un determinado vendedor.

function searchSeller() {
    $(document).on("click", "#btnSearchSeller", function() {
        let code = $.trim($("#search-seller").val());

        if (code == "") {
            emptyFieldsOr("Completa el campo para así buscar información del vendedor.");
        } else {
            $.ajax({
                url: "searchSeller.php",
                method: "POST",
                data: { code: code, option: "searchSeller" },
                success: function(data) {
                    data = $.parseJSON(data);

                    if (data.seller != "No encontrado") {
                        // console.log(data.seller);

                        $("#nameSellerSearch").val(data.seller["name"]);
                        $("#lastNameSellerSearch").val(data.seller["last_name"]);
                        $("#roleSellerSearch").val(data.seller["role"]);
                        $("#codeSellerSearch").val(data.seller["code"]);
                        $("#photoSellerSearch").attr("src", data.seller["picture"]);

                        if (data.cards != "") {
                            $(".row.cards-search").html(data.cards);
                        } else {
                            $(".row.cards-search").html("Esta persona aún no ha agregado sus productos.");
                        }

                    } else {
                        emptyFieldsOr("No encontramos información sobre este vendedor :(");
                    }
                    /*if (data.site) {
                        $("#nameSiteSearch").val(data.site["name"]);
                        $("#photoSiteSearch").attr("src", data.site["picture"]);

                    }
                    if (data.status == "Hubo un problema") {
                        emptyFieldsOr("No encontramos información sobre este sitio :(");
                    } */
                },
                error: function(e) {
                    console.log(e);
                }
            });
        }
    });
}

// Información sobre cómo funciona el buscador de vendedores.

function search() {
    $(document).on("click", "#btnInfo", function() {
        Swal.fire({
            icon: 'info',
            title: '¿Cómo funciona?',
            text: `Ingresa un código de 4 digitos, por ejemplo asdf,
                   para que podamos buscar al vendedor asociado a dicho código.`
        })
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