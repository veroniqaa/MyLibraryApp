<?php

session_start();

require_once(__DIR__.'/vendor/autoload.php');

use Laudis\Neo4j\Authentication\Authenticate;
use Laudis\Neo4j\ClientBuilder;
  
class NeoQuery  {

    private $client;

    public function __construct() {

        $uri = 'neo4j+s://76ad7489.databases.neo4j.io';
        $user = 'neo4j';
        $password = 'c1RqktcZaX-F6kBbiccJ-h8lVpcI0dLsi61tDx1pwKU';

        $this->client = ClientBuilder::create()
                    ->withDriver('neo4j', $uri, Authenticate::basic($user, $password)) 
                    ->build();
    }

    public function validateLogin($login, $password) {
        $query = '  MATCH (u:User) WHERE u.login = "'.$login.'" AND u.haslo = "'.md5($password).'" 
                    RETURN ID(u) as id';
        $results = $this->client->run($query);
        return $results;
        
    }

    public function addUser($name, $birth_year, $login, $password) {
        $query = "  CREATE (:User {
                            imie: '".$name."',  
                            rok_ur: ".$birth_year.", 
                            login: '".$login."', 
                            haslo: '".md5($password)."'
                        })";

        $results = $this->client->run($query);
    }

    public function getAllUsers() {
        $results = $this->client->run('MATCH (u:User) RETURN u.imie as imie, u.nazwisko as nazwisko');
        return $results; 
    }

    public function getAllBooks() {
        $results = $this->client->run('MATCH (b:Book) RETURN DISTINCT ID(b) as id, b.tytul as title, b.autor as author, b.gatunek as genre');
        return $results;
    }

    public function getLikedBooks($userId) {
        $query = "  MATCH (u:User)--(b:Book) 
                    WHERE id(u) = ".$userId."
                    RETURN ID(b) as id, b.tytul as title, b.autor as author, b.gatunek as genre";
        $results = $this->client->run($query);
        return $results;
    }

    public function addBookToLiked($userId, $bookId) {
        $query = "  MATCH
                        (u:User),
                        (b:Book)
                    WHERE ID(u) = ".$userId." AND ID(b) = ".$bookId."
                    CREATE (u)-[r:Likes]->(b)
                    RETURN type(r)";

        $results = $this->client->run($query);

    }

    public function deleteBookFromLiked($userId, $bookId) {
        $query = "  MATCH 
                        (u:User)-[r:Likes]->(b:Book)
                    WHERE ID(u) = ".$userId." AND ID(b) = ".$bookId." 
                    DELETE r";

        $results = $this->client->run($query);
    }

    public function getAllUserRecommendations($userId) {
        $query = "  MATCH (user:User)-[:Likes]->(book)<-[:Likes]-(u:User)-[:Likes]->(b:Book) 
                    WHERE ID(user) = ".$userId." AND NOT ((user)-[:Likes]-(b))
                    RETURN DISTINCT ID(b) as id, b.tytul as title, b.autor as author, b.gatunek as genre";
        $results = $this->client->run($query);
        return $results;
    }

    public function getRecommendationsOnBook($userId, $bookId) {
        $query = "  MATCH (book:Book)<-[:Likes]-(u:User)-[:Likes]->(b:Book)
                    MATCH (me:User)
                    WHERE ID(book) = ".$bookId." AND ID(me) = ".$userId." AND NOT ((me)-[:Likes]-(b))
                    RETURN DISTINCT ID(b) as id, b.tytul as title, b.autor as author, b.gatunek as genre";
        
        $results = $this->client->run($query);
        return $results;
    }

    public function checkIfUserLikesBook($userId, $bookId) {
        $query = "  MATCH (u:User)-[r:Likes]->(b:Book)
                    WHERE ID(u) = ".$userId." AND ID(b) = ".$bookId."
                    RETURN r";
        $results = $this->client->run($query);
        if(count($results)>0) return 1;
        else return 0;
    }

    public function getBook($bookId) {
        $query = "  MATCH (b:Book) 
                    WHERE ID(b) = ".$bookId."
                    RETURN DISTINCT ID(b) as id, b.tytul as title, b.autor as author, b.gatunek as genre";

        $results = $this->client->run($query);
        return $results;
    }
    
    public function addBook($title, $author, $genre) {
        $query = "  CREATE (:Book {
                        tytul: '".$title."',  
                        autor: '".$author."', 
                        gatunek: '".$genre."'
                    })";
        $results = $this->client->run($query);
    }

} 
