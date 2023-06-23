<?php include 'header.php'; ?>
    <div class="card" style="width: 38rem; height: 22rem; margin-bottom: 10px" id='center'>
    <div class="card-body" style='padding-top: 50px'>
        <h3>Song Management Application</h3>
        <h5 class="card-title">Login</h5>
        <form method="POST" action="index.php?action=login">
            <div class="form-group">
                <input type="text" name="username" class="form-control" id="input-style" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" id="input-style" placeholder="Password">
            </div>

            

            <button type="submit" class="btn" id='input-style' style='background-color: #9583B4; color: white'>Login</button>
            <a href="index.php?action=register" style="margin-top: 20px; font-size: 14px; color: #7783B4">Don't have an account? Register now!</a>
        </form>
  </div>
</div> 
    </form>
</body>
</html>
