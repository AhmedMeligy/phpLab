<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        
        *{
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        }

        
        body {
            background: linear-gradient(to right, #e2e2e2, #15476b);
        }
        h1{
            display: inline;
            font-family: Arial, Helvetica, sans-serif;
        }
        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            height: 50%;
            width: 40%;
            border-radius: 5%;
            background-color: rgb(209, 209, 234);
            box-shadow: 3px 3px 3px;
            overflow: auto;
            
        }
        #add {
        width: 130px;
        font-size: 15px;
        font-family: Arial, Helvetica, sans-serif;
        font-weight: 600;
        color: #fff;
        cursor: pointer;
        margin: 20px;
        height: 55px;
        text-align:center;
        border: none;
        background-size: 300% 100%;
        border-radius: 50px;
        moz-transition: all .4s ease-in-out;
        -o-transition: all .4s ease-in-out;
        -webkit-transition: all .4s ease-in-out;
        transition: all .4s ease-in-out;
        margin-left:350px;
        }

        #add:hover {
        background-position: 100% 0;
        moz-transition: all .4s ease-in-out;
        -o-transition: all .4s ease-in-out;
        -webkit-transition: all .4s ease-in-out;
        transition: all .4s ease-in-out;
        }

        #add:focus {
        outline: none;
        }

        #add {
        background-image: linear-gradient(
            to right,
            #0ba360,
            #3cba92,
            #30dd8a,
            #2bb673
        );
        box-shadow: 0 4px 15px 0 rgba(23, 168, 108, 0.75);
        }
        thead{
            background-color:Black;
            color:white;
        }
        .fa-pen-to-square{
            margin:2px;
        }
        tbody{
            text-align:center;
            
        }
        .fl-table {
        width: 100%;
        margin-top: 20px; /* Adjust the margin as needed */
        border-collapse: collapse;
        text-align: left;
        }
        .fl-table thead th {
        background-color: Black;
        color: white;
    }

    .fl-table td, .fl-table th {
        padding: 8px;
        border: 1px solid #ddd;
    }

    .fl-table tbody td {
        text-align: center;
    }

    .table-wrapper {
        overflow: auto;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="head">
        <h1>Users Details</h1>
        <button id="add" onclick="location.href='task.php'">Add New User</button>
        </div>
        <hr>
        <div class="table-wrapper">
        <table class="fl-table">
        <thead>
        <tr>
            <th>ID#</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>Gender</th>
            <th>recive_email</th>
            <th>Options</th>
        </tr>
        </thead>
        <tbody>
        <?php
                        $dbhost = 'localhost';
                        $dbuser = 'root';
                        $dbpass = '';
                        $dbname = 'task';

                        $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

                        if (!$link) {
                            die('Could not connect: ' . mysqli_error($link));
                        }

                        $query = "SELECT * FROM emp";
                        $result = mysqli_query($link, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$row['id']}</td>";
                            echo "<td>{$row['name']}</td>";
                            echo "<td>{$row['email']}</td>";
                            echo "<td>{$row['gender']}</td>";
                            echo "<td>{$row['recive_email']}</td>";
                            echo "<td>
                            <a href='view.php?id={$row['id']}'><i class='fa-solid fa-eye'></i></a>
                            <a href='update-page.php?id={$row['id']}'><i class='fa-solid fa-pen-to-square'></i></a>
                            <a href='delete.php?id={$row['id']}'><i class='fa-solid fa-trash'></i></a></td>";
                            echo "</tr>";
                        }
                        mysqli_close($link);
                    ?>
        <tbody>
    </table>
    </div>
</body>
</html>
