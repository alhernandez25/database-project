<?php
include_once("connection.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Location</title>
    <style>
        form {
            max-width: 400px;
            margin: 0 auto;
        }
        label {
            display: block;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            padding: 10px 20px;
            background-color: blue;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: blue;
        }

        h1.title{
            text-align: center;
        }

    </style>
</head>
<body>
<h1 class="title">Add New Location</h1>
<form action="./database.php" method="post">
    <label for="locationName">Name:</label>
    <input type="text" id="locationName" name="locationName" required><br>

    <label for="description">Description:</label>
    <input type="text" id="description" name="locationDescription" required><br>

    <label for="type">Location Type</label>
    <select id="type" name="locationType" required>
        <option value="Spawn">Spawn</option>
        <option value="Healing">Healing</option>
        <option value="Enemy">Enemy</option>
    </select><br><br>

    <button type="submit" name="addLocation">Add Location</button>
    <button type="button" onclick="window.location.href='admin.php';">Cancel</button>
</form>

</body>
</html>