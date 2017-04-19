<?php

 require_once '../lib/Repository.php';

 /**
  * Das FileRepository ist zuständig für alle Zugriffe auf die Tabelle "file".
  *
  * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
  */
 class UserFileRepository extends Repository
 {
     protected $tableName = 'user_file';

   //TODO: insert in den relevanten Tabellen
   public function create($user_id, $file_id, $tag) {
       $query = "INSERT INTO $this->tableName (user_id, file_id, tag) VALUES (?, ?, ?)";

       $statement = ConnectionHandler::getConnection()->prepare($query);
       if (!$statement){
         //TODO: bessere meldung
         echo "Ein Fehler ist aufgetreten";
       } else {
         $statement->bind_param('iis', $user_id, $file_id, $tag);
         $statement->execute();
       }

       return $statement->insert_id;
   }
 }
