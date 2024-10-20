<?php
// movieslist.php

// Incluir el archivo de conexión
require 'conn.php';




// Obtener lista de películas
$movies = [];
$sql = "SELECT * FROM movies";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $movies[] = $row;
    }
}
// Consulta para obtener todas las películas
// $stmt = $pdo->query('SELECT * FROM movies');
// $movies = $stmt->fetchAll();

// // Verificar si hay películas
if (!$movies) {
    echo '<h1>No hay películas disponibles</h1>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Películas en Cartelera - CineReserva</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body>
    <div class="container mx-auto px-4 py-8">
        <nav class="bg-blue-600 p-4">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <h1 class="text-3xl font-bold mb-6 text-center text-white">Películas en Cartelera</h1>
                <a
                    href="index.php"
                    class="flex items-center text-white hover:text-blue-200">
                    <span class="material-icons">Inicio</span> <!-- Cambiar por el ícono adecuado -->
                </a>
            </div>
        </nav>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
            <?php foreach ($movies as $movie): ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="w-full h-64 flex items-center justify-center bg-gray-200" style="width: 300px; height: 300px;">

                    </div>
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($movie['title']); ?></h2>
                        <p class="text-gray-600 mb-4 line-clamp-3"><?php echo htmlspecialchars($movie['description']); ?></p>
                        <a
                            href="moviedetails.php?id=<?php echo $movie['id']; ?>"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">
                            Ver Detalles
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>