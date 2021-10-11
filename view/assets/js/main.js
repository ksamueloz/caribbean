$(document).ready(function() {
    $("#signup-form").submit(function(e) {
        e.preventDefault();
        $.ajax({
                type: "POST",
                url: "http://localhost/caribbean/view/modules/signupAsSeller.php",
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    // let jsonData = JSON.stringify(response);
                    // console.log(response.success);
                    if (response.status == 0) {
                        emptyFieldsOrKnows("Revisa que ningún campo esté vacío.");
                    }
                    if (response.status == 1) {
                        emptyFieldsOrKnows("Este usuario existe en nuestra base de datos.");
                    }
                    if (response.status == 2) {
                        successfulRegistration();
                    }
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                if (console && console.log) {
                    console.log("La solicitud a fallado: " + textStatus + ": " + errorThrown);
                }
            });
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
                    emptyFieldsOrKnows("Revisa que ningún campo esté vacío.");
                } else if (response.status == 1) {
                    emptyFieldsOrKnows("Tu solicitud de registro está pendiente por aprobarse.");
                } else if (response.status == 2) {
                    emptyFieldsOrKnows("Tu solicitud de registro está rechazada.");
                } else if (response.status == 3) {
                    emptyFieldsOrKnows("Credenciales incorrectas.");
                } else if (response.status == 4) {
                    window.location.href = "http://localhost/caribbean/view/modules/welcome.php";
                }
            }
        });
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
            },
            function() {
                window.location.href = 'http://localhost/caribbean/view/modules/login.php';
            });
    }
});