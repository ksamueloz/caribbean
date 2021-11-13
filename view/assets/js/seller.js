$(document).ready(function() {

    // LLamado a las funciones para el CRUD de productos por un vendedor.
    insertProduct();
    viewProducts();

});

/*

    Funciones necesarias para el CRUD de productos por los Vendedores por parte de un Administrador.

*/
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
                    }
                },
                error: function(e) {
                    console.log(e);
                }
            });
        }
    });
}

function viewProducts() {
    console.log("Visualización de productos");
}

/* 
    Funciones de mensajes de error y exito. 
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