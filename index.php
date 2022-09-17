<?php
    require 'config.inc.php';
    readfile('header.tmpl.html');

    $name = '';
    $gender = '';
    $color = '';
    $password = '';

    if(isset($_POST['submit'])){
        $ok = true;

        if(!isset($_POST['name']) || $_POST['name'] === ''){
            $ok = false;
        } else{
            $name = $_POST['name'];
        };
        if(!isset($_POST['password']) || $_POST['password'] === ''){
            $ok = false;
        } else {
            $password = $_POST['password'];
        };
        if(!isset($_POST['gender']) || $_POST['gender'] === ''){
            $ok = false;
        } else{
            $gender = $_POST['gender'];
        };
        if(!isset($_POST['color']) || $_POST['color'] === ''){
            $ok = false;
        } else {
            $color = $_POST['color'];
        };

        if($ok){
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $db = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
            $sql = sprintf("INSERT INTO users (name, gender, color, hash) VALUES ('%s', '%s', '%s', '%s')", 
                            $db->real_escape_string($name),
                            $db->real_escape_string($gender),
                            $db->real_escape_string($color),
                            $db->real_escape_string($hash));
            $db->query($sql);
            echo '<p>User added.</p>';
            $db->close();
        }
    }
?>

<div class="container mt-5">
    <div class="row" style="align-items: center;">
        <div class="col-4" style="display: flex; justify-content: center;">
            <img src="img/hero.png" alt="Register" width="100%">
        </div>
        <div class="col-8">
            <h1 class="mb-3">Register user</h1>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Username:</label>
                    <input type="text" class="form-control" name="name" id="name" aria-describedby="usernameField" value="<?php echo htmlspecialchars($name, ENT_QUOTES); ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password :</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <div class="mb-3">
                    <input class="form-check-input" type="radio" name="gender" id="maleGender" value="m" <?php if($gender === 'm'){echo ' checked';} ?>>
                    <label class="form-check-label" for="maleGender">
                        Male
                    </label>
                    <input class="form-check-input" type="radio" name="gender" id="femaleGender" value="f" <?php if($gender === 'f'){echo ' checked';} ?>>
                    <label class="form-check-label" for="femaleGender">
                        Female
                    </label>
                    <input class="form-check-input" type="radio" name="gender" id="otherGender" value="o" <?php if($gender === 'o'){echo ' checked';} ?>>
                    <label class="form-check-label" for="otherGender">
                        Other
                    </label>
                </div>
                <div class="mb-3">
                    <select class="form-select" name="color" aria-label="Default select example">
                        <option selected>Please select</option>
                        <option value="#F00"<?php if($color === '#F00'){
                            echo ' selected';
                        }
                        ?>>Red</option>
                        <option value="#0F0" <?php if($color === '#0F0'){
                            echo ' selected';
                        }
                        ?>>Green</option>
                        <option value="#00F" <?php if($color === '#00F'){
                            echo ' selected';
                        }
                        ?>>Blue</option>
                    </select>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>

<?php
    readfile('footer.tmpl.html');
?>