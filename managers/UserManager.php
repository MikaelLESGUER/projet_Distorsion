<?php

require 'AbstractManager.php';

class UserManager extends AbstractManager {
    
    public function getAllUsers() : array
    {
        $query = $this->db->prepare("SELECT * FROM users");
        $query->execute();
        $array = $query->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }
    
    public function getUserById(int $id) : User
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE users.id = :id");
        $parameters = ["id" => $id];
        $query->execute($parameters);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
    
    // public function getUserByEmail(string $email) : User
    // {
    //     $query = $this->db->prepare("SELECT * FROM users WHERE users.email = :email");
    //     $parameters = ['email' => $email];
    //     $query->execute($parameters);
    //     $user = $query->fetch(PDO::FETCH_ASSOC);
    //     return $user;
    // }
    
    public function insertUser(User $user) : User
    {
        $query = $this->db->prepare("INSERT INTO users (email, username, password)
                               VALUES (?, ?, ?)");
        $query->execute([$user->getEmail(), $user->getUsername(), $user->getPassword()]);
        $query = $this->db->prepare("SELECT * FROM users WHERE users.email = :email");
        $parameters = ['email' => $user->getEmail()];
        $query->execute($parameters);
        $userId = $query->fetch(PDO::FETCH_ASSOC);
        $user->setId($userId['id']);
        return $user;
    }
    
    public function editUser(User $user) : void
    {
        $query = $this->db->prepare("UPDATE users SET users.username = :username, users.email = :email, users.password = :password WHERE users.id = :id");
        $parameters = [
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'id' => $user->getId()
        ];
        $query->execute($parameters);
    }
}

    // class UserManager extends AbstractManager {
        
    //     public function getAllUsers(): array {
    //         // Récupérer la liste de tous les utilisateurs depuis la base de données
    //         // $query = "SELECT * FROM users";
    //         // $stmt = $this->db->query($query);
    //         // $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    //         // return $users;
    //         $query = $this->db->prepare("SELECT * FROM users");
    //         $query->execute();
    //         $array = $query->fetchAll(PDO::FETCH_ASSOC);
    //         return $array;
    //     }
    
    //     public function getUserById(int $id): User {
    //         // Récupérer l'utilisateur correspondant à l'id depuis la base de données
    //         // $query = "SELECT * FROM users WHERE id = :id";
    //         // $stmt = $this->db->prepare($query);
    //         // $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    //         // $stmt->execute();
    //         // $user = $stmt->fetch(PDO::FETCH_ASSOC);
    //         $query = $this->db->prepare("SELECT * FROM users WHERE users.id = :id");
    //         $parameters = ["id" => $id];
    //         $query->execute($parameters);
    //         $user = $query->fetch(PDO::FETCH_ASSOC);
    
    //         return $user;
    //     }
    
    //     public function insertUser(User $user): User {
    //         // Insérer l'utilisateur dans la base de données et récupérer son nouvel $id
    //         // Utilisez les informations de $user pour exécuter la requête d'insertion appropriée
    
    //         // Exemple de requête :
    //         // $query = "INSERT INTO users (email, username, password) VALUES (:email, :username, :password)";
    //         // $stmt = $this->db->prepare($query);
    //         // $stmt->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
    //         // $stmt->bindValue(':username', $user->getUsername(), PDO::PARAM_STR);
    //         // $stmt->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
    //         // $stmt->execute();
    
    //         // Après l'insertion, récupérez le nouvel $id généré et mettez-le à jour dans l'objet User
    //         // Utilisez $this->db->lastInsertId() pour récupérer l'id
    
    //         return $user;
    //     }
    
    //     public function editUser(User $user): void {
    //         // Modifier l'utilisateur dans la base de données
    //         // Utilisez les informations de $user pour exécuter la requête de modification appropriée
    
    //         // Exemple de requête :
    //         // $query = "UPDATE users SET email = :email, username = :username, password = :password WHERE id = :id";
    //         // $stmt = $this->db->prepare($query);
    //         // $stmt->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
    //         // $stmt->bindValue(':username', $user->getUsername(), PDO::PARAM_STR);
    //         // $stmt->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
    //         // $stmt->bindValue(':id', $user->getId(), PDO::PARAM_INT);
    //         // $stmt->execute();
    //     }
    // }
?>