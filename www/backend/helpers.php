<?php
require_once 'connect.php';
function connectDB()
{
    return new PDO('mysql:host=' . DB_HOST .';dbname=' . DB_NAME, DB_LOGIN, DB_PASSWORD);
}
function redirect($path)
{
    header("Location: $path");
    exit();
}
function getUserByEmail($email)
{
    $pdo = connectDB();

    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':email' => $email
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function getUserByID($id)
{
    $pdo = connectDB();

    $query = "SELECT * FROM users WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':id' => $id
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function setFlashMessage($name, $message)
{
    $_SESSION["$name"] = $message;
}
function getFlashMessage($name)
{
    return $_SESSION["$name"];
}
function deleteFlashMessage($name)
{
    unset($_SESSION["$name"]);
}
function existFlashMessage($name)
{
    return isset($_SESSION["$name"]);
}
function addUserToDB($email, $password)
{
    $pdo = connectDB();

    $query = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':email'    => $email,
        ':password' => password_hash($password, PASSWORD_DEFAULT)
    ]);

    return $pdo->lastInsertId();
}
function updateUserToDB($user_id, $field_name, $data)
{
    $pdo = connectDB();

    $query = "UPDATE users SET $field_name = :data WHERE id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':data' => $data, ':user_id' => $user_id]);
}
function getUsers()
{
    $pdo = connectDB();

    $query = "SELECT * FROM users";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function isNotLoginUser()
{
    return !isset($_SESSION['user']);
}
function isAdmin($user)
{
        return $user['role'] === 'admin';
}
function login($email, $password)
{
    $user = getUserByEmail($email);

    if (!empty($user) AND password_verify($password, $user['password']))
    {
        $_SESSION['user'] = $user;
        return true;
    }
    return false;
}
function getCurrentUser()
{
    return $_SESSION['user'];
}
function itsMe($iteration_user, $auth_user)
{
    return $iteration_user['id'] === $auth_user['id'];
}
function emailNotFree($email)
{
    $user = getUserByEmail($email);

    return !empty($user);
}
function passwordConfirm($password, $password_confirm)
{
    return $password === $password_confirm;
}
function editCredentials($user_id, $new_email, $new_password)
{
    $pdo = connectDB();

    $query = "UPDATE users SET email = :email, password = :password WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':id'       => $user_id,
        ':email'    => $new_email,
        ':password' => $new_password
    ]);
}
function setUserAvatarToDB($user_id, $avatar)
{
    $pdo = connectDB();

    $query = "UPDATE users SET avatar = :avatar WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':avatar' => $avatar, ':id' => $user_id]);
}
function userDelete($user_id)
{
    $pdo = connectDB();

    $query = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':id' => $user_id]);

    return $pdo->lastInsertId();
}
