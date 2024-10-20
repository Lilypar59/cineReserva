<?php
// register.php

$message = null;

// Incluir la conexión a la base de datos
include 'conn.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['fullName'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    if ($password !== $confirmPassword) {
        $message = ['type' => 'error', 'text' => 'Las contraseñas no coinciden'];
    } else {
        // Encriptar la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Preparar y ejecutar la inserción
        $stmt = $conn->prepare("INSERT INTO `users`( `name`, `email`, `password`)  VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $fullName, $email, $hashedPassword);

        if ($stmt->execute()) {
            $message = ['type' => 'success', 'text' => 'Cuenta creada exitosamente'];
            // Redirigir a la página de inicio de sesión
            echo "<script>setTimeout(function() { window.location.href = '/login.php'; }, 2000);</script>";
        } else {
            $message = ['type' => 'error', 'text' => 'Error al crear la cuenta: ' . $stmt->error];
        }

        // Cerrar la declaración
        $stmt->close();
    }
}

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body>
    <div class="min-h-screen bg-gradient-to-b from-blue-100 to-blue-200 flex items-center justify-center p-4">

        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <nav class="bg-blue-600 p-4">
                <div class="max-w-7xl mx-auto flex justify-between items-center">
                    <h1 class="text-3xl font-bold mb-6 text-center text-white">Cine Reserva</h1>
                    <a
                        href="index.php"
                        class="flex items-center text-white hover:text-blue-200">
                        <span class="material-icons">Inicio</span> <!-- Cambiar por el ícono adecuado -->
                    </a>
                </div>
            </nav>
            <h1 class="text-2xl font-bold mb-6 text-center">Crear Cuenta</h1>
            <form method="POST" class="space-y-4">
                <div class="space-y-2">
                    <label for="fullName" class="block text-sm font-medium text-gray-700">Nombre Completo</label>
                    <input id="fullName" name="fullName" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                    <input id="email" name="email" type="email" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <input id="password" name="password" type="password" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="space-y-2">
                    <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
                    <input id="confirmPassword" name="confirmPassword" type="password" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Crear Cuenta
                </button>
            </form>
            <?php if ($message): ?>
                <div class="mt-4 p-4 rounded-md <?= $message['type'] === 'error' ? 'bg-red-50 text-red-800' : 'bg-green-50 text-green-800' ?>">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <?php if ($message['type'] === 'error'): ?>
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            <?php else: ?>
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            <?php endif; ?>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium"><?= $message['type'] === 'error' ? 'Error' : 'Éxito' ?></h3>
                            <div class="mt-2 text-sm">
                                <p><?= $message['text'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>