<?php
require("phpMQTT.php"); // Biblioteca phpMQTT, baixe de https://github.com/bluerhinos/phpMQTT

$server = "e8e6fcde1c934878ba54421ec0807c8d.s1.eu.hivemq.cloud"; // Endereço do broker MQTT
$port = 8883; // Porta do broker
$username = "gostoso"; // Usuário MQTT
$password = "40023091Italo!"; // Senha MQTT
$client_id = "PHPClient"; // Identificação do cliente MQTT

// Verifica se foi enviado o estado pelo botão
if (isset($_POST['state'])) {
    $state = $_POST['state']; // Recebe o estado ('on' ou 'off')

    // Inicializa o cliente MQTT
    $mqtt = new phpMQTT($server, $port, $client_id);
    
    if ($mqtt->connect(true, NULL, $username, $password)) {
        $mqtt->publish("esp32/led", $state, 0); // Publica a mensagem no tópico esp32/led
        $mqtt->close();
        echo "Mensagem enviada: $state";
    } else {
        echo "Falha ao conectar ao broker MQTT";
    }
} else {
    echo "Nenhum estado foi enviado.";
}