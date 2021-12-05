<?php
require_once("NeoQuery.php");

$neoQuery = new NeoQuery();

if(isset($_POST['submitLogin']) && $_POST['submitLogin']) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $results = $neoQuery->validateLogin($login, $password);
    if(count($results) != 0) {
        $_SESSION['loggedInId'] = $results[0]['id'];
        header('Location: myBooks.php');
    } else {
        header('Location: login.php');
    }
    
} else if(isset($_POST['submitRegister']) && $_POST['submitRegister']) {
    $name = $_POST['name'];
    $birth_year = $_POST['birth_year'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if($password == $password2) {
        $neoQuery->addUser($name, $birth_year, $login, $password);
    }
    header('Location: login.php');
} else if(isset($_POST['submitLogOut']) && $_POST['submitLogOut']) {
    unset($_SESSION['loggedInId']);
    header('Location: login.php');
} else if(isset($_POST['submitAddBookToLiked']) && $_POST['submitAddBookToLiked']) {
    $bookId = $_POST['bookId'];
    $userId = $_SESSION['loggedInId'];
    $neoQuery->addBookToLiked($userId, $bookId);
    header('Location: myBooks.php');
} else if(isset($_POST['submitDeleteBookFromLiked']) && $_POST['submitDeleteBookFromLiked']) {
    $bookId = $_POST['bookId'];
    $userId = $_SESSION['loggedInId'];
    $neoQuery->deleteBookFromLiked($userId, $bookId);
    header('Location: myBooks.php');
} else if(isset($_POST['submitAddBook']) && $_POST['submitAddBook']) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];

    $neoQuery->addBook($title, $author, $genre);
    header('Location: allBooks.php');
} else {
    header('Location: login.php');
}



