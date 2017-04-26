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

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  public function search()
  {
    $query = "SELECT name FROM $this->tableName";

    $statement = ConnectionHandler::getConnection()->prepare($query);
    if (!$statement){
      throw new Exception($statement->error);
    } else {
      $result = $statement->execute();
    }

    $outp = "";
    while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
      if ($outp != "") {$outp .= ",";}
      $outp .= '{"name":"'  . $rs["name"] . '"}';
    }
    $outp ='{"records":['.$outp.']}';
    $conn->close();

    echo($outp);
    throw new Exception("Error Processing Request", 1);

  }
}
