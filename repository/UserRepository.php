<?php

require_once '../lib/Repository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class UserRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'user';

    /**
     * Erstellt einen neuen benutzer mit den gegebenen Werten.
     *
     * Das Passwort wird vor dem ausführen des Queries noch mit dem SHA1
     *  Algorythmus gehashed.
     *
     * @param $firstName Wert für die Spalte firstName
     * @param $lastName Wert für die Spalte lastName
     * @param $email Wert für die Spalte email
     * @param $password Wert für die Spalte password
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     */
    public function create($firstName, $lastName, $email, $password)
    {
        //TODO:
        $password = sha1($password); //password_hash

        $query = "INSERT INTO $this->tableName (firstName, lastName, email, password) VALUES (?, ?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ssss', $firstName, $lastName, $email, $password);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }

    public function login($username, $password) {
        $query = "SELECT password FROM $this->tableName WHERE name = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        if (!$statement){
          //TODO: bessere meldung
          echo "Ein Fehler ist aufgetreten";
        } else {
          $statement->bind_param('s', $username);
          $statement->execute();
          $statement->bind_result($db_password);
        }

        if (password_verify($password, $db_password)){
          echo "yo";
          //TODO: goto user-area
        }
        else {
          echo "no";
        }

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }
}
