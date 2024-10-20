<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineReserva</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="min-h-screen bg-gradient-to-b from-blue-100 to-black flex flex-col items-center justify-center p-4">
    <div class="w-full max-w-md bg-gradient-to-b from-blue-900 backdrop-blur-md rounded-lg shadow-lg">
        <div class="text-center p-6">
            <h1 class="text-3xl font-bold text-white">
                <span class="text-yellow-400">Cine</span>Reserva
            </h1>
        </div>
        <div class="p-6 space-y-4">
            <a
                href="login.php"
                class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Iniciar Sesión
            </a>
            <a
                href="register.php"
                class="block w-full text-center bg-transparent hover:bg-blue-700 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                Crear Cuenta
            </a>
        </div>
        <div class="p-6 text-center">
            <a
                href="movielist.php"
                class="text-yellow-400 hover:text-yellow-300">
                Ver Películas Disponibles
            </a>
        </div>
    </div>
</body>

</html>