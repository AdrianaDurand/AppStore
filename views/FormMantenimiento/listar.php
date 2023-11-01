<!doctype html>
<html lang="en">

<head>
  <title>LISTAR / FM</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  
<body>

  <div class="container mt-3">
    <div class="alert alert-info" role="alert">
      <h4>FORM MANTENIMIENTO</h4>
      <div>Lista de Características</div>
    </div>
    
    <table class="table table-sm table-striped" id="tabla-formmantenimiento">
    <colgroup>
        <col width="5%">  <!-- # -->
        <col width="35%"> <!-- Producto -->
        <col width="20%"> <!-- Campo -->
        <col width="20%"> <!-- Valor -->
        <col width="20%"> <!-- Comandos -->
      </colgroup>
      <thead>
        <tr>
          <th>#</th>
          <th>Producto</th>
          <th>Campo</th>
          <th>Valor</th>
          <th>Comandos</th>
        </tr>
      </thead>
      <tbody>
          <!-- DATOS CARGADOS DE FORMA ASINCRONA -->
      </tbody>
    </table>


  </div> <!--./contanier-->


  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

<script>

    document.addEventListener("DOMContentLoaded", () => {
        const tabla = document.querySelector("#tabla-formmantenimiento tbody");

        function listarFormMantenimiento(){
        const parametros = new FormData();
        parametros.append("operacion", "listar")

        fetch(`../../controllers/FormMantenimiento.controller.php` ,{
            method: 'POST',
            body: parametros
        })
        .then(respuesta => respuesta.json())
        .then(datosRecibidos => {
            let numFila = 1;
            tabla.innerHTML= '';

        datosRecibidos.forEach(registro => {
            let numfila = ``;

            nuevafila = `
              <tr>
                <td>${numFila}</td>
                <td>${registro.descripcion}</td>
                <td>${registro.clave}</td>
                <td>${registro.valor}</td>
                <td>
                  <button data-idproducto="${registro.idespecificacion}" class='btn btn-danger btn-sm eliminar' type='button'>Eliminar</button>
                  <button data-idproducto="${registro.idespecificacion}" class='btn btn-warning btn-sm editar' type='button'>Editar</button>
                </td>
              </tr>
              `;

              tabla.innerHTML += nuevafila;
              numFila++;

        });
        })
        .catch(e => {
            console.error(e)
          })
    }

    listarFormMantenimiento();
    });
    
</script>

</html>