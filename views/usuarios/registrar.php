<!doctype html>
<html lang="es">

<head>
  <title>Registrar Usuarios</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
<div class="container mt-3">
  <div class="card">
    <div class="card-header bg-dark text-light">
      Registro de Usuarios
    </div>
    <div class="card-body">
    <form action="ruta/al/controlador.php" method="post" autocomplete="off" id="form-usuario">
    <div class ="row">
          <div class="col-md-6">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" class="form-control text-end" id="nombres" name="nombres" required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text" class="form-control text-end" id="apellidos" name="apellidos" required>
          </div>
    </div>

    <div class="row">
    <div class="col-md-6 mb-3">
        <label for="rol" class="form-label">Nivel Acceso</label>
        <select id="rol" name="rol" class="form-select" required>
          <option value="">Seleccione:</option>
        </select>
      </div>

      <div class="col-md-6 mb-3">
        <label for="nacionalidad" class="form-label">Nacionalidad</label>
        <select id="nacionalidad" name="nacionalidad" class="form-select" required>
          <option value="">Seleccione:</option>
        </select>
      </div>
    </div>

    
    <div class ="row">
          <div class="col-md-6">
            <label for="email" class="form-label">E-mail</label>
            <input type="text" class="form-control text-end" id="email" name="email" required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="clave_acceso" class="form-label">Clave de Acceso</label>
            <input type="password" class="form-control text-end" id="clave_acceso" name="clave_acceso" required>
          </div>
    </div>

    <div class="mb-3">
        <label for="avatar" class="form-label">Seleccione su Avatar</label>
        <input type="file" class="form-control" id="avatar" name="avatar" accept=".jpg">
    </div>

    </div>
    <div class="card-footer text-end">
      <button class="btn btn-warning btn-sm" type="submit" id="guardar">Guardar</button>
    </div>
  </div>
</form>
</div>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      function $(id){
        return document.querySelector(id);
      }

      function getRol(){

        const parametros = new FormData();
        parametros.append("operacion", "listar");

        fetch(`../../controllers/rol.controller.php`, {
            method: "POST",
            body: parametros
          })
            .then(respuesta => respuesta.json())
            .then(datos => {
              // Operaciones en proceso ... (renderizar los options en <select>)
              datos.forEach(element => {
                const tagOptionRol = document.createElement("option");
                tagOptionRol.value = element.idrol;
                tagOptionRol.innerHTML = element.rol;
                $("#rol").appendChild(tagOptionRol);

              });
            })
            .catch(e => {
              console.error(e);
            });
      }

        function getNacion(){

        const parametros = new FormData();
        parametros.append("operacion", "listar");

        fetch(`../../controllers/nacion.controller.php`, {
            method: "POST",
            body: parametros
          })
            .then(respuesta => respuesta.json())
            .then(datos => {
              // Operaciones en proceso ... (renderizar los options en <select>)
              datos.forEach(element => {
                const tagOptionNacionalidad = document.createElement("option");
                tagOptionNacionalidad.value = element.idnacionalidad;
                tagOptionNacionalidad.innerHTML = element.nombre_pais;
                $("#nacionalidad").appendChild(tagOptionNacionalidad);
              });
            })
            .catch(e => {
              console.error(e);
            });
        }

          function usuarioRegister() {
            const parametros = new FormData();
            parametros.append("operacion", "registrar");
            parametros.append("idrol", $("#rol").value);
            parametros.append("idnacionalidad", $("#nacionalidad").value);
            parametros.append("apellidos", $("#apellidos").value);
            parametros.append("nombres", $("#nombres").value);
            parametros.append("email", $("#email").value);
            parametros.append("clave_acceso", $("#clave_acceso").value);
            parametros.append("avatar", $("#avatar").files[0]);

            fetch(`../../controllers/usuario.controller.php`, {
              method: "POST",
              body: parametros
            })
            
            .then(respuesta => respuesta.json())
            .then(datos => {
                if (datos.idusuario > 0) {
                  alert(`Usuario registrado con ID: ${datos.idusuario}`)
                  $("#form-usuario").reset();
                }
              })
              .catch(e => {
                console.error(e);
              });
          }

          $("#form-usuario").addEventListener("submit", (event) => {
            event.preventDefault();
            if (confirm("¿Está seguro de guardar?")) {
              usuarioRegister();
            }
          });

          getRol();
          getNacion();
        })
  </script>
</body>
</html>
