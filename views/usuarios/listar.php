<!doctype html>
<html lang="es">

<head>
  <title>Usuarios Listar</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  
    <div class="container mt-3">
      <div class="alert alert-dark" role="alert">
        <h4> APP REGISTER</h4>
        <div>Lista Usuarios</div>
      </div>
    

    <table class="table table-sm table-striped table-hover" id="tabla-usuarios">
      <colgroup>
        <col width="5%">  <!-- # -->
        <col width="17%">   <!-- nombres  -->
        <col width="15%">   <!-- apellidos -->
        <col width="15%">   <!-- nacionalidad -->
        <col width="15%">   <!-- rol -->
        <col width="10%">   <!-- avatar -->
        <col width="18%"> <!-- Comandos -->
      </colgroup>

      <thead>
        <tr>
          <th>#</th>
          <th>Nombres</th>
          <th>Apellidos</th>
          <th>Nacionalidad</th>
          <th>Nivel Acceso</th>
          <th>Avatar</th>
          <th>Comandos</th>
        </tr>
      </thead>

      <tbody>
         <!-- Datos Asincronos -->
      </tbody>
      
    </table>
    </div>  <!-- DEL CONTAINER -->

  <!--Zona modales-->
  <div class="modal fade" id="modal-visor" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info text-light">
          <h5 class="modal-title" id="modal-title">Nombre del Producto <strong id="${registro.nombres}" style="font-size: 20px;"> </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img style="width: 50%; " src="" id="visor" alt="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
  <!--Fin xona modales-->

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {

      // Este objeto referencia a nuestra tabla HTML
      const tabla = document.querySelector("#tabla-usuarios tbody");  //contenido de la tabla
      const modalVisor = new bootstrap.Modal(document.getElementById('modal-visor'))

      // Comunicandonos al Controlador
      // Renderizamos TABLA > tbody
      function listarUsuarios(){
        const parametros = new FormData();
        parametros.append("operacion", "listar")  // NO OLVIDAR : key - value
        
        fetch(`../../controllers/usuario.controller.php`, {
          method: 'POST', 
          body: parametros
        })
          .then(respuesta => respuesta.json())
          .then(datosRecibidos => {
            let numFila = 1;
            tabla.innerHTML = '';

            datosRecibidos.forEach(registro => {
              let nuevafila = ``;
              // Enviar los valores obtenidos en celdas <td></td>
              nuevafila = `
                <tr>
                  <td>${numFila}</td>
                  <td>${registro.nombres}</td>
                  <td>${registro.apellidos}</td>
                  <td>${registro.nombre_pais}</td>
                  <td>${registro.rol}</td>
                  <td>
                    <a href='#' class='linkFoto' data-descripcion="${registro.descripcion}" data-url="${registro.avatar}">Ver</a>  
                  </td>
                  <td>
                    <button type="button" data-idusuario="${registro.idusuario}" class="btn btn-danger btn-sm eliminar">Eliminar</button>
                    <button type="button" class="btn btn-warning btn-sm editar">Editar</button>                                        
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

      tabla.addEventListener("click", (event)=>{
        if(event.target.classList.contains("linkFoto")){
          const ruta = event.target.dataset.url;
          const descripcion = event.target.dataset.descripcion;
          document.querySelector("#visor").setAttribute("src",`../../images/${ruta}`);
          document.querySelector("#modal-title").innerHTML = descripcion;
          modalVisor.toggle();
        } 
         
        if(event.target.classList.contains("eliminar")){
          const idusuario = event.target.dataset.idusuario;
          const parametros = new FormData();
          parametros.append("operacion", "eliminar");
          parametros.append("idusuario", idusuario);
          console.log(idusuario);
          
          // pregunta de ELIMINACIÓN
          if(confirm("¿Estás seguro de eliminar al usuario?")){
            fetch(`../../controllers/usuario.controller.php`, {
              method: "POST",
              body: parametros
            })
              .then(respuesta => respuesta.text())
              .then(datos => {
                console.log(datos);
                listarUsuarios();
              })
              .catch(e => {
                console.error(e)
              });
          }
        }

      
      });
      
      listarUsuarios();
    
    });
  </script>
</body>
</html>