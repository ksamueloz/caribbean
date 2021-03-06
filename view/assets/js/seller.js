$(document).ready(function() {

    // LLamado a las funciones para el CRUD de productos por un vendedor.
    insertProduct();
    viewProducts();
    getParticularProduct();
    updateProduct();
    deleteProduct();

    // Edición de perfil.
    viewProfile();
    updateProfile();

});

/*

    Funciones necesarias para el CRUD (Creación, Visualización, Edición y Eliminación) de productos
    por parte de un Vendedor.

*/

// Ingresar un nuevo producto.

function insertProduct() {
    $(document).on("click", "#btnRegisterProduct", function() {
        let nameProduct = $.trim($("#nameProduct").val());
        let descProduct = $.trim($("#descProduct").val());
        let photoProduct = $.trim($("#photoProduct").val());
        let priceProduct = $.trim($("#priceProduct").val());

        if (nameProduct == "" || descProduct == "" || photoProduct == "" || priceProduct == "") {
            emptyFieldsOr("Revise que ningún campo esté vacío.");
        } else {
            let formData = new FormData();
            formData.append("nameProduct", nameProduct);
            formData.append("descProduct", descProduct);
            formData.append("priceProduct", priceProduct);
            formData.append("option", "registerProduct");
            formData.append("photoProduct", $("#photoProduct")[0].files[0]);

            $.ajax({
                url: "seller.php",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    data = $.parseJSON(data);

                    if (data.status == "Foto grande" || data.success == "Imagen no permitida") {
                        emptyFieldsOr("Revise que la imagen no sea demasiado grande < a 2 MB y cuente con una extensión tipo JPEG, JPG o PNG");
                    } else if (data.status == "Producto no agregado") {
                        emptyFieldsOr("El producto no pudo ser agregado.");
                    } else if (data.status == "Producto agregado") {
                        goodNews("Excelente", "Has agregado un nuevo producto.");
                        viewProducts();
                        $("form").trigger("reset");
                        viewProfile();
                    }
                },
                error: function(e) {
                    console.log(e);
                }
            });
        }
    });
}


// Listar todos los productos asociados al usuario con la sesión iniciada.

function viewProducts() {
    $.ajax({
        url: "seller.php",
        method: "POST",
        data: { option: "viewProducts" },
        success: function(response) {
            response = $.parseJSON(response);
            if (response.status == "success") {
                //console.log(response.cards);
                $(".row.cards-products").html(response.cards);
            }
        }
    });
}

// Obtiene los datos de un producto en particular.

function getParticularProduct() {
    $(document).on("click", "#btnProdEdit", function() {
        let idProduct = $(this).attr("data-ProEdit");
        //console.log(idProduct);
        $.ajax({
            url: "seller.php",
            method: "POST",
            data: { idProduct: idProduct, option: "getParticularProduct" },
            dataType: "JSON",
            success: function(response) {

                if (response.status == "Hubo un problema") {
                    emptyFieldsOr("hubo un problema al buscar la información del producto.");
                }
                //console.log(idProduct);
                $("#idProdUpdate").val(idProduct);
                $("#productNameUpdate").val(response[0]);
                $("#productDescUpdate").val(response[1]);
                $("#productPriceUpdate").val(response[3]);

                $("#productUpdateModal").modal("show");
            }
        });
    });
}


// Actualización de la información relacionada a un determinado producto.

function updateProduct() {

    $(document).on("click", "#btnUpdateProduct", function() {

        let idProduct = $("#idProdUpdate").val();
        let productNameUpdate = $("#productNameUpdate").val();
        let productDescUpdate = $("#productDescUpdate").val();
        let productPriceUpdate = $("#productPriceUpdate").val();
        //console.log("Este es el ID del producto:", idProduct);

        let formData = new FormData();
        formData.append("idProduct", idProduct);
        formData.append("productNameUpdate", productNameUpdate);
        formData.append("productDescUpdate", productDescUpdate);
        formData.append("productPriceUpdate", productPriceUpdate);
        formData.append("productPhotoUpdate", $("#productPhotoUpdate")[0].files[0]);
        formData.append("option", "updateProduct");

        if (productNameUpdate == "" || productDescUpdate == "" || productPriceUpdate == "") {
            emptyFieldsOr("Campos vacíos");
        } else {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "No podrás revertir esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, actualízalo!'
            }).then((result) => {
                console.log(formData);

                if (result.isConfirmed) {
                    $.ajax({
                        url: "seller.php",
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            data = $.parseJSON(data);

                            if (data.status == "Producto actualizado") {
                                viewProducts();
                                $("#productUpdateModal").modal("hide");
                                goodNews("Excelente!", "Has actualizado la información de este producto.");
                            } else if (data.status == "Producto no actualizado") {
                                emptyFieldsOr("No se pudo actualizar la información de este producto.");
                            } else if (data.status == "Foto grande" || data.status == "Imagen no permitida") {
                                emptyFieldsOr("Revise que la imagen no sea demasiado grande < a 2 MB y cuente con una extensión tipo JPEG, JPG o PNG");
                            }
                            // else if (data.status == "Sin foto") {
                            //     emptyFieldsOr("No hay foto.");
                            // }
                        },
                        error: function(e) {
                            console.log(e);
                        }
                    });
                }
            });
        }
    });
}

// Eliminar el producto escogido.

function deleteProduct() {
    $(document).on("click", "#btnProdDel", function() {

        let idProduct = $(this).attr("data-ProDel");
        //alert(deleteId);

        Swal.fire({
            title: '¿En verdad quieres eliminar este producto?',
            text: "No podrás revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#d3085d6',
            confirmButtonText: 'Sí, elimínalo!'
        }).then((result) => {

            if (result.isConfirmed) {
                $.ajax({
                    url: "seller.php",
                    method: "POST",
                    data: { idProduct: idProduct, option: "deleteProduct" },
                    success: function(data) {
                        data = $.parseJSON(data);

                        if (data.status == "Eliminado") {
                            viewProducts();
                            goodNews("Perfecto!", "Has eliminado este producto.");
                        } else if (data.status == "Sin eliminar") {
                            emptyFieldsOr("No se pudo eliminar el producto seleccionado.");
                        }
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
            }
        });
    });
}

// Ver información del pefil.

function viewProfile() {
    $.ajax({
        url: "seller.php",
        method: "POST",
        data: { option: "viewProfile" },
        success: function(response) {
            response = $.parseJSON(response);
            //console.log(response.data_profile);
            $("#identityProfile").val(response.data_profile[0]);
            $("#nameProfile").val(response.data_profile[1]);
            $("#lastNameProfile").val(response.data_profile[2]);
            $("#photoProfile").attr("src", response.data_profile[3]);
            $("#emailProfile").val(response.data_profile[4]);
            $("#cityProfile").val(response.data_profile[5]);
        }
    });
}

// Actualizar información del perfil.

function updateProfile() {

    $(document).on("click", "#btnUpdateSellerProfile", function() {

        let identityProfile = $("#identityProfile").val();
        let nameProfile = $("#nameProfile").val();
        let lastNameProfile = $("#lastNameProfile").val();
        let emailProfile = $("#emailProfile").val();
        let cityProfile = $("#cityProfile").val();

        let formData = new FormData();
        formData.append("identityProfile", identityProfile);
        formData.append("nameProfile", nameProfile);
        formData.append("lastNameProfile", lastNameProfile);
        formData.append("emailProfile", emailProfile);
        formData.append("cityProfile", cityProfile);

        /* file: Lectura de la información de la foto a subir. */
        let file = $("input[name='photoProfile']").prop('files');
        formData.append("photoProfile", file[0]);
        formData.append("option", "updateProfile");


        if (identityProfile == "" || nameProfile == "" || lastNameProfile == "" || emailProfile == "" || cityProfile == "") {
            emptyFieldsOr("Revise que ningún campo esté vacío.");
        } else {
            Swal.fire({
                title: '¿Estás seguro de querer actualizar los datos de tu perfil?',
                text: "No podrás revertir esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, actualiza mi información personal!'
            }).then((result) => {
                console.log(formData);

                if (result.isConfirmed) {
                    $.ajax({
                        url: "seller.php",
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            data = $.parseJSON(data);
                            console.log(data);

                            if (data.status == "Perfil actualizado") {
                                $("form").trigger("reset");
                                viewProfile();
                                goodNews("Bien hecho!", "Has actualizado tu información personal sin problemas");
                            } else if (data.status == "Perfil no actualizado") {
                                emptyFieldsOr("No se pudo actualizar la información de este perfil.");
                            } else if (data.status == "Foto grande" || data.status == "Imagen no permitida") {
                                emptyFieldsOr("Revise que la imagen no sea demasiado grande < a 2 MB y cuente con una extensión tipo JPEG, JPG o PNG");
                            }
                        },
                        error: function(e) {
                            console.log(e);
                        }
                    });
                }
            });
        }
    });
}

/* 
    Funciones de mensajes de error y éxito. 
*/

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