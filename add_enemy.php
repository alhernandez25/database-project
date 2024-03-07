<?php
include_once("connection.php");

$sql = "SELECT * FROM Abilities";
$abilities_query = mysqli_query($connection, $sql);
$sql = "SELECT * FROM Locations";
$locations_query = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Enemy</title>
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
<h1 class="title">Add New Enemy</h1>
<form id="addEnemyForm" action="./database.php" method="post">
    <label for="enemyName">Name:</label>
    <input type="text" id="enemyName" name="enemyName" required><br>

    <label for="maxHealth">Max Health:</label>
    <input type="text" id="maxHealth" name="maxHealth" required><br>

    <label for="enemyAbility1">Ability 1:</label>
    <select id="enemyAbility1" name="enemyAbility1" required>
        <?php
        while ($ability = mysqli_fetch_assoc($abilities_query)) {
            echo "<option value='" . $ability["ability_id"] . "'>" . $ability["name"] . "</option>";
        }
        mysqli_data_seek($abilities_query, 0);
        ?>
    </select><br><br>

    <label for="enemyAbility2">Ability 2:</label>
    <select id="enemyAbility2" name="enemyAbility2" required>
        <?php
        while ($ability = mysqli_fetch_assoc($abilities_query)) {
            echo "<option value='" . $ability["ability_id"] . "'>" . $ability["name"] . "</option>";
        }
        ?>
    </select><br><br>

    <label for="enemyLocation">Location:</label>
    <select id="enemyLocation" name="enemyLocation" required>
        <?php
        while ($location = mysqli_fetch_assoc($locations_query)) {
            echo "<option value='" . $location["location_id"] . "'>" . $location["name"] . "</option>";
        }
        ?>
    </select><br><br>

    <button type="submit" name="addEnemy">Add Enemy</button>
    <button type="button" onclick="window.location.href='admin.php';">Cancel</button>
</form>

</body>
</html>
