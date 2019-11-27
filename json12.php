<?php
require "./Model/User.php";

$user = new User();
$json = file_get_contents("php://input");
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo json_encode($user->findAll());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user->insert(json_decode($json));
    echo json_encode($user->findAll());
}
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $user->update(json_decode($json));
    echo json_encode($user->findAll());
}
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $user->delete(json_decode($json));
    echo json_encode($user->findAll());
}
