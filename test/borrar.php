<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selector de Productos</title>
</head>
<body>
    <label for="productSelector">Selecciona un producto:</label>
    <select id="productSelector">
        <option value="producto1">Producto 1</option>
        <option value="producto2">Producto 2</option>
        <option value="producto3">Producto 3</option>
    </select>

    <div id="productCards"></div>

    <script src="script.js"></script>
</body>
</html>



<div class="container mt-3">
    <div class="alert alert-warning" role="alert">
        <strong>APP STORE</strong>
        <br> Catálogo de Productos
    </div>

    <select class="form-select" aria-label="Default select example" id="selector">
        <option selected>Seleccione:</option>
    </select>

    <hr>
    <div class="row" id="cardproductos">
        <!-- Aquí se mostrarán las tarjetas de productos -->
    </div>
</div>





<script>
  document.addEventListener("DOMContentLoaded", () => {
    function $(id) {
        return document.querySelector(id);
    }

    function getCategorias() {
        // Tu código para obtener las categorías desde la base de datos (ya lo tienes).
    }

    function getProductosPorCategoria(idCategoria) {
        // Realiza una solicitud al servidor para obtener productos relacionados con la categoría.
        const parametros = new FormData();
        parametros.append("operacion", "listarProductosPorCategoria");
        parametros.append("idCategoria", idCategoria);

        fetch("../../controllers/producto.controller.php", {
            method: "POST",
            body: parametros
        })
            .then(respuesta => respuesta.json())
            .then(data => {
                const cardProductosElement = document.getElementById("cardproductos");
                cardProductosElement.innerHTML = ""; // Limpiar el contenedor de tarjetas

                data.forEach(producto => {
                    const cardDiv = document.createElement("div");
                    cardDiv.className = "card";
                    cardDiv.style = "width: 15rem;";

                    // Crear el contenido de la tarjeta con información del producto
                    cardDiv.innerHTML = `
                        <img class="card-img-top" src="${producto.imagen}" alt="${producto.nombre}">
                        <hr>
                        <div class="card-body">
                            <h5 class="card-title">${producto.nombre}</h5>
                            <hr>
                            <p class="card-text">${producto.descripcion}</p>
                            <a href="#" class="btn btn-primary">Comprar</a>
                        </div>
                    `;

                    cardProductosElement.appendChild(cardDiv);
                });
            })
            .catch(error => {
                console.log(error);
            });
    }

    // Agregar un evento de cambio al select
    const selectElement = document.getElementById("selector");
    selectElement.addEventListener('change', () => {
        const selectedCategoryId = selectElement.value;
        if (selectedCategoryId !== 'Seleccione:') {
            getProductosPorCategoria(selectedCategoryId);
        }
    });

    // Llamando
    getCategorias();
});

</script>

