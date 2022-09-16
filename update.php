<?php
    if(isset($_GET['id']) && ctype_digit($_GET['id'])){
        $id = $_GET['id'];
    } else {
        header('Location: select.php');
    }

    $name = '';
    $gender = '';
    $color = '';

    if(isset($_POST['submit'])){
        $ok = true;

        if(!isset($_POST['name']) || $_POST['name'] === ''){
            $ok = false;
        } else{
            $name = $_POST['name'];
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
            $db = new mysqli('php.test', 'root', '', 'php');
            $sql = sprintf("UPDATE users SET name = '%s', gender='%s', color='%s' WHERE id=%s",
                            $db->real_escape_string($name),
                            $db->real_escape_string($gender),
                            $db->real_escape_string($color),
                            $id);
            $db->query($sql);
            echo '<p>User updated.</p>';
            $db->close();
        }
    } else {
        $db = new mysqli('php.test', 'root', '', 'php');
        $sql = "SELECT * FROM users WHERE id=$id";
        $result = $db->query($sql);
        foreach ($result as $row){
            $name = $row['name'];
            $gender = $row['gender'];
            $color = $row['color'];
        }
        $db->close();
    }
    readfile('header.tmpl.html');
?>

<!-- <form action="" method="post">
    User Name: <input type="text" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES); ?>"><br>
    Gender: 
    <input type="radio" name="gender" value="f" <?php if($gender === 'f'){echo ' checked';} ?>> Female
    <input type="radio" name="gender" value="m" <?php if($gender === 'm'){echo ' checked';} ?>> Male
    <input type="radio" name="gender" value="o" <?php if($gender === 'o'){echo ' checked';} ?>> Other <br>
    Favourite color:
    <select name="color">
        <option value="">Please select</option>
        <option value="#F00"<?php 
        if($color === '#F00'){
            echo ' selected';
        }
        ?>>Red</option>
        <option value="#0F0" <?php 
        if($color === '#0F0'){
            echo ' selected';
        } 
        ?>>Green</option>
        <option value="#00F" <?php 
        if($color === '#00F'){
            echo ' selected';
        } 
        ?>>Blue</option>
    </select><br>
    <input type="submit" name="submit" value="Update">
</form> -->

<div class="container mt-5">
    <div class="row" style="align-items: center;">
        <div class="col-4" style="display: flex; justify-content: center;">
            <img src="img/hero.jpg" alt="Register" width="100%">
        </div>
        <div class="col-8">
            <h1 class="mb-3">Register user</h1>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Username:</label>
                    <input type="text" class="form-control" name="name" id="name" aria-describedby="usernameField" value="<?php echo htmlspecialchars($name, ENT_QUOTES); ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password :</label>
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
                <button type="submit" name="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

<?php
readfile('footer.tmpl.html');
?>