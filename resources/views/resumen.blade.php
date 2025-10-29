<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen de Orden</title>
    @vite('resources/css/app.css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <x-top_bar/>
    <div class="bg-color-bg p-4 min-h-screen max-h-max text-white">
        <div class="flex items-start justify-center space-x-5 max-md:flex-col max-md:items-stretch max-md:space-y-5 max-md:space-x-0">
            <div class="flex-grow flex-shrink-0 rounded-lg shadow-lg p-6 max-w-5xl">
                <h2 class="text-2xl font-bold text-center max-md:text-xl">Resumen de tu orden</h2>
                <ul class="mt-4">
                    @foreach ($orden->platillos as $platillo)
                        <li class="p-4 mb-4 flex items-center justify-between rounded-lg bg-color-secondary">
                            <div class="text-2xl font-bold max-md:text-lg">x{{ $platillo->pivot->cantidad }}</div>
                            <div class="text-xl max-md:text-lg">{{ $platillo->nombre }}</div>
                            <div class="text-xl max-md:text-lg font-bold">${{ number_format($platillo->precio * $platillo->pivot->cantidad, 2) }}</div>
                        </li>
                    @endforeach
                </ul>

                <div class="text-end text-3xl font-bold max-md:text-2xl max-md:text-center">Total: <span class="text-orange-500">${{ number_format($orden->total,2) }}</span> </div>
                <a href="{{route('cliente.cancelarOrden')}}" class="p-4 mx-auto text-white font-bold rounded-lg bg-color-main hover:bg-orange-400">Cancelar orden</a>
            </div>

            <form id="formOrden" method="POST" action="{{ route('orden.guardarNota', $orden->id) }}" class="flex-shrink flex flex-col items-center bg-color-secondary p-6 rounded-lg shadow-lg max-w-xl max-md:max-w-full w-full">
                @csrf
                <label class="text-2xl font-bold text-center mb-4 max-md:text-xl">Información de pago</label>
                <label hidden="true" class="text-lg w-full text-left">Notas para la cocina:</label>
                <textarea hidden="true" name="nota" rows="4" cols="50" placeholder="Ej: Sin cebolla, con sal extra..."
                class="p-2 mb-4 w-full outline-none border border-gray-600 rounded-md bg-color-bg focus:border-orange-500 "></textarea>

                <label class="text-lg w-full text-left">Nombre:</label>
                <input id="nombre" type="text" name="contacto_nombre" placeholder="Ej: Juan" required="true"
                class="p-2 mb-4 w-full outline-none border border-gray-600 rounded-md bg-color-bg focus:border-orange-500">

                <label  class="text-lg w-full text-left">Apellido:</label>
                <input id="apellido" type="text" name="contacto_apellido" placeholder="Ej:Pérez" required="true"
                class="p-2 mb-4 w-full outline-none border border-gray-600 rounded-md bg-color-bg focus:border-orange-500">

                <label  class="text-lg w-full text-left">Correo electrónico:</label>
                <input id="correo" type="email" name="contacto_correo" placeholder="Ej: juan@email.com" required="true"
                class="p-2 mb-4 w-full outline-none border border-gray-600 rounded-md bg-color-bg focus:border-orange-500">

                <label class="text-lg w-full text-left">Teléfono:</label>
                <input type="tel" maxlength="8" name="contacto_telefono" placeholder="Ej: 7777-8888"
                class="p-2 mb-4 w-full outline-none border border-gray-600 rounded-md bg-color-bg focus:border-orange-500">
                <div id="form-paypal"></div>

                </div>
                <!--<button type="submit" class="p-4 my-4 text-white rounded-lg bg-color-main hover:bg-orange-400 text-lg font-bold">Finalizar orden</button>-->
                <script src="https://www.paypal.com/sdk/js?client-id=AfXUFGQHLNa7jfFKn-OhyGDOBdeAkWko0Cl0W_hEZCkEC45Zjy4NFWdTjIZf1ZlSsM-8tiBV_8vETXTB&currency=USD"></script>
            </form>
        </div>
    </div>
    <script>
        form = document.getElementById('formOrden');
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    application_context: {
                        shipping_preference: "NO_SHIPPING"
                    },
                    payer: {
                        email_address: document.getElementById('correo').value,
                        name: {
                            given_name: document.getElementById('nombre').value,
                            surname: document.getElementById('apellido').value
                        },
                        address: {
                            country_code: "SV"
                        }
                    },
                    purchase_units: [{
                        amount: {
                            value: {{ number_format($orden->total,2) }}
                        }
                    }],
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Enviar el formulario al servidor para procesar el pago
                    form.submit();
                });
            }
        }).render('#form-paypal'); 
    </script>
</body>
</html>
