<?php

require_once '../repository/UserRepository.php';
require_once '../repository/FileRepository.php';
require_once '../repository/UserFileRepository.php';

/**
* Siehe Dokumentation im DefaultController.
*/
class UserController
{
  public function index()
  {
    $userRepository = new UserRepository();

    if (!isset($_SESSION['username'])){
      $this->error('user_login', 'Login', 'Acces denied.');
    }

    if (!empty($_GET['name'])) {
      $folderName = $_GET['name'];
    } else {
        $folderName = $_SESSION['username'];
    }

    $view = new View('user_index');
    $view->title = 'RUN';

    $userRepository = new UserRepository();
    $uid = $userRepository->getId($_SESSION['username']);
    $uid = $uid->id;

    $view->display();
  }

  public function create()
  {
    $view = new View('user_create');
    $view->title = 'Register';
    $view->display();
  }

  public function user_settings() {
    $username = $_SESSION['username'];

    $userRepository = new UserRepository();
    $user_id = $userRepository->getId($username);
    $user = $userRepository->readById($user_id->id);

    $view = new View('user_setting');
    $view->user = $user;
    $view->displayOnly();
  }

  public function doEdit()
  {
    if (!isset($_SESSION['username'])){
      $this->error('user_login', 'Login', 'Acces denied.');
    }

    $newUsername = htmlspecialchars($_POST['username']);
    $newPassword = $_POST['password'];
    $repPassword = $_POST['repeat'];

    $userRepository = new UserRepository();
    $id = $userRepository->getId($_SESSION['username']);
    $id = $id->id;

    if($newPassword !== $repPassword) {
      $this->error('user_settings', 'Edit', 'Passwords have to match.');
    }

    $userRepository = new UserRepository();
    $userRepository->changeUser($id, $newUsername, $newPassword);

    header('Location: /user');
  }

  public function delete()
  {
    if (!isset($_SESSION['username'])){
      $this->error('user_login', 'Login', 'Acces denied.');
    }

    $userRepository = new UserRepository();
    $userRepository->deleteById($_GET['id']);

    // Anfrage an die URI /user weiterleiten (HTTP 302)
    header('Location: /user');
  }

  public function login() {
    $view = new View('user_login');
    $view->title = 'Login';
    $view->display();
  }

  public function doLogin() {
    if (isset($_POST['Submit'])) {
      $username = htmlspecialchars($_POST['username']);
      $password = htmlspecialchars($_POST['password']);

      $userRepository = new UserRepository();

      if ($userRepository->login($username, $password)){
        //login korrekt
        $_SESSION['username'] = $username;
        header('Location: /user');
      } else {
        //Fehler
        $this->error('user_login', 'Login', 'Login not correct');
      }
    }
  }

  public function search()
  {
    if (!isset($_SESSION['username'])){
      $this->error('user_login', 'Login', 'Acces denied.');
    }

    $content = htmlspecialchars($_POST['searchbar']);

    $view = new view('user_index');
    $view->title = "RUN";
    $fileRepository = new FileRepository();
    if (!empty($fileRepository->getFilesByNameAndTag($content))) {
      $files = $fileRepository->getFilesByNameAndTag($content);
      $view->files = $files;
    } else {
      $view->error = "No Results";
    }
    $view->display();
  }

  public function logout() {
    session_destroy();
    header('Location: /');
  }

  public function error($viewFile, $title,  $error) {
    $view = new View($viewFile);
    $view->title = $title;
    $view->error = $error;
    $view->display();
    return;
  }

}
