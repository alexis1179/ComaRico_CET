<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Orden Finalizada</title>
    @vite(['resources/css/app.css'])
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <x-top_bar></x-top_bar>
    <div class="bg-color-bg p-4 h-screen text-white">
        <div class="rounded-lg shadow-lg bg-color-secondary p-6 max-w-4xl mx-auto flex flex-col items-center">
            <h2 class="text-3xl font-bold text-center">¡Tu orden ha sido finalizada!</h2>

            <p class="text-xl text-center my-5">Gracias por tu pedido. Podés descargar el resumen en PDF aquí:</p>

            <a href="{{ route('orden.descargarPDF', $orden->id) }}" target="_blank">
                <button type="button" class="p-4 my-4 rounded-lg bg-color-main hover:bg-orange-400 text-lg font-bold">Descargar orden (PDF)</button>
            </a>

            <a href="/menu" class="my-5 underline text-lg hover:text-color-main">Volver al menú</a>
        </div>

    </div>
</body>
</html>
