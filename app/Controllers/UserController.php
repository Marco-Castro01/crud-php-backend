<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UserController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function index() {
        $users = $this->userModel->getUsers();
        return $this->response->setJSON($users);
    }

    public function show($id) {
        $user = $this->userModel->getUser($id);
        if ($user) {
            return $this->response->setJSON($user);
        } else {
            return $this->response->setJSON(['message' => 'User not found'], 404);
        }
    }

    public function create() {
        $user = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email')
        ];
        $newUser = $this->userModel->addUser($user);
        return $this->response->setJSON($newUser);
    }

    public function update($id) {
        $user = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email')
        ];
        $updatedUser = $this->userModel->updateUser($id, $user);
        if ($updatedUser) {
            return $this->response->setJSON($updatedUser);
        } else {
            return $this->response->setJSON(['message' => 'User not found'], 404);
        }
    }

    public function delete($id) {
        $deleted = $this->userModel->deleteUser($id);
        if ($deleted) {
            return $this->response->setJSON(['message' => 'User deleted']);
        } else {
            return $this->response->setJSON(['message' => 'User not found'], 404);
        }
    }
}
