<?php

    require 'AbstractController.php';
    
    class UserController extends AbstractController {
    private UserManager $manager;
    
    public function __construct(UserManager $manager)
    {
        $this->manager = $manager;
    }
    // public function getManager() : UserManager
    // {
    //     return $this->manager;
    // }
    // public function setManager(UserManager $manager) : void
    // {
    //     $this->manager = $manager;
    // }
    
    public function index()
    {
        $users = $this->manager->getAllUsers();
        $this->render('users/index.phtml', $users);
    }
    
    public function create(array $post)
    {
        $this->render('users/create.phtml', $post);
        
        if(isset($_POST['submitCreate']))
        {
            if(!empty($post['password']) && $post['password'] === $post['confirmPassword'])
            {
                $passwordHash = password_hash($post['password'], PASSWORD_DEFAULT);
                $user = new User($post['username'], $post['email'], $passwordHash);
                $this->manager->insertUser($user);
            }
        }
    }
    
    public function edit(array $post)
    {
        $this->render('users/edit.phtml', $post);
        // var_dump($_POST);
        if(isset($_POST['submitEdit']))
        {
            if(!empty($post['password']) && $post['password'] === $post['confirmPassword'])
            {
                $passwordHash = password_hash($post['password'], PASSWORD_DEFAULT);
                $user = new User($post['username'], $post['email'], $passwordHash);
                $user->setId($post['id']);
                $this->manager->editUser($user);
            }
        }
    }
}
    
    // class UserController extends AbstractController {
    //     private $manager;
    
    //     public function __construct(UserManager $manager) {
    //         $this->manager = $manager;
    //     }
    
    //     public function index(): void {
    //         $users = $this->manager->getAllUsers();
    //         $this->render('users/index.phtml', ['users' => $users]);
    //     }
    
    //     public function create(array $post): void {
    //         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //             // Traiter le formulaire de création ici
    //             // Utiliser les champs présents dans $post pour créer un nouvel User via $this->manager
    //         }
    
    //         $this->render('users/create.phtml', []);
    //     }
    
    //     public function edit(array $post): void {
    //         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //             // Traiter le formulaire de modification ici
    //             // Utiliser les champs présents dans $post pour modifier l'User via $this->manager
    //         }
    
    //         $this->render('users/edit.phtml', []);
    //     }
    // }
?>