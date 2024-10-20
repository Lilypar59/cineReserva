<?php
session_start();

// Generar asientos si no existen en la sesión
if (!isset($_SESSION['seats'])) {
    $rows = 5;
    $seatsPerRow = 8;
    $generatedSeats = [];

    for ($i = 0; $i < $rows; $i++) {
        for ($j = 0; $j < $seatsPerRow; $j++) {
            $seatId = chr(65 + $i) . ($j + 1); // Genera IDs como A1, A2, B1, etc.
            $generatedSeats[] = [
                'id' => $seatId,
                'isOccupied' => rand(0, 1) < 0.2 // 20% de probabilidad de estar ocupado
            ];
        }
    }
    $_SESSION['seats'] = $generatedSeats;
}

// Manejar selección de asientos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selectedSeats'])) {
    $selectedSeats = $_POST['selectedSeats'];
    // Aquí puedes guardar los asientos seleccionados en la base de datos, enviar un correo, etc.
    $message = "Asientos reservados: " . implode(', ', $selectedSeats);
}

// Obtener los asientos
$seats = $_SESSION['seats'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selección de Asientos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script>
        function toggleSeat(seatId) {
            const button = document.getElementById(seatId);
            button.classList.toggle('bg-green-500');
            button.classList.toggle('hover:bg-green-600');
            button.classList.toggle('selected');
        }

        function submitSelectedSeats() {
            // const selectedSeats = Array.from(document.querySelectorAll('.seat.selected')).map(seat => seat.id);
            // document.getElementById('selectedSeats').value = JSON.stringify(selectedSeats);
            // document.getElementById('seatForm').submit();
        }
    </script>
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
        <h1 class="text-3xl font-bold mb-6 text-center">Selección de Asientos</h1>
        <div class="bg-white rounded-lg shadow-md overflow-hidden p-6">
            <div class="grid grid-cols-8 gap-2 mb-6">
                <?php foreach ($seats as $seat): ?>
                    <button
                        id="<?= $seat['id'] ?>"
                        class="w-10 h-10 rounded-md text-white font-bold <?= $seat['isOccupied'] ? 'bg-gray-500 cursor-not-allowed' : 'bg-blue-500 hover:bg-blue-600' ?> transition duration-300 seat <?= !$seat['isOccupied'] ? 'selectable' : '' ?>"
                        onclick="<?= !$seat['isOccupied'] ? "toggleSeat('{$seat['id']}')" : '' ?>"
                        <?= $seat['isOccupied'] ? 'disabled' : '' ?>>
                        <?= $seat['id'] ?>
                    </button>
                <?php endforeach; ?>
            </div>
            <div class="flex justify-center space-x-4 mb-6">
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-blue-500 rounded mr-2"></div>
                    <span>Disponible</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-green-500 rounded mr-2"></div>
                    <span>Seleccionado</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-gray-500 rounded mr-2"></div>
                    <span>Ocupado</span>
                </div>
            </div>
            <div class="text-center">
                <form id="seatForm" method="POST">
                    <input type="hidden" id="selectedSeats" name="selectedSeats">
                    <button
                        type="button"
                        class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition duration-300"
                        onclick="submitSelectedSeats()">
                        Reservar Asientos
                    </button>
                </form>
                <?php if (isset($message)): ?>
                    <div class="mt-4 p-4 text-green-800 bg-green-100 rounded-md">
                        <?= $message ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>