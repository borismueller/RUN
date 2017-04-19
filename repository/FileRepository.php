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

     public function getId($name)
     {
         // Query erstellen
         $query = "SELECT id FROM {$this->tableName} WHERE name=?";

         // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
         // und die Parameter "binden"
         $statement = ConnectionHandler::getConnection()->prepare($query);
         $statement->bind_param('s', $name);

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
