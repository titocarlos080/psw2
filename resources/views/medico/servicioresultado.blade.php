@extends('layouts.app')

@section('title', 'IA Online')

@section('content')
<section class="mt-5">
    <div class="container-fluid bg-white">
        <div class="row" style="height: 100vh;">

            <!-- Columna central de tamaño 6: Imagen SVG y resultado -->
            <div class="col-lg-6 d-flex align-items-center justify-content-center">
                <div class="card border-light w-100">
                    <div class="card-header text-center bg-primary text-white">
                        <h5 class="card-title mb-0">Resultado de Análisis</h5>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <svg id="mySVG" width="90%" height="90%" viewBox="0 0 757 647">
                            <!-- Muestra la imagen en el SVG sin añadirla de nuevo en el script -->
                            <image xlink:href="{{ $base64Imagepasar }}" width="100%" height="100%" preserveAspectRatio="xMidYMid meet" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Columna de tamaño 4: Predicciones de IA -->
            <div class="col-lg-4">
                <div class="card border-light h-100">
                    <div class="card-header text-center bg-primary text-white">
                        <h6>Predicciones de IA</h6>
                    </div>
                    <div class="card-body overflow-auto text-dark">
                        @if (isset($dataApi) && !empty($dataApi->predictions))
                            <ul class="list-group list-group-flush">
                                @foreach ($dataApi->predictions as $prediction)
                                    <li class="list-group-item">
                                        <strong>Confianza:</strong> {{ $prediction->confidence }}<br>
                                        <strong>Clase:</strong> {{ $prediction->class }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-center mt-3">No hay predicciones disponibles</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var dataApi = @json($dataApi);
        var svg = d3.select("#mySVG");
        
        // Establece las dimensiones de la imagen, pero evita volver a añadir la imagen
        svg.attr("width", dataApi.image.width)
            .attr("height", dataApi.image.height);

        const predictions = dataApi.predictions;

        predictions.forEach(function(prediction) {
            var centerXProp = prediction.x / dataApi.image.width;
            var centerYProp = prediction.y / dataApi.image.height;
            var rectWidthProp = prediction.width / dataApi.image.width;
            var rectHeightProp = prediction.height / dataApi.image.height;

            var randomColor = getRandomColor();

            // Agrega el rectángulo encima de la imagen
            svg.append("rect")
                .attr("x", (centerXProp - rectWidthProp / 2) * 100 + "%")
                .attr("y", (centerYProp - rectHeightProp / 2) * 100 + "%")
                .attr("width", rectWidthProp * 100 + "%")
                .attr("height", rectHeightProp * 100 + "%")
                .style("stroke", randomColor)
                .style("stroke-width", "3")
                .style("fill", "none");

            var text = prediction.class;
            var padding = 8;
            var fontSize = 12;

            var textElement = svg.append("text")
                .attr("x", (centerXProp - rectWidthProp / 2) * 100 + "%")
                .attr("y", (centerYProp - rectHeightProp / 2) * 100 + "%")
                .text(text)
                .style("font-size", fontSize + "px")
                .style("fill", "white");

            var bbox = textElement.node().getBBox();

            svg.insert("rect", "text")
                .attr("x", bbox.x - padding)
                .attr("y", bbox.y - padding)
                .attr("width", bbox.width + 2 * padding)
                .attr("height", bbox.height + 2 * padding)
                .style("fill", randomColor);

            textElement.raise();
        });
    });

    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
</script>
