<?php
// movie_detail.php

// Incluir el archivo de conexión
require 'conn.php';

// Obtener el ID de la película desde la URL
$id = $_GET['id'] ?? 1; // Puedes cambiar el valor por defecto según sea necesario

// Consulta para obtener los detalles de la película
$sql = "SELECT * FROM movies WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id); // "i" indica que el parámetro es un entero
$stmt->execute();
$result = $stmt->get_result();

// Verificar si la película existe
if ($result->num_rows > 0) {
    $movie = $result->fetch_assoc();
} else {
    echo '<h1>Película no encontrada</h1>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($movie['title']); ?> - CineReserva</title>
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

        <div class="flex flex-col md:flex-row">
            <div class="md:w-1/3">
                <div class="w-full h-64 flex items-center justify-center bg-gray-200" style="width: 300px; height: 300px;">

                </div>
            </div>
            <div class="md:w-2/3 md:pl-8 mt-4 md:mt-0">
                <h1 class="text-3xl font-bold mb-4"><?php echo htmlspecialchars($movie['title']); ?></h1>
                <p class="text-gray-600 mb-6"><?php echo htmlspecialchars($movie['description']); ?></p>
                <h2 class="text-2xl font-semibold mb-4">Horarios Disponibles</h2>
                <div class="flex flex-wrap gap-4 mb-6">
                    <?php
                    // Suponiendo que los horarios están almacenados en una cadena separada por comas
                    $showtimes = explode(',', $movie['showtimes']);
                    foreach ($showtimes as $showtime): ?>
                        <button
                            class="px-4 py-2 rounded bg-gray-200 text-gray-800 hover:bg-gray-300"
                            onclick="setSelectedShowtime('<?php echo htmlspecialchars(trim($showtime)); ?>')">
                            <?php echo htmlspecialchars(trim($showtime)); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
                <div id="selected-showtime"></div> <!-- Aquí se mostrará el horario seleccionado -->
                <div class="mt-4">
                    <a
                        href="seatselecction.php"
                        class="bg-green-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-600 transition duration-300"
                        id="select-seats-button"
                        style="display: none;">
                        Seleccionar Asientos
                    </a>
                </div>
                <div class="mt-4">
                    <a
                        href="movielist.php"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">
                        Volver Películas Disponibles
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedShowtime = '';

        function setSelectedShowtime(showtime) {
            selectedShowtime = showtime;
            document.getElementById('selected-showtime').innerText = 'Horario seleccionado: ' + selectedShowtime;
            document.getElementById('select-seats-button').style.display = 'block'; // Mostrar el botón de seleccionar asientos
        }
    </script>
</body>

</html>