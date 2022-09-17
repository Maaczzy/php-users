<?php
    require 'config.inc.php';

    readfile('header.tmpl.html');

    $message = '';

    if(isset($_POST['name']) && isset($_POST['password'])){
        $db = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
        $sql = sprintf("SELECT hash FROM users WHERE name='%s'",
                $db->real_escape_string($_POST['name']));
        $result = $db->query($sql);
        $row = $result->fetch_object();
        if($row != null){
            $hash = $row->hash;
            if(password_verify($_POST['password'], $hash)){
                $message = 'Login succesful.';
            } else {
                $message = 'Login failed.';
            }
    } else { 
        $message = 'Enter your credentials.';
    }
    $db->close();
    }
    echo "<div class='text-info'>$message</div>";
?>
<div class="container mt-5">
    <div class="row" style="align-items: center;">
        <div class="col-4" style="display: flex; justify-content: center;">
            <img src="img/hero.jpg" alt="Login" width="100%">
        </div>
        <div class="col-8">
            <h1 class="mb-3">Login</h1>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Username:</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password :</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>

<?php
    readfile('footer.tmpl.html');
?>