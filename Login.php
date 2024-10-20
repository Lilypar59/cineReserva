<?php
session_start(); // Iniciar la sesión

// Inicializar variables
$email = '';
$password = '';
$error_message = '';

// Manejo del envío del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Aquí debes validar el usuario y contraseña
    if ($email === 'usuario@ibagirlsdev.com' && $password === 'contraseña') {
        $_SESSION['user'] = $email; // Almacenar el usuario en la sesión
        header("Location: AdminDashboard.php"); // Redirigir al dashboard
        exit();
    } else {
        $error_message = 'Credenciales incorrectas'; // Manejo de error
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - CineReserva</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body class="min-h-screen bg-gradient-to-b from-blue-100 to-black flex flex-col items-center justify-center p-4">
    <div class="w-full max-w-md bg-gradient-to-b from-blue-900 to-black backdrop-blur-md rounded-lg shadow-lg p-6">
        <div class="text-center p-6">
            <a href="index.php" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <h1 class="text-3xl font-bold text-white">
                    <span class="text-yellow-400">Cine</span>Reserva
                </h1>
            </a>
        </div>
        <h2 class="text-2xl font-bold text-center text-white mb-6">Iniciar Sesión</h2>

        <!-- Mostrar mensaje de error si las credenciales son incorrectas -->
        <?php if ($error_message): ?>
            <div class="text-red-500 text-center mb-4">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="space-y-4">
            <div>
                <label for="email" class="block text-sm font-medium text-white mb-1">
                    Correo Electrónico
                </label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="<?php echo htmlspecialchars($email); ?>"
                    required
                    class="w-full px-3 py-2 bg-white/20 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-black"
                    placeholder="tu@email.com" />
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-white mb-1">
                    Contraseña
                </label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    class="w-full px-3 py-2 bg-white/20 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-black" />
            </div>
            <div>
                <button
                    type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Iniciar Sesión
                </button>
            </div>
        </form>
        <div class="mt-4 text-center">
            <a href="forgot-password.php" class="text-sm text-yellow-400 hover:text-yellow-300">
                ¿Olvidaste tu contraseña?
            </a>
        </div>
    </div>
</body>

</html>