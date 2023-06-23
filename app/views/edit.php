<?php include('header.php') ?>

<div class="card" style="width: 38rem; height: 22rem; margin-bottom: 10px" id='center'>
    <div class="card-body" style='padding-top: 50px'>
        <h3>Update Song</h3>
        <form method="post" action="index.php?action=update">
        <input type="hidden" name="id" value="<?php echo $song['id']; ?>">
            <div class="form-group">
                <input type="text" name="title" class="form-control" id="input-style" placeholder="Title" value="<?php echo $song['title']; ?>">
            </div>
            <div class="form-group">
                <input name="author" class="form-control" id="input-style" placeholder="Author" value="<?php echo $song['author']; ?>">
            </div>
            <div class="form-group">
                <input name="genre" class="form-control" id="input-style" placeholder="Genre" value="<?php echo $song['genre']; ?>">
            </div>
            

            <button type="submit" class="btn" id='input-style' style='background-color: #9583B4; color: white'>Update Song</button>
            <a href="index.php?action=home" style="margin-top: 20px; font-size: 14px; color: #7783B4">Cancel</a>
        </form>
  </div>
</div> 
    </form>
</body>
</html>
