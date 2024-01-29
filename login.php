<?php

class AuthService {
    public static function authenticateUser($email, $password) {
        
        if ($email === 'test@example.com' && $password === 'password') {
            return true;
        }

        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $rememberMe = isset($_POST['rememberMe']) && $_POST['rememberMe'] === 'true';

    // Validate the user credentials
    if (AuthService::authenticateUser($email, $password)) {
        $response = [
            'status' => 'ok',
            'message' => "Hello User, you are logged in as $email"
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Invalid credentials'
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    http_response_code(405); 
    echo json_encode(['error' => 'Method Not Allowed']);
}

?>
