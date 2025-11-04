<?php
require_once 'config.php';
verificarLogin();

if ($_GET['action'] == 'viacep') {
    $cep = preg_replace('/[^0-9]/', '', $_GET['cep']);
    
    if (strlen($cep) == 8) {
        $url = "https://viacep.com.br/ws/{$cep}/json/";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        
        if (!isset($data['erro'])) {
            echo json_encode([
                'success' => true,
                'cidade' => $data['localidade'],
                'estado' => $data['uf']
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'CEP não encontrado']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'CEP inválido']);
    }
}

if ($_GET['action'] == 'boredapi') {
    $url = "https://www.boredapi.com/api/activity";
    $response = file_get_contents($url);
    $data = json_decode($response, true);
    
    echo json_encode([
        'success' => true,
        'atividade' => $data['activity']
    ]);
}
?>