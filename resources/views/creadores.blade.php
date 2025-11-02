<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen de Orden</title>
    @vite('resources/css/app.css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body class="h-screen">
    <x-top_bar/>
    <div class="h-full bg-color-bg flex flex-col justify-center items-center py-4">
        <h1 class="text-center text-white font-bold text-2xl my-5">CREADORES</h1>
        <div class="bg-color-secondary p-6 shadow-lg w-full max-w-2xl text-white rounded-2xl">
            <div class="flex">
                <img src="{{  asset('assets/banner_img.jpg') }}" alt="Imagen creador" class="w-32 h-32 mx-auto mb-4 rounded-full object-cover">
                <div class="flex flex-col justify-start flex-1 mx-6">
                    <h2 class="text-2xl font-bold text-start mb-4 max-md:text-xl">Alexis Daniel Castillo Nieto</h2>
                    <h2 class="text-2xl font-bold text-start mb-4 max-md:text-xl">CN20002</h2>    
                </div>
                
            </div>

            <p class="text-lg mb-4 max-md:text-base">Estudiante de Ingeniería de Sistemas Informáticos en la Universidad de El Salvador</p>
            <div class="text-center">
                <a href="/menu" class="px-4 py-2 bg-color-main text-white rounded-lg hover:bg-orange-400 font-bold">Volver al Menú</a>
            </div>
        </div>

    </div>
</body>