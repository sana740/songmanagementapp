<?php

require_once 'app/models/SongModel.php';

class SongController
{
    private $songModel;
    
    public function __construct()
    {
        $this->songModel = new SongModel();
    }

    public function index() {
        $songs = [];
        if($_SESSION['userId']) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
                $searchQuery = $_GET['search'];
                
                $songs = $this->songModel->searchSongs($searchQuery);
            } else {
                // Retrieve all songs
                $songs = $this->songModel->getAllSongs();
            }
        } else {
            echo "you're not logged in";
            header('Location: index.php?action=login');
        }
        require_once 'app/views/index.php'; 
    }
    
    public function editSong()
{
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $songId = $_GET['id'];
        $song = $this->songModel->getSongById($songId);
        if ($song) {
            require_once "app/views/edit.php";
        } else {
            echo "Song not found.";
        }
    }
}

public function updateSong()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        $songId = $_POST['id'];
        $title = $_POST['title'];
        $genre = $_POST['genre'];
        $author = $_POST['author'];
        $result = $this->songModel->updateSong($songId, $title, $author, $genre);
        
        if ($result) {
            // Song updated successfully
            echo "Song updated!";
            header('Location: index.php?action=home');
        } else {
            // Error occurred
            echo "Failed to update song.";
        }
        echo "<meta http-equiv='refresh' content='1'>";
    }
}


    public function addSong()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $author = $_POST['author'];
            $title = $_POST['title'];
            $genre = $_POST['genre'];
            $file = $_FILES['file'];
            $user_id = $_SESSION['userId'];
            
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];

            if($fileError == UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                $uploadPath = $uploadDir . uniqid(). '_' . $fileName;
                move_uploaded_file($fileTmpName, $uploadPath);
            
            $result = $this->songModel->addSong($author, $title, $genre, $uploadPath, $user_id);
            
            if ($result) {
                // Song added successfully
                echo "Song added!";
                header('Location: index.php?action=home');
            } else {
                // Error occurred
                echo "Failed to add song.";
            }
        } else {
            echo 'File upload failed';
        }
        }
        
        // Render the add song form
        require_once 'app/views/index.php';
    }

    public function delete()
{
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $songId = $_GET['id'];
        
        $result = $this->songModel->deleteSong($songId);
        
        if ($result) {
            // Song deleted successfully
            echo "Song deleted!";
            header('Location: index.php?action=home');
        } else {
            echo "Failed to delete song.";
        }
    }
}

}
?>