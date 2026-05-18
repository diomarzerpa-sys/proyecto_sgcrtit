<?php
$imageAbsolutePath = $_SERVER['DOCUMENT_ROOT'] . '/img/bannerubv.png';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memorándum - {{ $memo->nro_control }}</title>
    <style>
        @page {
            margin-top: 1.5in; /* Margen superior para TODAS las páginas */
            margin-bottom: 1in; /* Margen inferior para TODAS las páginas */
            margin-left: 1in;  /* Margen izquierdo para TODAS las páginas */
            margin-right: 1in; /* Margen derecho para TODAS las páginas */
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 10pt;
        }
        .container {
            padding: 10px;
            padding-bottom: 70px;
        }
        .header {
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 18pt;
        }
        .info-section {
            line-height: 1;
            border-bottom: 2px solid #333;
            margin-top: 0px;
        }
        .info-section strong {
            display: inline-block;
            width: 80px;
        }
        .content-section {
            margin-top: 10px;
            line-height: 1.5;
            text-align: justify;
            
        }
        .signature-section {
            margin-top: 50px;
            text-align: center;
        }
        .signature-line {
            border-top: 1px solid #000;
            width: 200px;
            margin: 30px auto 5px auto; /* This centers the line */
            padding-top: 5px;
        }
        /* --- Estilos para la imagen del banner superior --- */
        .header-image {
            position: fixed; /* Clave para que se repita en cada página */
            top: -80px; /* Lo fija en la parte superior */
            left: 0;
            width: 100%;
            display: block;
            z-index: 1000; /* Asegura que esté por encima de otros elementos */
        }
        .header-image img {
            width: 100%; /* La imagen ocupará todo el ancho del div */
            display: block; /* Elimina espacio extra debajo de la imagen */
        }

        /* Script para el contador de páginas - Esto es un poco más complejo en Dompdf */
        /* Se suele usar JavaScript para esto */
        .page-number:after {
            content: counter(page);
        }
    </style>
</head>
<body>
    <div class="header-image">
        <img src="{{public_path('img/bannerubvll.png')}}" alt="Banner UBV">
    </div>
    <div class="container">
        <div>
            <h4>{{$memo->nro_control}}</h4>
        </div>

        <div class="header">
            <h1>MEMORÁNDUM</h1>
        </div>

        <div class="info-section">
            <p><strong>Para:</strong> 
                @if ($memo->addressed_to)
                                {{$memo->addressed_to}}</br>
                                @foreach ($memo->departments as $item)
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {{$item->manager->staff->name." - ".$item->name}}</br>
                                @endforeach
                            @else
                                @foreach ($memo->departments as $index => $item)
                                    @if($index > 0)
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    @endif
                                        {{$item->manager->staff->name." - ".$item->name}}
                                    @if(!$loop->last)
                                        <br> 
                                    @endif
                                @endforeach
                            @endif
                        </p>
            <p><strong>De:</strong>{{ $memo->user->name}}</p>
            <p><strong>Fecha:</strong> {{$memo->date_created->format('d-m-Y')}}</p>
            <p><strong>Asunto:</strong> {{$memo->title}}</p>
        </div>

        <div class="content-section">
            <p>{!!$memo->content!!}</p>
            <p>Agradecemos su atención y pronta acción con respecto a este memorándum.</p>
        </div>

        <div class="signature-section">
            <p>Atentamente,</p>
            <br>
            <br>
            <div class="signature-line"></div>
            <p><strong>{{ $staff->name." ".$staff->last_name }}</strong></p>
            <p><strong>{{ $staff->document_id }}</strong></p>
        </div>

        {{-- Script para el contador de páginas y pies de página repetidos --}}
       <script type="text/php">
    if (isset($pdf)) {
        // Obtener el ancho de la página correctamente
        $page_width = $pdf->get_width(); // Usar get_width() en el objeto $pdf directamente

        $y_start = 750; // Posición Y inicial para la primera línea (desde abajo de la página, ajusta si es necesario)
        $line_height = 12; // Ajusta este valor (en puntos) según el tamaño de tu fuente y el interlineado deseado

        $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
        $size = 8;
        $color = array(0,0,0);

        // Definir tus líneas de texto
        $lineas = [
            "Universidad Bolivariana de Venezuela",
            "Eje Geopolítico Regional Kerepakupai Vená",
            "Av. Germania con Calle Andrés Bello, Edif. UBV. Antiguo Edif. CVG,",
            "Ciudad Bolívar, Estado Bolívar",
            "",
            "Página {PAGE_NUM} de {PAGE_COUNT}" // Dompdf reemplazará {PAGE_NUM} y {PAGE_COUNT} automáticamente
        ];

        // Iterar sobre cada línea para calcular su posición y dibujarla
        foreach ($lineas as $index => $linea) {
            // Reemplazar {PAGE_NUM} y {PAGE_COUNT} para el CÁLCULO del ancho
            // Es crucial para que la línea de paginación se centre correctamente.
            // Asumiremos números que capturen el ancho máximo, e.g., "100 de 100".
            $linea_para_ancho = str_replace(['{PAGE_NUM}', '{PAGE_COUNT}'], ['100', '100'], $linea);

            // Calcular el ancho del texto
            $text_width = $fontMetrics->get_text_width($linea_para_ancho, $font, $size);

            // Calcular la posición X para centrar el texto
            // (Ancho de la página / 2) - (Ancho del texto / 2)
            $x_centered = ($page_width / 2) - ($text_width / 2);

            // Calcular la posición Y para la línea actual
            // Multiplicamos por el índice para mover cada línea hacia abajo
            $y_current = $y_start + ($line_height * $index);

            // Dibujar el texto
            $pdf->page_text($x_centered, $y_current, $linea, $font, $size, $color);
        }
    }
</script>
    </div>
</body>
</html>