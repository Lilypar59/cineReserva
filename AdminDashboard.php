<?php
// Archivo PHP para el Panel de Administración
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineReserva Admin</title>
    <!-- Enlace a alguna biblioteca de íconos (como FontAwesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="min-h-screen bg-gray-100">
    
    <!-- Barra de navegación -->
    <nav class="bg-blue-600 p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold text-white">CineReserva Admin</h1>
            <a href="index.php" class="flex items-center text-white hover:text-blue-200">
                <i class="fas fa-sign-out-alt mr-2"></i>
                Cerrar Sesión
            </a>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Panel de Administración</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Gestionar Películas -->
            <a href="manage_movies.php" class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition-shadow duration-300 ease-in-out">
                <div class="p-6 flex items-center">
                    <i class="fas fa-film h-8 w-8 text-blue-600 mr-4"></i>
                    <div class="text-xl font-semibold text-gray-900">Gestionar Películas</div>
                </div>
            </a>
            
            <!-- Programar Funciones -->
            <a href="schedule.php" class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition-shadow duration-300 ease-in-out">
                <div class="p-6 flex items-center">
                    <i class="fas fa-calendar-alt h-8 w-8 text-blue-600 mr-4"></i>
                    <div class="text-xl font-semibold text-gray-900">Programar Funciones</div>
                </div>
            </a>
            
            <!-- Gestionar Usuarios -->
            <a href="users.php" class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition-shadow duration-300 ease-in-out">
                <div class="p-6 flex items-center">
                    <i class="fas fa-users h-8 w-8 text-blue-600 mr-4"></i>
                    <div class="text-xl font-semibold text-gray-900">Gestionar Usuarios</div>
                </div>
            </a>
            
            <!-- Reportes de Ventas -->
            <a href="sales_reports.php" class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition-shadow duration-300 ease-in-out">
                <div class="p-6 flex items-center">
                    <i class="fas fa-dollar-sign h-8 w-8 text-blue-600 mr-4"></i>
                    <div class="text-xl font-semibold text-gray-900">Reportes de Ventas</div>
                </div>
            </a>
            
            <!-- Configuración -->
            <a href="settings.php" class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition-shadow duration-300 ease-in-out">
                <div class="p-6 flex items-center">
                    <i class="fas fa-cog h-8 w-8 text-blue-600 mr-4"></i>
                    <div class="text-xl font-semibold text-gray-900">Configuración</div>
                </div>
            </a>
        </div>
    </main>

</body>
</html>
