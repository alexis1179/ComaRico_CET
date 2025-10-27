<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menú de Platillos</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-color-bg">
    <x-top_bar/>
    <div class="shadow-lg bg-banner_img bg-center bg-no-repeat w-full h-screen relative">
        <div class="absolute bg-black opacity-50 w-full h-full z-0"></div>
        <div class="flex flex-col items-center justify-center h-full text-white z-50 pb-20 relative">
            <h1 class="text-5xl font-bold mb-4">Rápido, delicioso y sin esperas</h1>
            <p class="text-lg">Explora nuestra deliciosa selección de platillos</p>
        </div>
    </div>
    <h1 class="text-4xl font-bold text-center text-white my-5">Menú</h1>
    <section id="menu" class="p-4 h-content w-full flex flex-col">
        <div class="text-white p-4 my-4 w-full h-fit bg-color-bg top-20">
            <form action="{{ route('menu.filtrar') }}" method="GET"" class="flex flex-wrap w-fit mx-auto">
                @foreach ($categorias as $categoria)
                <div class="rounded-full bg-orange-200 m-1 p-2 items-center h-max max-w-3xl">
                    <input type="checkbox" name="categoria[]" value="{{ $categoria }}"
                    
                    @if(isset($categoriaSelecc) && in_array($categoria, $categoriaSelecc)) 
                        checked="true" 
                    @endif
                    
                    class="checked:bg-color-main"/>
                    <label class="uppercase text-orange-800">{{ $categoria }}</label>
                </div>  
                @endforeach
                <div class="mx-4">
                    <h3 class="font-bold uppercase text-center">Rango de Precios</h3>
                    <div class="flex items-center gap-3">
                        <label for="rangoPrecio" class="text-sm">${{ $minPrecio }}</label>
                        <input type="hidden" name="minPrecio" value="{{ $minPrecio }}">
                        <input id="rangoPrecio" type="range" name="rangoPrecio" value="{{ request('rangoPrecio', $maxPrecio) }}" min="{{ $minPrecio }}" max="{{ $maxPrecio }}" step="0.01" class="accent-color-main flex-1" aria-describedby="rangoPrecioValue" />
                        <label for="rangoPrecio" class="text-sm">${{ $maxPrecio }}</label>
                    </div>
                    <div class="w-full text-center">
                        <span id="rangoPrecioValue" aria-live="polite" class="font-bold">${{ request('rangoPrecio', $maxPrecio) }}</span>
                    </div>
                    <button type="submit" class="mt-4 p-1 w-full text-white rounded-lg bg-color-main hover:bg-orange-500">Filtrar</button>
                </div>

                
            </form>
        </div>
        <div class="rounded-lg shadow-l mt-8 w-full">
            <form action="{{ route('orden.enviar') }}" method="POST" class="flex flex-col items-center">
                @csrf
               <div class="flex justify-center flex-wrap text-white">
                @foreach ($platillos as $platillo)
                    <div class="bg-color-secondary w-64 mx-4 my-4 flex flex-col">
                        <img src="{{ asset('platillos/' . $platillo->img) }}" alt="Imágen de {{ $platillo->nombre }}" class="w-full h-52 object-cover mr-4">
                        <div class="flex-1 flex py-6 px-3 w-full">
                            <div class="flex-1">
                                <h5 class="font-bold">{{ $platillo->nombre }}</h3>
                                <p class="text-ellipsis">{{ $platillo->descripcion }}</p>
                            </div>
                            <div class="mx-1">
                                <div class="text-2xl font-bold text-right">${{ $platillo->precio }}</div>
                                <input type="number" name="platillos[{{ $platillo->id }}]" min="0" max="{{ $platillo->cantidad }}" value="0"
                                class="w-12 border border-gray-500 rounded-lg px-2 py-1 text-center text-color-secondary focus:border-orange-500 outline-none">
                            </div>
                        </div>
                    </div>
                @endforeach

                </div>

                <button type="submit" class="p-4 mx-auto text-white rounded-lg bg-color-main hover:bg-orange-400">Enviar Orden</button>
            </form>
        </div>
    </section>
    <x-footer/>
</body>
</html>

<script>
    (function(){
        const rango = document.getElementById('rangoPrecio');
        const salida = document.getElementById('rangoPrecioValue');
        if(rango && salida){
            // formatea el número con separador de miles si quieres
            const format = (v) => '$' + Number(v).toLocaleString();
            // actualizar al mover
            rango.addEventListener('input', function(e){
                salida.textContent = '$' + Number(e.target.value).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            });
            // asegurar valor inicial
            salida.textContent = format(rango.value);
        }
    })();
</script>
