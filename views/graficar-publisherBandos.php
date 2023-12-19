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
        <div style="width: 70%; margin: auto; position:relative; left: 20px">
        <!-- Canvas = lienzo = obra de arte -->
        <canvas id="lienzo"></canvas>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", ()=>{
                function $(id){ return document.querySelector(id)}

                (function(){
                    fetch(`../controllers/Publisher.controller.php?operacion=listar`)
                        .then(respuesta=>respuesta.json())
                        .then(datos=>{
                            datos.forEach(data => {
                                const TagOption = document.createElement("option")
                                TagOption.value = data.publisher_name
                                TagOption.innerHTML = data.publisher_name
                                $("#publisher").appendChild(TagOption)
                            });
                        })
                        .catch(e=>{console.error(e)})
                })();

                const contexto = document.querySelector("#lienzo")
                const grafico = new Chart(contexto, {
                    type: 'bar',
                    data: {
                        labels: [],
                        datasets:[{
                            label: "Cantidad de bandos por Publisher",
                            data: []
                        }]
                    }
                });

                function buscar(){
                    const publisher = document.querySelector("#publisher").value
                    const parametros = new FormData()

                    parametros.append("operacion", "graficarBandosPublisher")
                    parametros.append("publishname", publisher)

                    fetch(`../controllers/Publisher.controller.php`, {
                        method: "POST",
                        body: parametros
                    })
                        .then(respuesta=>respuesta.json())
                        .then(datos=>{
                            console.log(datos)
                            grafico.data.labels = datos.map(valor=>valor.alignment)
                            grafico.data.datasets[0].data = datos.map(valor=>valor.total)
                            grafico.update()
                        })
                        .catch(e=>{console.error(e)})
                };

                $("#publisher").addEventListener("change",()=>{
                    buscar()
                })
            })




        </script>
    </body>
</html>
