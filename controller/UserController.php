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

    $view = new View('user_index');
    $view->title = 'RUN';

    if (!isset($_SESSION['username'])){
      $view = new View('user_login');
      $view->title = 'Login';
      $view->error = "Acces denied.";
      $view->display();
      return;
    }

    $userRepository = new UserRepository();
    $uid = $userRepository->getId($_SESSION['username'])->id;

    $userFileRepository = new UserFileRepository();
    if (!empty($userFileRepository->getFileIds($uid))) {
      $fids = $userFileRepository->getFileIds($uid);

      $fileRepository = new FileRepository();
      $files = array();
      foreach ($fids as $fid) {
        $files[] = $fileRepository->readById($fid->file_id);
      }

      $view->files = $files;
    }

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
    //TODO: dont reset form after error messages
    if ($_POST['Submit']) {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $passwordRepeat = $_POST['passwordRepeat'];

      if ($username == "" || empty($username) || $password == "" || empty($password)){
        $view = new View('user_create');
        $view->title = 'Register';
        $view->error = "Name and password can't be empty";
        $view->display();
        return;
      }

      if ($password !== $passwordRepeat) {
        $view = new View('user_create');
        $view->title = 'Register';
        $view->error = "Passwords have to match";
        $view->display();
        return;
      }

      $userRepository = new UserRepository();

      if (!empty($userRepository->getId($username))) {
        //user with that name already exists
        $view = new View('user_create');
        $view->title = 'Register';
        $view->error = "A User with that name already exists";
        $view->display();
        return;
      }
      $userRepository->create($username, $password);
      $_SESSION['username'] = $username;
      header('Location: /user');
    }
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
        $view = new View('user_login');
        $view->title = 'Login';
        $view->error = "Login not correct";
        $view->display();
        return;
      }
    }
  }

  public function upload() {
    $view = new View('user_upload');
    $view->title = 'Upload';
    $view->display();
  }

  public function doUpload() {
    //TODO file size
    if (isset($_POST['Submit'])) {
      $name = htmlspecialchars($_POST['name']);
      if ($name == "" || empty($name)){
        $view = new View('user_upload');
        $view->title = 'Upload';
        $view->error = "Name can't be empty.";
        $view->display();
        return;
      }
      $tags = htmlspecialchars($_POST['tags']);
      $acces = htmlspecialchars($_POST['acces']);
      $file = $_FILES['file'];

      if (!isset($_SESSION['username'])){
        $view = new View('user_upload');
        $view->title = 'Upload';
        $view->error = "You are not logged in.";
        $view->display();
        return;
      }

      $username = $_SESSION['username'];
      $path = "data/files/".$username."/".$file['name'];
      //TODO: $_GET subfolder from upload


      if (!is_dir("data/files/".$username)) {
        //create dir if it doesnt exist
        mkdir("data/files/".$username, 0777, true);
      }

      if (move_uploaded_file($file["tmp_name"], $path)){
        $fileRepository = new FileRepository();

        if (!empty($fileRepository->getId($name))) {
          //file with that name already exists
          $view = new View('user_upload');
          $view->title = 'Upload';
          $view->error = "A File with that name already exists.";
          $view->display();
          return;
        }

        $fileRepository->create($name, $tags, $path);

        $file_id = $fileRepository->getId($name);
        $file_id = $file_id->id;

        $userRepository = new userRepository();
        $user_id = $userRepository->getId($username);
        $user_id = $user_id->id;

        $userFileRepository = new UserFileRepository();
        $userFileRepository->create($user_id, $file_id);
        header('Location: /user');
      }
      else {
        $view = new View('user_upload');
        $view->title = 'Upload';
        $view->error = "Something went wrong.";
        $view->display();
        return;
      }
    }
  }

  public function makeDir() {
    $view = new View('user_makeDir');
    $view->title = 'Upload';
    $view->display();
  }

  public function doMakeDir() {
    if (isset($_POST['Submit'])) {
      $name = htmlspecialchars($_POST['name']);
      if ($name == "" || empty($name)){
        $view = new View('user_makeDir');
        $view->title = 'Create Folder';
        $view->error = "Name can't be empty";
        $view->display();
        return;
      }
      if (!isset($_SESSION['username'])){
        echo "not logged in";
      }
      $username = $_SESSION['username'];

      $path = "data/files/".$username."/".$name;

      if (!is_dir("data/files/".$username)) {
        //create user-dir if it doesnt exist
        mkdir("data/files/".$username, 0777, true);
      }

      if (!is_dir("data/files/".$username."/".$name)) {
        //create dir if it doesnt exist
        mkdir("data/files/".$username."/".$name, 0777, true);
      }


      $fileRepository = new FileRepository();
      if (!empty($fileRepository->getId($name))) {
        //file with that name already exists
        $view = new View('user_makeDir');
        $view->title = 'Create Folder';
        $view->error = "A File with that name already exists";
        $view->display();
        return;
      }

      $fileRepository->create($name, "", $path);//no tag

      $file_id = $fileRepository->getId($name);
      $file_id = $file_id->id;

      $userRepository = new userRepository();
      $user_id = $userRepository->getId($username);
      $user_id = $user_id->id;

      $userFileRepository = new UserFileRepository();
      $userFileRepository->create($user_id, $file_id);
      header('Location: /user');
    }

    header('Location: /user/');
  }

  public function search()
  {
    $content = htmlspecialchars($_POST['searchbar']);

    $view = new view('user_index');
    $fileRepository = new FileRepository();
    if (!empty($fileRepository->getFilesByNameAndTag($content))) {
      $files = $fileRepository->getFilesByNameAndTag($content);
      $view->files = $files;
    }
    $view->display();
  }

  public function delFile()
  {
    $file_id = $_GET['id'];
    $fileRepository = new FileRepository();
    $fileRepository->delFileById($file_id);

    header('Location: /user');
  }

  public function delTag() {
    $file_id = $_GET['id'];
    $fileRepository = new FileRepository();
    $fileRepository->delTagById($file_id);

    header('Location: /user');
  }

  public function logout() {
    session_destroy();
    header('Location: /');
  }



  public function fileprops() {
    $fileid = $_GET['id'];

    $fileRepository = new FileRepository();
    $file = $fileRepository->readById($fileid);

    $view = new View('file_properties');
    $view->file = $file;
    $view->displayOnly();
  }

}
