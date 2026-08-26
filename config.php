<?php
// Configurações e funções globais

// Caminhos
define('ROOT_DIR', __DIR__);
define('DATA_FILE', ROOT_DIR . '/data.json');
define('IMG_DIR', ROOT_DIR . '/img');
define('ADMIN_PASSWORD', getenv('ADMIN_PASSWORD') ?: 'aurora2026');

// Criar diretório de imagens se não existir
if (!is_dir(IMG_DIR)) {
    mkdir(IMG_DIR, 0755, true);
}

// Iniciar sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Carregar dados JSON
function loadData() {
    if (!file_exists(DATA_FILE)) {
        return [];
    }
    $data = json_decode(file_get_contents(DATA_FILE), true);
    return is_array($data) ? $data : [];
}

// Salvar dados JSON
function saveData($data) {
    file_put_contents(DATA_FILE, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
}

// Sincronizar com GitHub
function syncToGitHub($message = 'Atualiza conteúdo via painel admin') {
    $token = getenv('GITHUB_TOKEN');
    $repo = getenv('GITHUB_REPO');
    $branch = getenv('GITHUB_BRANCH') ?: 'main';

    if (!$token || !$repo) {
        error_log('ℹ️ GITHUB_TOKEN/GITHUB_REPO não configurados — edições salvas só localmente.');
        return;
    }

    $remote = "https://x-access-token:{$token}@github.com/{$repo}.git";
    $safeMsg = preg_replace('/["`$\\\\]/', '', $message);

    $cmd = sprintf(
        'cd "%s" && git add data.json img && git -c user.email="painel@romalha.tiagotavares.online" -c user.name="Painel Admin" commit -m "%s" || echo "Nada para commitar" && git push "%s" HEAD:%s',
        escapeshellarg(ROOT_DIR),
        escapeshellarg($safeMsg),
        escapeshellarg($remote),
        escapeshellarg($branch)
    );

    exec($cmd, $output, $return_var);

    if ($return_var === 0) {
        error_log('✅ Conteúdo sincronizado com o GitHub.');
    } else {
        error_log('❌ Falha ao sincronizar com o GitHub: ' . implode("\n", $output));
    }
}

// Verificar autenticação
function checkAuth() {
    if (empty($_SESSION['authenticated'])) {
        http_response_code(401);
        die(json_encode(['error' => 'Não autenticado']));
    }
}

// Responder JSON
function respondJSON($data, $code = 200) {
    http_response_code($code);
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}

// Cabeçalhos de segurança
header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
?>
