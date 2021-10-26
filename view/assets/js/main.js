$(document).ready(function() {
    $("#signup-form").submit(function(e) {
        e.preventDefault();
        ajaxCall("POST", "http://localhost/caribbean/view/modules/signupAsSeller.php", $(this).serialize(), "json")
    });

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

    insertSeller();
    viewSellers();
    getParticularSeller();
    updateSeller();
    deleteSeller();

    $('#table_seller').dataTable({
        "columnDefs": [{
            "targets": [0, 9],
            "orderable": false,
        }]
    });


    /*
    // Registro de vendedor por parte de un administrador
    $("#signup-form-1").submit(function(e) {
        e.preventDefault();
        ajaxCall("POST", "http://localhost/caribbean/view/modules/administrator.php", $(this).serialize(), "json")
    });

    $("#signup-form-2").submit(function(e) {
        e.preventDefault();
        ajaxCall("POST", "http://localhost/caribbean/view/modules/administrator.php", $(this).serialize(), "json")
    });

    $(".btn-delete").on('click', function() {
        // $('.tab-pane a[href="#tab-2"]').tab('show')
        window.history.pushState({}, document.title, "/" + "caribbean/view/modules/administrator.php");
    });*/

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

    function newRegisteredUser() {
        Swal.fire({
            icon: 'success',
            title: 'Enhorabuena...',
            text: 'Has agregado un nuevo usuario.'
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

function insertSeller() {
    $(document).on("click", "#btnRegisterSeller", function() {
        let identity = $.trim($("#identity").val());
        let name = $.trim($("#name").val());
        let last_name = $.trim($("#last_name").val());
        let email = $.trim($("#email").val());
        let password = $.trim($("#password").val());
        let city = $.trim($("#city").val());
        let status = $.trim($("#status").val());

        if (identity == "" || name == "" || last_name == "" || email == "" || password == "" || city == "" || status == "") {
            alert("Campos vacíos");
        } else {
            $.ajax({
                url: "administrator.php",
                method: "POST",
                data: { identity: identity, name: name, last_name: last_name, email: email, password: password, city: city, status: status, option: 1 },
                success: function(data) {
                    alert(data);
                    $("#sellerModal").modal("show");
                    $("form").trigger("reset");
                    viewSellers();
                }
            });
        }
    });

    $(document).on("click", "#btnClose", function() {
        $("form").trigger("reset");
    });
}

function viewSellers() {
    $.ajax({
        url: "administrator.php",
        method: "POST",
        data: { option: 2 },
        success: function(response) {
            response = $.parseJSON(response);
            if (response.status == "success") {
                $("#table_seller").html(response.html);
            }
        }
    });
}

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
            alert("Campos vacíos");
            $("#updateSellerModal").modal("show");
        } else {
            $.ajax({
                url: "administrator.php",
                method: "POST",
                data: { id: updateId, identity: updateIdentity, name: updateName, last_name: updateLast_name, email: updateEmail, password: updatePassword, role: updateRole, city: updateCity, status: updateStatus, option: 4 },
                success: function(data) {
                    $("#updateSellerModal").modal("hide");
                    viewSellers();
                }
            });
        }
    });
}

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
                    viewSellers();
                    // alert("Eliminado!");
                    $("#deleteSellerModal").modal("hide");
                },
                error: function(e) {
                    console.log(e);
                }
            });
        });
    });
}