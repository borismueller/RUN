<?php

require_once '../lib/Repository.php';

/**
* Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
*
* Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
*/
class ProductRepository extends Repository
{
  /**
  * Diese Variable wird von der Klasse Repository verwendet, um generische
  * Funktionen zur Verfügung zu stellen.
  */
  protected $tableName = 'product';


  public function readByName($name)
  {
    // Query erstellen
    $query = "SELECT * FROM {$this->tableName} WHERE name=?";

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
