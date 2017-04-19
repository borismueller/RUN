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

     public function getFileIds($uid) {
           // Query erstellen
           $query = "SELECT file_id FROM {$this->tableName} WHERE user_id=?";

           // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
           // und die Parameter "binden"
           $statement = ConnectionHandler::getConnection()->prepare($query);
           $statement->bind_param('i', $uid);

           // Das Statement absetzen
           $statement->execute();

           // Resultat der Abfrage holen
           $result = $statement->get_result();
           if (!$result) {
               throw new Exception($statement->error);
           }

           // Datensätze aus dem Resultat holen und in das Array $rows speichern
           $rows = array();
           while ($row = $result->fetch_object()) {
               $rows[] = $row;
           }

           return $rows;
     }

     public function getUserId($fid) {
           // Query erstellen
           $query = "SELECT user_id FROM {$this->tableName} WHERE file_id=?";

           // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
           // und die Parameter "binden"
           $statement = ConnectionHandler::getConnection()->prepare($query);
           $statement->bind_param('i', $fid);

           // Das Statement absetzen
           $statement->execute();

           // Resultat der Abfrage holen
           $result = $statement->get_result();
           if (!$result) {
               throw new Exception($statement->error);
           }

           // Ersten Datensatz aus dem Reultat holen
           $row = $result->fetch_object();

           // Datenbankressourcen wieder freigeben
           $result->close();

           // Den gefundenen Datensatz zurückgeben
           return $row;
     }
 }
