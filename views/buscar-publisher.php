<?php

require_once '../models/Publisher.php';
?>
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
    <div>
      <table id="tabla">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Race</th>
            <th></th>
          </tr>
        </thead >
        <tbody id="heroesTable">

        </tbody>
      </table>
    </div>
    <script>
      document.addEventListener("DOMContentLoaded", ()=>{
        function $(id) {return document.querySelector(id)}

        (function(){
          fetch(`../controllers/Publisher.controller.php?operacion=listar`)
            .then(respuesta => respuesta.json())
            .then(datos=>{
              datos.forEach(element => {
                const tagOption = document.createElement("option")
                tagOption.value = element.id
                tagOption.innerHTML = element.publisher_name
                $("#publisher").appendChild(tagOption)
              });
            })
            .catch(e=>{
              console.error(e)})
        })()

        const listarSuperheroes = () =>{
          const parametros = new FormData()
          parametros.append("operacion", "listar")
          parametros.append("operacion", "DC Comics")

          fetch(`../controllers/Publisher.controller.php?`,{
            method: 'POST',
            body: parametros
          })
            .then(respuesta => respuesta.json())
            .then(datos =>{
              datos.forEach(element => {
                const row = document.createElement("tr")

                Object.values(element).forEach(value =>{
                  const data = document.createElement("td")
                  data.innerHTML = value;
                  row.appendChild(data);
                });
                $("#heroesTable").appendChild(row)
              });
            })
            .catch()
        }

        $("#publisher").addEventListener("change", (event)=>{
            listarSuperheroes()
        })
      })
    </script>
  </body>
</html>
