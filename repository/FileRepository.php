<?php

 require_once '../lib/Repository.php';

 /**
  * Das FileRepository ist zuständig für alle Zugriffe auf die Tabelle "file".
  *
  * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
  */
 class FileRepository extends Repository
 {
     protected $tableName = 'file';

   //TODO: insert in den relevanten Tabellen
   public function create($name, $tags, $path) {
       $query = "INSERT INTO $this->tableName (name, tags, path) VALUES (?, ?, ?)";

       $statement = ConnectionHandler::getConnection()->prepare($query);
       if (!$statement){
         //TODO: bessere meldung
         echo "Ein Fehler ist aufgetreten";
       } else {
         $statement->bind_param('sss', $name, $tags, $path);
         $statement->execute();
       }

       if (!$statement->execute()) {
           throw new Exception($statement->error);
       }

       return $statement->insert_id;
   }
 }
