<!doctype html>
<html lang="es">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <div class="container">
      <div class="alert alert-info mt-3">
        <div class="mb-3">
          <label for="publisher" class="form-label"></label>
          <select  name="publisher" id="publisher" class="form-select" required>
            <option value="">Seleccione</option>
          </select>
        </div>
      </div>
    </div>
    <div class="container table table-striped" style="position: relative; text-align: center; left: 300px;">
      <table id="tabla">
        <thead>
          <tr>
            <th style="width: 50px;">Id</th>
            <th style="width: 150px;">Distribuidora</th>
            <th style="width: 100px;">SuperHeroe</th>
            <th style="width: 150px;">fullName</th>
            <th style="width: 100px;">Genero</th>
            <th style="width: 100px;">Raza</th>
          </tr>
        </thead >
        <tbody id="tablaHeroes">

        </tbody>
      </table>
    </div>
    <script>
      document.addEventListener("DOMContentLoaded", ()=>{
        function $(id) {return document.querySelector(id)}

        (function(){
          fetch(`../controllers/Publisher.controller.php?operacion=listar`)
            .then(respuesta=>respuesta.json())
            .then(datos=>{
              datos.forEach(element => {
                const tagOption = document.createElement("option")
                tagOption.value = element.publisher_name
                tagOption.innerHTML = element.publisher_name
                $("#publisher").appendChild(tagOption)
              });
            })
            .catch(e=>{
              console.error(e)})
        })();
        
        function buscar(){
          const publisher = $("#publisher").value
          const parametros = new FormData()

          parametros.append("operacion", "searchPublisher")
          parametros.append("publishername", publisher)

          fetch(`../controllers/Publisher.controller.php`,{
            method: "POST",
            body: parametros
          })
          .then(respuesta=>respuesta.json())
          .then(datos=>{
            //console.log(datos)
            datos.forEach(data => {
              const row = document.createElement("tr")

              Object.values(data).forEach(dato=>{
                const datoSuper = document.createElement("td")
                datoSuper.innerHTML=dato
                row.appendChild(datoSuper)
              });
              $("#tablaHeroes").appendChild(row)
            });

          })
          .catch()
        }
        function limpiar(){
          document.querySelector("#tablaHeroes").innerHTML=""
        }
        
        $("#publisher").addEventListener("change",(event)=>{

            buscar();
            if($("#tablaHeroes")!=""){
              setTimeout(limpiar, 0)
            }
            
        })
        
          


      })
    </script>
  </body>
</html>
