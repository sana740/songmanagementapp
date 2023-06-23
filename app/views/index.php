<?php include 'header.php'; ?>
    <h2 style="margin-top: 6%">Song Management System</h2>
    <div class="card" id='center' style="margin-left:20%; margin-right: 20%; margin-top: 1%">
        <div class="card-body">
            <h5 class="card-title" style="font-weight: bold">All Songs</h5>
            <button type="button" id='input-style' class="btn" data-toggle="modal" data-target="#addSongModal" style='background-color: #9583B4; color: white; margin-bottom: 20px'>
              Add New Song
            </button>
            <form method="get" action="index.php?action=index">
              <input type="hidden" name="action" value="search">
            <div class="form-group">
              <input type="text" id='input-style' class="form-control" name="search" placeholder="Search songs">
        </div>
            <button type="submit" class="btn" style='background-color: #9583B4; color: white; margin-bottom: 20px'>Search</button>
    </form>


            <table class='table'>
                <tr>
                    <!-- <th>ID</th> -->
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Track</th>
                    <th>Actions</th>
                </tr>
                <?php foreach($songs as $s) : ?>
                <tr>
                <!-- <td><?php echo $s['id'] ?></td> -->
                    <td><?php echo $s['title'] ?></td>
                    <td><?php echo $s['author'] ?></td>
                    <td><?php echo $s['genre'] ?></td>
                    <td>
                        <?php if ($s['track']): ?>
                            <a href="<?php echo $s['track']; ?>" target="_blank">Download</a>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>
                    <td>
                      <a href="index.php?action=delete&id=<?php echo $s['id']; ?>" onclick="return confirm('Are you sure you want to delete this song?')">Delete</a>
                      <a href="index.php?action=edit&id=<?php echo $s['id']; ?>">Edit</a>
                  </td>
                    </tr>
                <?php endforeach; ?>
               
    </table>
    <a href="index.php?action=logout" style="text-align: center">logout</a>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addSongModal" tabindex="-1" role="dialog" aria-labelledby="addSongModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSongModalLabel">Create New Song</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form enctype="multipart/form-data" action="index.php?action=addSong" method="POST">
        <input type="hidden" name="id" value="">
        <input type="text" id='input-style' class="form-control" placeholder="Title" name='title' style="width: 90%"><br />

        <input type="text" id='input-style' class="form-control" placeholder="Artist" name="author" style="width: 90%"/><br />

        <input type="text" id='input-style' class="form-control" placeholder="Genre" name="genre" style="width: 90%"/><br />

        <label for="file">MP3 File:</label>
        <input type="file" name="file" id="file" required accept=".mp3">
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        <input type="submit" class="btn btn-primary" value='Add Song' style='background-color: #9583B4; color: white;' />
      </div>
      </form>
    </div>
  </div>
</div>    
</body>
</html>