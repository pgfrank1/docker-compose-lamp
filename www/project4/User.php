<?php
require_once "./UserManager.php";

$params = $_REQUEST;
$http_verb = $_SERVER['REQUEST_METHOD'];
$user_manager = new UserManager();

switch($http_verb)
{
    case "GET":
        header('Content-Type: application/json');
        if (empty($params))
        {
            echo $user_manager->readAll();
        }
        elseif (isset($params['id']))
        {
            echo $user_manager->read($params['id']);
        }
        else
        {
            throw new Exception("Invalid HTTP GET request parameters");
        }
        break;
    case "POST":
        if (isset($params['username']) && isset($params['password'])) {
            $result = $user_manager->create($params['username'], $params['password']);
        }
        else
        {
            throw new Exception("Invalid HTTP POST request parameters");
        }
        break;
    case "PUT":
        // Parse the input stream as an associative array
        parse_str(file_get_contents('php://input'), $input);
        // If id and newPassword parameters are given, update the user's password with that id and newPassword
        if (isset($input['id']) && isset($input['newPassword']))
        {
            $result = $user_manager->updatePassword($input['id'], $input['newPassword']);
        }
        // If id and updateApiKey parameters are given, update the user's API key with that id
        elseif (isset($input['id']) && isset($input['updateApiKey']))
        {
            $result = $user_manager->updateApiKey($input['id']);
        }
        // Otherwise, return an error message
        else
        {
            throw new Exception("Invalid HTTP PUT request parameters");
        }
        break;
    case "DELETE":
        // Parse the input stream as an associative array
        parse_str(file_get_contents('php://input'), $input);
        // If id parameter is given, delete the user with that id
        if (isset($input['id']))
        {
            $result = $user_manager->delete($input['id']);
        }
        // Otherwise, return an error message
        else
        {
            throw new Exception("Invalid HTTP DELETE request parameters");
        }
        break;
    default:
        throw new Exception("Invalid HTTP request parameters");
}
// Set the content type header to JSON
//header('Content-Type: application/json');
// Encode and print the result as a JSON string
echo json_encode($result);