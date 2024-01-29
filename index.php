<?php

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();


$app->post('/login', 'login');
$app->post('/logout', 'logout');
$app->post('/rememberMe', 'rememberMe');
$app->post('/register', 'register');


$dsn = 'mysql:host=localhost;dbname=SingleLoginUser';
$user = 'SingleLoginUser';
$pass = 'password';

$db = new PDO($dsn, $user, $pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$app->getContainer()->set('db', $db);


function login($request, $response, $args) {
    $data = $request->getParsedBody();

    $email = $data['email'];
    $password = $data['password'];

    $stmt = $this->get('db')->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        return $response->withJson(['status' => 'ok', 'message' => "Hello, $email"]);
    } else {
        return $response->withJson(['status' => 'error', 'message' => 'Invalid credentials']);
    }
}


function logout($request, $response, $args) {
    
    return $response->withJson(['status' => 'ok', 'message' => 'Logout successful']);
}


function rememberMe($request, $response, $args) {
    
    return $response->withJson(['status' => 'ok', 'message' => 'RememberMe logic not implemented']);
}


function register($request, $response, $args) {
    $data = $request->getParsedBody();

    $email = $data['email'];
    $password = password_hash($data['password'], PASSWORD_DEFAULT);

    $stmt = $this->get('db')->prepare('INSERT INTO users (email, password) VALUES (:email, :password)');
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    try {
        $stmt->execute();
        return $response->withJson(['status' => 'ok', 'message' => "User $email registered successfully"]);
    } catch (PDOException $e) {
        return $response->withJson(['status' => 'error', 'message' => 'Registration failed. Email may already be in use.']);
    }
}

$app->run();
