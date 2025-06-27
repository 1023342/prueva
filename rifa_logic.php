<?php
// Configuración
$dataFile = 'rifa_data.json';
$maxTickets = 100;
$adminPhone = '573115242233'; // Tu número de WhatsApp

// Cargar datos existentes
function loadRifaData($file) {
    if (file_exists($file)) {
        $data = json_decode(file_get_contents($file), true);
        return $data ?: ['sold_tickets' => []];
    }
    return ['sold_tickets' => []];
}

// Guardar datos
function saveRifaData($file, $data) {
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}

// Procesar reserva y generar enlace de WhatsApp
function processReservation() {
    global $dataFile, $maxTickets, $adminPhone;
    
    $result = [
        'success' => false,
        'message' => '',
        'whatsappLink' => ''
    ];
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
        if ($_POST['action'] === 'reserve') {
            $ticketNumber = intval($_POST['ticket_number']);
            $name = trim($_POST['name'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            
            $data = loadRifaData($dataFile);
            $soldTickets = $data['sold_tickets'] ?? [];
            
            if ($ticketNumber < 1 || $ticketNumber > $maxTickets) {
                $result['message'] = "Número de boleta inválido";
            } elseif (isset($soldTickets[$ticketNumber])) {
                $result['message'] = "Esta boleta ya fue reservada";
            } elseif (empty($name) || empty($phone)) {
                $result['message'] = "Por favor completa todos los campos";
            } else {
                // Registrar la reserva
                $soldTickets[$ticketNumber] = [
                    'reserved_at' => date('Y-m-d H:i:s'),
                    'phone' => $phone,
                    'name' => $name
                ];
                
                // Guardar datos
                $data['sold_tickets'] = $soldTickets;
                $data['last_update'] = date('Y-m-d H:i:s');
                saveRifaData($dataFile, $data);
                
                // Generar enlace de WhatsApp
                $whatsappMessage = "Hola, soy $name. Acabo de reservar la boleta número $ticketNumber para la rifa de la Tablet Redmi Pad SE. Mi número de contacto es $phone. Por favor indícame cómo proceder con el pago.";
                $encodedMessage = urlencode($whatsappMessage);
                $whatsappLink = "https://wa.me/$adminPhone?text=$encodedMessage";
                
                $result['success'] = true;
                $result['message'] = "¡Boleta $ticketNumber reservada con éxito!";
                $result['whatsappLink'] = $whatsappLink;
            }
        }
    }
    return $result;
}

// Obtener datos para mostrar
function getRifaData() {
    global $dataFile, $maxTickets;
    
    $data = loadRifaData($dataFile);
    $soldTickets = $data['sold_tickets'] ?? [];
    $soldCount = count($soldTickets);
    $availableCount = $maxTickets - $soldCount;
    
    $reservationResult = processReservation();
    
    return [
        'soldTickets' => $soldTickets,
        'soldCount' => $soldCount,
        'availableCount' => $availableCount,
        'progressWidth' => ($soldCount / $maxTickets) * 100,
        'message' => $reservationResult['message'] ?? '',
        'success' => $reservationResult['success'] ?? false,
        'whatsappLink' => $reservationResult['whatsappLink'] ?? ''
    ];
}
?>