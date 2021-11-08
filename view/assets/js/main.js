$(document).ready(function() {

    // Para el registro de usuarios.

    $("#signup-form").submit(function(e) {
        e.preventDefault();
        ajaxCall("POST", "http://localhost/caribbean/view/modules/signupAsSeller.php", $(this).serialize(), "json")
    });

    // Para el login de usuarios.

    $("#login-form").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "http://localhost/caribbean/view/modules/login.php",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                if (response.status == 0) {
                    window.location.href = "http://localhost/caribbean/view/modules/administrator.php";
                } else if (response.status == 1) {
                    emptyFieldsOrKnows("Tu solicitud de registro está pendiente por aprobarse.");
                } else if (response.status == 2) {
                    window.location.href = "http://localhost/caribbean/view/modules/seller.php";
                } else if (response.status == 3) {
                    emptyFieldsOrKnows("Tu solicitud de registro está rechazada.");
                } else if (response.status == 4) {
                    emptyFieldsOrKnows("Credenciales incorrectas.");
                } else if (response.status == 5) {
                    emptyFieldsOrKnows("Revise que ningún campo esté vacío.");
                }
            }
        });
    });

    /* Llamado a funciones para el crud de usuarios y sitios turísticos por parte de un administrador.
       
       CRUD DE USUARIOS
    */

    insertSeller();
    getParticularSeller();
    updateSeller();
    deleteSeller();

    /*
       CRUD DE SITIOS TURISTICOS
    */
    insertTouristSite();
    viewTouristSites();
    getParticularTouristSite();
    updateSite();
    deleteSite();

    // Inicialización de la table vendedor, se muestran todos los datos asociados a los vendedores.

    let table_seller = $('#table_seller').DataTable({
        "ajax": {
            "url": "administrator.php",
            "method": "post",
            "data": { option: 2 },
            "dataSrc": ""
        },
        "columns": [
            { "data": "iduser" },
            { "data": "identity" },
            { "data": "name" },
            { "data": "last_name" },
            { "data": "photo" },
            { "data": "email" },
            { "data": "role" },
            { "data": "city" },
            { "data": "status" },
            { "data": "edit" },
            { "data": "delete" },

        ]
    });


    function emptyFieldsOrKnows(message) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: message
        })
    }

    function successfulRegistration() {
        Swal.fire({
            icon: 'success',
            title: 'Enhorabuena...',
            text: 'Te has registrado exitosamente.',
            footer: `<a href="http://localhost/caribbean/view/modules/login.php">
                            Inicia sesión
                    </a>`
        });
    }

    function ajaxCall(type, url, data, dataType) {
        $.ajax({
                type: type,
                url: url,
                data: data,
                dataType: dataType,
                success: function(response) {

                    if (response.status == 0) {
                        emptyFieldsOrKnows("Revisa que ningún campo esté vacío.");
                    } else if (response.status == 1) {
                        emptyFieldsOrKnows("Este usuario existe en nuestra base de datos.");
                    } else if (response.status == 2) {
                        successfulRegistration();
                    } else if (response.status == 3) {
                        newRegisteredUser();
                    }
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                if (console && console.log) {
                    console.log("La solicitud a fallado: " + textStatus + ": " + errorThrown);
                }
            });
    }

    // Validación del modal.
    $('.modal').on('hidden.bs.modal', function() {
        $(this).find('form').trigger('reset');
    })
});


/*

    Funciones necesarias para el CRUD de Vendedores por parte de un Administrador.

*/

// Crea un nuevo usuario y lo almacena en la base de datos.

function insertSeller() {
    $(document).on("click", "#btnRegisterSeller", function() {
        let identity = $.trim($("#identity").val());
        let name = $.trim($("#name").val());
        let last_name = $.trim($("#last_name").val());
        let photo = $.trim($("#photo").val());
        let email = $.trim($("#email").val());
        let password = $.trim($("#password").val());
        let city = $.trim($("#city").val());
        let status = $.trim($("#status").val());

        if (identity == "" || name == "" || last_name == "" || !photo || email == "" || password == "" || city == "" || status == "") {
            emptyFieldsOr("Revisa que ningún campo esté vacío.");
        } else {
            let formData = new FormData();
            formData.append("photo", $("#photo")[0].files[0]);
            formData.append("identity", identity);
            formData.append("name", name);
            formData.append("last_name", last_name);
            formData.append("email", email);
            formData.append("password", password);
            formData.append("city", city);
            formData.append("status", status);
            formData.append("option", 1);
            $.ajax({
                url: "administrator.php",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                //data: { identity: identity, name: name, last_name: last_name, email: email, password: password, city: city, status: status, option: 1 },
                success: function(data) {
                    data = $.parseJSON(data);
                    //alert(data);
                    if (data.status == 1) {
                        goodNews("Enhorabuena...", "Has agregado un nuevo usuario.");
                        $("#sellerModal").modal("show");
                        $("form").trigger("reset");
                        $('#table_seller').DataTable().ajax.reload();
                    } else if (data.status == 2) {
                        emptyFieldsOr("Algo malo pasó, no se pudo crear este usuario.");
                    } else if (data.status == 3) {
                        emptyFieldsOr("Esta persona está registrada, intenta con una nueva.");
                    } else if (data.status == 4) {
                        emptyFieldsOr("La foto tiene un tamaño muy grande.");
                    } else if (data.success == 5) {
                        emptyFieldsOr("Solo se permiten archivos con extensión jpeg, jpg y png");
                    }
                }
            });
        }
    });

    $(document).on("click", "#btnClose", function() {
        $("form").trigger("reset");
    });
}


// Obtiene los datos de un vendedor en particular.

function getParticularSeller() {
    $(document).on("click", "#btnEdit", function() {
        let id = $(this).attr("data-id");

        $.ajax({
            url: "administrator.php",
            method: "POST",
            data: { id: id, option: 3 },
            dataType: "JSON",
            success: function(response) {
                $("#updateId").val(response[0]);
                $("#updateIdentity").val(response[1]);
                $("#updateName").val(response[2]);
                $("#updateLast_name").val(response[3]);
                $("#updateEmail").val(response[4]);
                $("#updatePassword").val(response[5]);
                $("#updateRole").val(response[6]);
                $("#updateCity").val(response[7]);
                $("#updateStatus").val(response[8]);

                $("#updateSellerModal").modal("show");
            }
        });
    });
}


// Actualiza la información del vendedor escogido.

function updateSeller() {

    $(document).on("click", "#btnUpdateSeller", function() {
        let updateId = $("#updateId").val();
        let updateIdentity = $("#updateIdentity").val();
        let updateName = $("#updateName").val();
        let updateLast_name = $("#updateLast_name").val();
        let updateEmail = $("#updateEmail").val();
        let updatePassword = $("#updatePassword").val();
        let updateRole = $("#updateRole").val();
        let updateCity = $("#updateCity").val();
        let updateStatus = $("#updateStatus").val();

        if (updateIdentity == "" || updateName == "" || updateLast_name == "" || updateEmail == "" || updatePassword == "" || updateCity == "" || updateStatus == "") {
            emptyFieldsOr("Revisa que ningún campo esté vacío.");
            $("#updateSellerModal").modal("show");
        } else {
            $("#updateSellerModal").modal("hide");
            $("#confirmSellerModal").modal("show");

            $(document).on("click", "#btnConfirmSeller", function() {

                $("form").trigger("reset");
                $("#updateSellerModal").modal("hide");
                $("#confirmSellerModal").modal("hide");
                $.ajax({
                    url: "administrator.php",
                    method: "POST",
                    data: { id: updateId, identity: updateIdentity, name: updateName, last_name: updateLast_name, email: updateEmail, password: updatePassword, role: updateRole, city: updateCity, status: updateStatus, option: 4 },
                    success: function(data) {
                        data = $.parseJSON(data);

                        if (data.status == 4) {

                            $('#table_seller').DataTable().ajax.reload();

                            goodNews("Bien hecho", "Has actualizado la información sin problemas.");

                        } else if (data.status == 5) {
                            emptyFieldsOr("No se pudo realizar la actualización.");
                        }
                    }
                });
            });
        }
    });
}

// Borra al vendedor escogido.


function deleteSeller() {
    $(document).on("click", "#btnDelete", function() {

        let deleteId = $(this).attr("data-id2");

        $("#deleteSellerModal").modal("show");

        $(document).on("click", "#btnDeleteSeller", function() {

            $.ajax({
                url: "administrator.php",
                method: "POST",
                data: { id: deleteId, option: 5 },
                success: function(data) {
                    data = $.parseJSON(data);
                    if (data.status == 6) {
                        goodNews("El usuario", "ha sido eliminado con exito.");
                        $("#deleteSellerModal").modal("hide");
                        $('#table_seller').DataTable().ajax.reload();
                    } else if (data.status == 7) {
                        emptyFieldsOr("No se pudo eliminar.");
                    } else if (data.status == 8) {
                        emptyFieldsOr("No existe una foto para eliminar");
                    }
                },
                error: function(e) {
                    console.log(e);
                }
            });
        });
    });
}

function insertTouristSite() {
    $(document).on("click", "#btnRegisterSite", function() {
        let city = $.trim($("#city2").val());
        let country = $.trim($("#country").val());
        let name = $.trim($("#name2").val());
        let description = $.trim($("#description").val());

        if (city == "" || country == "" || name == "" || description == "") {
            emptyFields("Campos vacíos");
        } else {
            $.ajax({
                url: "manageTouristSites.php",
                method: "POST",
                data: { city: city, country: country, name: name, description: description, option: 6 },
                success: function(data) {
                    data = $.parseJSON(data);
                    if (data.status == 1) {
                        newTouristSite();
                        viewTouristSites()
                        $("form").trigger("reset");
                    } else if (data.status == 2) {
                        alert("No se pudo registrar");
                        $("form").trigger("reset");
                    }
                }
            });
        }
    });

    $(document).on("click", "#btnCloseSM", function() {
        $("form").trigger("reset");
    });
}

function viewTouristSites() {
    $.ajax({
        url: "manageTouristSites.php",
        method: "POST",
        data: { option: 7 },
        success: function(response) {
            response = $.parseJSON(response);
            if (response.status == "success") {
                $("#table_tsite").html(response.html);
            }
        }
    });
}

function getParticularTouristSite() {
    $(document).on("click", "#btnEdit", function() {
        let id = $(this).attr("data-id");
        $.ajax({
            url: "manageTouristSites.php",
            method: "POST",
            data: { id: id, option: 8 },
            dataType: "JSON",
            success: function(response) {
                $("#updateId2").val(response[0]);
                $("#updateCity2").val(response[2]);
                $("#updateCountry").val(response[1]);
                $("#updateName2").val(response[3]);
                $("#updateDescription2").val(response[4]);

                $("#updateSiteModal").modal("show");
            }
        });
    });
}

function updateSite() {

    $(document).on("click", "#btnUpdateSite", function() {
        let updateId = $("#updateId2").val();
        let updateCity = $("#updateCity2").val();
        let updateCountry = $("#updateCountry").val();
        let updateName = $("#updateName2").val();
        let updateDescription = $("#updateDescription2").val();

        if (updateId == "" || updateCity == "" || updateCountry == "" || updateName == "" || updateDescription == "") {
            emptyFields("Campos vacíos");
            $("#updateSellerModal").modal("show");
        } else {
            $.ajax({
                url: "manageTouristSites.php",
                method: "POST",
                data: { id: updateId, city: updateCity, country: updateCountry, name: updateName, description: updateDescription, option: 9 },
                success: function(data) {

                    data = $.parseJSON(data);
                    if (data.status == 1) {
                        viewTouristSites();
                        $("#updateSiteModal").modal("hide");
                        $("form").trigger("reset");
                    } else if (data.status == 2) {
                        alert("Algo grave pasó");
                        $("form").trigger("reset");
                    }
                }
            });
        }
    });
}

function deleteSite() {
    $(document).on("click", "#btnDelete", function() {

        let deleteId = $(this).attr("data-id2");

        $("#deleteSiteModal").modal("show");

        $(document).on("click", "#btnDeleteSite", function() {

            $.ajax({
                url: "manageTouristSites.php",
                method: "POST",
                data: { id: deleteId, option: 10 },
                success: function(data) {
                    viewTouristSites();
                    // alert("Eliminado!");
                    $("#deleteSiteModal").modal("hide");
                },
                error: function(e) {
                    console.log(e);
                }
            });
        });
    });
}

// Mensajes emergentes

function newTouristSite() {
    Swal.fire({
        icon: 'success',
        title: 'Enhorabuena...',
        text: 'Has agregado un nuevo sitio.'
    });
}

function emptyFieldsOr(message) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: message
    })
}

function goodNews(title, msg) {
    Swal.fire({
        icon: 'success',
        title: title,
        text: msg
    });
}