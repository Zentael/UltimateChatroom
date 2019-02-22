<?php
require_once('Connection.class.php');

Class Chatroom
{
    public $id;
    public $name;
    public $user_id;

    public $errors = [];

    public function __construct($id = null)
    {
        if (!is_null($id)) {
            $this->get($id);
        }
    }

    public function get($id = null)
    {
        if (!is_null($id)) {
            $dbh = Connection::get();
            //print_r($dbh);

            $stmt = $dbh->prepare("select * from chatrooms where user_id = :user_id");
            $stmt->execute(array(
                ':user_id' => $id
            ));
            // recupere les users et fout le resultat dans une variable sous forme de tableau de tableaux
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Chatroom');
            $user = $stmt->fetch();

            $this->id = $user->id;
            $this->name = $user->name;
            $this->user_id = $user->user_id;

        }
    }

    public function validate($data)
    {
        $this->errors = [];

        /* required fields */
        if (!isset($data['user_id'])) {
            $this->errors[] = 'champ user id vide';
        }

        /* tests de formats */
        if (isset($data['name'])) {
            if (empty($data['name'])) {
                $this->errors[] = 'champ nom vide';
                // si name > 50 chars
            } else if (mb_strlen($data['name']) > 150) {
                $this->errors[] = 'champ nom trop long (150max)';
            }
        }

        if (count($this->errors) > 0) {
            return false;
        }
        return true;
    }


    public function create($data)
    {
        if ($this->validate($data)) {
            if(isset($data['user_id']) && !empty($data['user_id'])){
                // update
            }
            $dbh = Connection::get();
            $sql = "insert into chatrooms (name, user_id) values (:name, :user_id)";
            $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            if ($sth->execute(array(
                ':name' => $data['name'],
                ':user_id' => $data['user_id']
            ))) {
                return true;
            } else {
                $this->errors['pas reussi a creer la chatroom'];
            }
        }
        return false;
    }
}