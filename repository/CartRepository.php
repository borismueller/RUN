<?php

require_once '../lib/Repository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class CartRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'cart';

		public function create($user_id, $product_id) {
			$query = "INSERT INTO $this->tableName (user_id, product_id) VALUES (?, ?)";

			$statement = ConnectionHandler::getConnection()->prepare($query);
			if (!$statement){
				throw new Exception($statement->error);
			} else {
				$statement->bind_param('ii', $user_id, $product_id);
				$statement->execute();
			}

			return $statement->insert_id;
		}
}
