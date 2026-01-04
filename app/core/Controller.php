<?php
class Controller {
    protected function view($view, $data = [], $layout = 'student') {
        extract($data);

        ob_start();
        require __DIR__ . '/../../views/' . $view . '.php';

        $content = ob_get_clean();

        // render layout
        require __DIR__ . "/../../views/layouts/$layout.php";
    }

    protected function jsonResponse($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    // Success response helper
    protected function success($message, $data = null, $statusCode = 200)
    {
        $response = [
            'success' => true,
            'message' => $message
        ];
        
        if ($data !== null) {
            $response['data'] = $data;
        }
        
        $this->jsonResponse($response, $statusCode);
    }

    // Error response helper
    protected function error($message, $errors = null, $statusCode = 400)
    {
        $response = [
            'success' => false,
            'message' => $message
        ];
        
        if ($errors !== null) {
            $response['errors'] = $errors;
        }
        
        $this->jsonResponse($response, $statusCode);
    }

    protected function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $this->isXMLRequest();
    }
    
    private function isXMLRequest()
    {
        return strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    // Get JSON input dari request body
    protected function getJsonInput()
    {
        $json = file_get_contents('php://input');
        return json_decode($json, true);
    }

    // Validate CSRF token (opsional, untuk keamanan)
    protected function validateCsrfToken()
    {
        $token = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;
        
        if (!$token || !isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
            $this->error('Invalid CSRF token', null, 403);
        }
    }
}