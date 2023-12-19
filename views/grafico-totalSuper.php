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
        <div class="container" style="width: 300px; position:relative; right: 450px">
            <div class="alert alert-info mt-3">
                <div class="mb-3" >
                    <label for="publisher" class="form-label"></label>
                    <select  name="publisher" id="publisher" class="form-select" required>
                        <option value="">Seleccione</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="container" style="padding-top: 20px;">
            <button type="button" id="aumentar" class="btn btn-success">+</button>
            <button type="button" id="restar" class="btn btn-danger">-</button>
        </div>
        <div style="width: 70%; margin: auto">
      <!-- Canvas = lienzo = obra de arte -->
            <canvas id="lienzo"></canvas>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", ()=>{
                function $(id){return document.querySelector(id)}

                (function(){
                    fetch(`../controllers/Publisher.controller.php?operacion=listar`)
                        .then(respuesta=>respuesta.json())
                        .then(datos=>{
                            datos.forEach(element => {
                                const tag = document.createElement("option")
                                tag.value = element.publisher_name
                                tag.innerHTML = element.publisher_name
                                $("#publisher").appendChild(tag)

                            });
                        })
                        .catch(e=>{console.error(e)})
                })()

                const contexto = document.querySelector("#lienzo")
                const grafico = new Chart(contexto, {
                    type: 'pie',
                    data: {
                        labels: [],
                        datasets: [{
                            label: "Cantidad de Super Heroes por Publisher",
                            data: []
                        }],
                        datasets:[{
                            label: "Cantidad de Super Heroes por Publisher2",
                            data: []
                        }]
                    }
                });


                function mostrar(){
                    const publisher = document.querySelector("#publisher").value
                    const parametros = new FormData()

                    parametros.append("operacion", "cantsuperPublisher")
                    parametros.append("totalsuper", $("#publisher").value)

                    fetch(`../controllers/Publisher.controller.php`, {
                        method: "POST",
                        body: parametros
                    })
                        .then(respuesta=>respuesta.json())
                        .then(value=>{
                            console.log(value)                           
                            grafico.data.labels = value.map(valor=>valor.publisher)
                            grafico.data.datasets[0].data = value.map(valor=>valor.total)
                            grafico.update()
                            //contador de click en datasets
                        })
                        .catch(e=>{console.error(e)})
                };

                document.querySelector("#publisher").addEventListener("change", ()=>{
                    mostrar();
                })


            });

        </script>
    </body>
</html>
