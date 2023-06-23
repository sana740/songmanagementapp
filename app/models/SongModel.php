<?php

require_once 'config/database.php';

class SongModel
{
    private $db;
    
    public function __construct()
    {
        $this->db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($this->db->connect_errno) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }
    
    public function getAllSongs()
    {
        $query = "SELECT * FROM songs where user_id = ".$_SESSION['userId'];
        $result = $this->db->query($query);
        $songs = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $songs[] = $row;
            }
        }
        return $songs;
    }

    public function addSong($author, $title, $genre, $track, $user_id)
    {
        // Prepare the insert query
        $query = "INSERT INTO songs (author, title, genre, track, user_id) VALUES (?, ?, ?, ?, ?)";
        
        // Prepare the statement
        $statement = $this->db->prepare($query);
        
        // Bind the parameters
        $statement->bind_param("ssssi", $author, $title, $genre, $track, $user_id);
        
        // Execute the query
        $result = $statement->execute();
        
        // Check if the query was successful
        if ($result) {
            // Query executed successfully
            return true;
        } else {
            // Error occurred during execution
            return false;
        }
    }

    public function deleteSong($songId)
{
    // Prepare the delete query
    $query = "DELETE FROM songs WHERE id = ?";
    
    // Prepare the statement
    $statement = $this->db->prepare($query);
    
    // Bind the parameter
    $statement->bind_param("i", $songId);
    
    // Execute the query
    $result = $statement->execute();
    
    // Check if the query was successful
    if ($result) {
        // Query executed successfully
        return true;
    } else {
        // Error occurred during execution
        return false;
    }
}

public function updateSong($songId, $title, $author, $genre)
{
    // Prepare the update query
    $query = "UPDATE songs SET title = ?, author = ?, genre = ? WHERE id = ?";
    
    // Prepare the statement
    $statement = $this->db->prepare($query);
    
    // Bind the parameters
    $statement->bind_param("sssi", $title, $author, $genre, $songId);
    
    // Execute the query
    $result = $statement->execute();
    
    // Check if the query was successful
    if ($result) {
        // Query executed successfully
        return true;
    } else {
        // Error occurred during execution
        return false;
    }
}

public function searchSongs($searchQuery)
{
    // Prepare the select query
    $query = "SELECT * FROM songs WHERE title LIKE ? OR author LIKE ? OR genre LIKE ?";
    
    // Prepare the statement
    $statement = $this->db->prepare($query);
    
    // Bind the parameters
    $searchParam = "%$searchQuery%";
    $statement->bind_param("sss", $searchParam, $searchParam, $searchParam);
    
    // Execute the query
    $statement->execute();
    
    // Get the result
    $result = $statement->get_result();
    
    // Fetch all songs
    $songs = $result->fetch_all(MYSQLI_ASSOC);
    
    return $songs;
}



public function getSongById($songId)
{
    // Prepare the select query
    $query = "SELECT * FROM songs WHERE id = ?";
    
    // Prepare the statement
    $statement = $this->db->prepare($query);
    
    // Bind the parameter
    $statement->bind_param("i", $songId);
    
    // Execute the query
    $statement->execute();
    
    // Get the result
    $result = $statement->get_result();
    
    // Fetch the song details
    $song = $result->fetch_assoc();
    
    return $song;
}


 }
