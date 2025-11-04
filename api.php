<?php
require_once 'config.php';

// Verificar se usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['error' => 'Não autorizado']);
    exit();
}

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'viacep':
            $cep = preg_replace('/[^0-9]/', '', $_GET['cep']);
            
            if (strlen($cep) == 8) {
                $url = "https://viacep.com.br/ws/{$cep}/json/";
                
                // Usar cURL que é mais confiável
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                
                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
                
                if ($response !== false && $httpCode === 200) {
                    $data = json_decode($response, true);
                    
                    if (!isset($data['erro'])) {
                        echo json_encode([
                            'success' => true,
                            'logradouro' => $data['logradouro'] ?? '',
                            'bairro' => $data['bairro'] ?? '',
                            'cidade' => $data['localidade'] ?? '',
                            'estado' => $data['uf'] ?? ''
                        ]);
                    } else {
                        echo json_encode(['success' => false, 'message' => 'CEP não encontrado']);
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'Erro ao consultar CEP']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'CEP deve ter 8 dígitos']);
            }
            break;
            
        case 'boredapi':
            $url = "https://www.boredapi.com/api/activity/";
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            
            $response = curl_exec($ch);
            curl_close($ch);
            
            if ($response !== false) {
                $data = json_decode($response, true);
                echo json_encode([
                    'success' => true,
                    'atividade' => $data['activity'] ?? 'Nenhuma atividade encontrada'
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erro ao buscar atividade']);
            }
            break;
    }
}
?>