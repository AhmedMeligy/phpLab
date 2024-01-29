<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'task';
$link = mysqli_connect( $dbhost, $dbuser, $dbpass, $dbname);

if(! $link ) {
    die('Could not connect: ' . mysqli_error($conn));
};
$id = $_GET["id"];
$query = "SELECT * FROM emp WHERE id='$id'";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$email = $row['email'];
$gender = $row['gender'];
$check = $row['recive_email'];

$errors = [];

if (isset($_POST["name"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
    $check = isset($_POST["check"]) ? 'yes' : 'no';

    $errors = [];

    if (empty($name)) {
        $errors['name'] = 'Name is required.';
    }
    if (empty($email)) {
        $errors['email'] = 'Email is required.';
    }
    if (empty($gender)) {
        $errors['gender'] = 'Gender is required.';
    }

    if (!isset($_POST["check"])) {
        $check = 'no';
    } else {
        $check = 'yes';
    }

    if (empty($errors)) {
        $query = "UPDATE emp SET name='$name', email='$email', gender='$gender', recive_email='$check' WHERE id='$id'";
        $result = mysqli_query($link, $query);

        if ($result) {
            echo "<h1>Data has been updated in the database.</h1>";
            header("refresh:2;url=task2.php");
        } else {
            echo "<h1>Error inserting data into the database: " . mysqli_error($link) . "</h1>";
        }
    }
}

mysqli_close($link);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background: linear-gradient(to right, #e2e2e2, #15476b);
        }

        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            height: 50%;
            width: 30%;
            border-radius: 5%;
            background-color: rgb(209, 209, 234);
            box-shadow: 3px 3px 3px;
        }

        form {
            display: table;
            width: 100%;
            font-size: 25px;
        }

        p {
            display: table-row;
        }

        label, input, select, textarea {
            display: table-cell;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            vertical-align: top;
        }

        label {
            margin-bottom: 0; 
            
        }

        input[type="radio"], input[type="checkbox"] {
            margin-right: 5px;
            vertical-align: middle; 
        }

        span.required, h4 {
            color: red;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error{
            color: red;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update User Data form</h1>
        <h4>please fill this form and submit to update user record in database</h4>
        <form action="<?php $_PHP_SELF ?>" method= "POST">
            <p>
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value=<?php echo isset($name) ? $name : ''; ?>><span class="required">*</span>
                <?php if (!empty($errors['name'])) : ?>
                <span class="error"><?php echo $errors['name']; ?></span>
                <?php endif; ?>
            </p>
            <p>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value=<?php echo isset($email) ? $email : ''; ?> ><span class="required">*</span>
                <?php if (!empty($errors['email'])) : ?>
                <span class="error"><?php echo $errors['email']; ?></span>
                <?php endif; ?>
            </p>
            <p>
                <label for="gender">Gender:</label>
                <span>
                    <label for="female">Female</label>
                    <input type="radio" name="gender" id="female" value="female" <?php echo ($gender === 'female') ? 'checked' : ''; ?>>
                    <label for="male">Male</label>
                    <input type="radio" name="gender" id="male" value="male" <?php echo ($gender === 'male') ? 'checked' : ''; ?>>
                    <span class="required">*</span>
                    <?php if (!empty($errors['gender'])) : ?>
                    <span class="error"><?php echo $errors['gender']; ?></span>
                    <?php endif; ?>
                </span>
            </p>
            <p>
                <label for="check">Recive E-mails from us</label>
                <input type="checkbox" name="check" id="check" <?php echo ($check == 'yes') ? 'checked' : ''; ?>>
                <br>
                <input type="submit" name="Submit" id="submit">
            </p>
        </form>
    </div>
</body>
</html>
