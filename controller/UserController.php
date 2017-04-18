<?php

require_once '../repository/UserRepository.php';

/**
 * Siehe Dokumentation im DefaultController.
 */
class UserController
{
    public function index()
    {
        $userRepository = new UserRepository();

        $view = new View('user_index');
        $view->title = 'Benutzer';
        $view->heading = 'Benutzer';
        $view->users = $userRepository->readAll();
        $view->display();
    }

    public function create()
    {
        $view = new View('user_create');
        $view->title = 'Register';
        $view->display();
    }

    public function doCreate()
    {
        if ($_POST['Submit']) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userRepository = new UserRepository();
            $userRepository->create($username, $password);
        }

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        //header('Location: /user');
    }

    public function delete()
    {
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
      if ($_POST['Submit']) {
          $username = $_POST['username'];
          $password = $_POST['password'];

          $userRepository = new UserRepository();
          $userRepository->login($username, $password);

          //header('Location: /user');
      }
    }

    public function upload() {
      $view = new View('user_upload');
      $view->title = 'Upload';
      $view->display();
    }

    public function doUpload() {
      //TODO: evtl. FileController ??
      //username, speicherung (in Repository?)
      if ($_POST['Submit']) {
          $name = $_POST['name'];
          $tags = $_POST['tags'];
          $acces = $_POST['acces'];

          $file = $_FILES['file'];

          /*if (move_uploaded_file($file["tmp_name"], '../data/files/'.$file["name"])){
            echo "yo";
          }
          else {
            echo "fkc";
          }*/

          $fileRepository = new FileRepository();
          $fileRepository->create()
      }
    }
}
