<?php
// API central - rota todas as requisições

require_once 'config.php';

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = str_replace('/api.php', '', $path);
$path = trim($path, '/');

// GET /api/data - dados públicos
if ($method === 'GET' && $path === 'data') {
    respondJSON(loadData());
}

// GET /api/blog - posts paginados
if ($method === 'GET' && $path === 'blog') {
    $data = loadData();
    $posts = $data['blog'] ?? [];

    $now = new DateTime();
    $posts = array_filter($posts, function($post) use ($now) {
        return ($post['status'] ?? '') === 'published' && new DateTime($post['date'] ?? '') <= $now;
    });

    usort($posts, function($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });

    $page = (int)($_GET['page'] ?? 1);
    $limit = (int)($_GET['limit'] ?? 3);
    $startIndex = ($page - 1) * $limit;

    respondJSON([
        'total' => count($posts),
        'posts' => array_slice(array_values($posts), $startIndex, $limit),
        'hasMore' => ($startIndex + $limit) < count($posts)
    ]);
}

// GET /api/blog/:slug - post individual
if ($method === 'GET' && preg_match('/^blog\/(.+)$/', $path, $matches)) {
    $slug = $matches[1];
    $data = loadData();
    $posts = $data['blog'] ?? [];

    $now = new DateTime();
    $post = null;

    foreach ($posts as $p) {
        if ($p['slug'] === $slug && ($p['status'] ?? '') === 'published' && new DateTime($p['date'] ?? '') <= $now) {
            $post = $p;
            break;
        }
    }

    if ($post) {
        respondJSON($post);
    } else {
        respondJSON(['error' => 'Post não encontrado'], 404);
    }
}

// POST /api/login - login
if ($method === 'POST' && $path === 'login') {
    $body = json_decode(file_get_contents('php://input'), true);
    $password = $body['password'] ?? '';

    if ($password === ADMIN_PASSWORD) {
        $_SESSION['authenticated'] = true;
        respondJSON(['success' => true, 'message' => 'Autenticado com sucesso']);
    } else {
        respondJSON(['success' => false, 'message' => 'Senha incorreta'], 401);
    }
}

// POST /api/logout - logout
if ($method === 'POST' && $path === 'logout') {
    session_destroy();
    respondJSON(['success' => true]);
}

// GET /api/admin/data - dados (requer auth)
if ($method === 'GET' && $path === 'admin/data') {
    checkAuth();
    respondJSON(loadData());
}

// POST /api/admin/data - salvar dados (requer auth)
if ($method === 'POST' && $path === 'admin/data') {
    checkAuth();
    $body = json_decode(file_get_contents('php://input'), true);

    if (is_array($body)) {
        saveData($body);
        syncToGitHub('Atualiza conteúdo do site via painel admin');
        respondJSON(['success' => true, 'message' => 'Dados salvos com sucesso']);
    } else {
        respondJSON(['error' => 'Dados inválidos'], 400);
    }
}

// POST /api/admin/upload - upload de imagem (requer auth)
if ($method === 'POST' && $path === 'admin/upload') {
    checkAuth();

    if (empty($_FILES['image'])) {
        respondJSON(['error' => 'Nenhuma imagem foi enviada'], 400);
    }

    $file = $_FILES['image'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (!in_array($ext, $allowed)) {
        respondJSON(['error' => 'Apenas imagens são permitidas'], 400);
    }

    $fileName = time() . '.' . $ext;
    $newPath = IMG_DIR . '/' . $fileName;

    if (move_uploaded_file($file['tmp_name'], $newPath)) {
        respondJSON(['success' => true, 'path' => 'img/' . $fileName]);
    } else {
        respondJSON(['error' => 'Erro ao fazer upload'], 500);
    }
}

// Rota não encontrada
respondJSON(['error' => 'Rota não encontrada'], 404);
?>
