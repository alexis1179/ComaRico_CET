<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perfil de usuario</title>
    @vite('resources/css/app.css')
</head>
<body class="h-screen">
    <x-top_bar/>
    <x-side_barCliente/>
    <div class="bg-color-bg text-white p-4 h-full flex justify-center max-md:flex-wrap max-md:flex-col-reverse">
        {{-- Historial de órdenes --}}
        <div class="rounded-lg shadow-lg bg-color-secondary p-6 mr-5 max-w-4xl flex-1 h-fit flex flex-col items-center
         max-md:overflow-scroll max-md:w-full max-md:my-4">
            <h1 class="text-2xl font-bold text-center uppercase max-md:text-lg">Historial de Órdenes</h1>
            <table class="w-full border-collapse my-4">
                <thead>
                    <tr class="bg-slate-700">
                        <th class="px-4 py-4"># Orden</th>
                        <th class="px-4 py-4">Fecha</th>
                        <th class="px-4 py-4">Total</th>
                        <th class="px-4 py-4">Estado</th>
                        <th class="px-4 py-4">Platillos</th>
                    </tr>
                </thead>
                <tbody>
                    @php $count = 1 @endphp
                    @forelse($ordenes as $order)
                        <tr class="text-center hover:bg-slate-700
                        @if ($count % 2 == 0) bg-color-bg @endif">
                            <td class="px-4 py-4">{{ $order->id }}</td>
                            <td class="px-4 py-4">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-4">${{ number_format($order->total, 2) }}</td>
                            <td class="px-4 py-4 uppercase">{{ $order->estado }}</td>
                            <td class="px-4 py-4 text-left">
                                <ul>
                                @foreach ($order->platillosVista as $platillo)
                                    <li>{{ $platillo->nombre }}<strong class="mx-2">({{ $platillo->cantidad }})</strong></li>
                                @endforeach
                                <!--<a href="" class="btn btn-sm btn-primary">Ver Detalles</a>-->
                                </ul>
                            </td>
                        </tr>
                        @php $count++ @endphp
                    @empty
                        <tr>
                            <td colspan="5">No tienes órdenes registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <a href="/menu" class="p-4 text-white rounded-lg bg-color-main hover:bg-orange-500 font-bold">Regresar a Inicio</a>
        </div>

        {{-- Detalles del usuario --}}
        <div class="shadow-lg bg-color-secondary rounded-lg mr-5 p-4 w-fit max-h-fit">
            <div class="">
                <div class="font-bold uppercase mb-2 text-center">
                    <h5>Detalles del Usuario</h5>
                </div>
                <div class="px-3">
                    <p class="my-3"><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
                    <p class="my-3"><strong>Email:</strong> {{ $cliente->correo }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
