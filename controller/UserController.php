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
            echo "not logged in";
            //TODO:
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
        if ($_POST['Submit']) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($username == "" || empty($username) || $password == "" || empty($password)){
              //TODO tell user about error
              header('Location: /user/create');
              return;
            }

            $userRepository = new UserRepository();

            if (!empty($userRepository->getId($username))) {
                //user with that name already exists
                //TODO tell user about error
                header('Location: /user/create');
                return;
            }
            $userRepository->create($username, $password);
            $_SESSION['username'] = $username;
            header('Location: /user');
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
              echo "shit";
              //TODO:
          }
      }
    }

    public function upload() {
      $view = new View('user_upload');
      $view->title = 'Upload';
      $view->display();
    }

    public function doUpload() {
      if (isset($_POST['Submit'])) {
          $name = htmlspecialchars($_POST['name']);
          if ($name == "" || empty($name)){
            //TODO tell user about error
            header('Location: /user/upload');
            return;
          }
          $tags = htmlspecialchars($_POST['tags']);
          $acces = htmlspecialchars($_POST['acces']);
          $file = $_FILES['file'];

          if (!isset($_SESSION['username'])){
              echo "not logged in";
          }

          $username = $_SESSION['username'];
          $path = "../data/files/".$username."/".$file['name'];
          //TODO: $_GET subfolder from upload


          if (!is_dir("../data/files/".$username)) {
              //create dir if it doesnt exist
              mkdir("../data/files/".$username, 0777, true);
          }

          if (move_uploaded_file($file["tmp_name"], $path)){
            $fileRepository = new FileRepository();

            if (!empty($fileRepository->getId($name))) {
                //file with that name already exists
                //TODO tell user about error
                header('Location: /user/upload');
                return;
            }

            $fileRepository->create($name, $tags, $path);

            $file_id = $fileRepository->getId($name);
            $file_id = $file_id->id;

            $userRepository = new userRepository();
            $user_id = $userRepository->getId($username);
            $user_id = $user_id->id;

            $userFileRepository = new UserFileRepository();
            $userFileRepository->create($user_id, $file_id, $tags);
            header('Location: /user');
          }
          else {
            echo "fkc";
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
          //TODO tell user about error
          header('Location: /user/makeDir');
          return;
        }
        if (!isset($_SESSION['username'])){
          echo "not logged in";
        }
        $username = $_SESSION['username'];

        $path = "../data/files/".$username."/".$name;

        if (!is_dir("../data/files/".$username)) {
          //create user-dir if it doesnt exist
          mkdir("../data/files/".$username, 0777, true);
        }

        if (!is_dir("../data/files/".$username."/".$name)) {
          //create dir if it doesnt exist
          mkdir("../data/files/".$username."/".$name, 0777, true);
        }


        $fileRepository = new FileRepository();
        if (!empty($fileRepository->getId($name))) {
            //file with that name already exists
            //TODO tell user about error
            header('Location: /user/upload');
            return;
        }

        $fileRepository->create($name, "", $path);//no tag

        $file_id = $fileRepository->getId($name);
        $file_id = $file_id->id;

        $userRepository = new userRepository();
        $user_id = $userRepository->getId($username);
        $user_id = $user_id->id;

        $userFileRepository = new UserFileRepository();
        $userFileRepository->create($user_id, $file_id, "");//no tag
        header('Location: /user');
      }

      header('Location: /user/');
    }

    public function logout() {
      session_destroy();
      header('Location: /');
    }
}
