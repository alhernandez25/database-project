<?php
include_once("connection.php");


$sql = "SELECT Enemies.enemy_id, Enemies.name AS enemy_name, Enemies.location_id,
                Abilities.ability_id, Abilities.name AS ability_name, EnemyDetails.enemy_details_id
        FROM Enemies
        JOIN EnemyDetails ON Enemies.enemy_id = EnemyDetails.enemy_id
        JOIN Abilities ON EnemyDetails.ability_id = Abilities.ability_id
        WHERE Enemies.enemy_id = ?";
$stmt = mysqli_stmt_init($connection);

mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "i", $_GET["id"]);
mysqli_stmt_execute($stmt);
$enemy_query = $stmt->get_result();
$enemy = mysqli_fetch_assoc($enemy_query);


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
    <title>Edit Enemy</title>
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

        h1.title {
            text-align: center;
        }
    </style>
</head>
<body>
<h1 class="title">Edit Enemy</h1>
<form action="./database.php" method="post">
    <input type="hidden" name="enemyID" value="<?php echo $_GET["id"]; ?>">

    <label for="enemyName">Name:</label>
    <input type="text" id="enemyName" name="enemyName" value="<?php echo $enemy["enemy_name"]; ?>" required><br>
    <input type="hidden" name="enemyDetails1" value="<?php echo $enemy["enemy_details_id"]; ?>">
    <label for="enemyAbilities1">Ability 1:</label>
    <select id="enemyAbilities1" name="enemyAbility1" required>
        <?php
        while ($ability = mysqli_fetch_assoc($abilities_query)) {
            $selected = "";

            if ($ability["ability_id"] == $enemy["ability_id"]) {
                $selected = "selected";
            } ?>
            <option value="<?php echo $ability["ability_id"] ?>" <?php echo $selected;?>><?php echo $ability["name"] ?></option>
            <?php
        }
        mysqli_data_seek($abilities_query, 0);
        $enemy = mysqli_fetch_assoc($enemy_query);
        ?>
    </select><br><br>

    <input type="hidden" name="enemyDetails2" value="<?php echo $enemy["enemy_details_id"]; ?>">
    <label for="enemyAbilities2">Ability 2:</label>
    <select id="enemyAbilities2" name="enemyAbility2" required>
        <?php
        while ($ability = mysqli_fetch_assoc($abilities_query)) {
            $selected = "";
            if ($ability["ability_id"] == $enemy["ability_id"]) {
                $selected = "selected";
            } ?>
            <option value="<?php echo $ability["ability_id"]; ?>" <?php echo $selected;?>><?php echo $ability["name"]; ?></option>
            <?php
        }
        ?>
    </select><br><br>

    <label for="enemyLocation">Location:</label>
    <select id="enemyLocation" name="enemyLocation" required>
        <?php
        while ($location = mysqli_fetch_assoc($locations_query)) {
            $selected = ($location["location_id"] == $enemy["location_id"]) ? "selected" : "";
            echo "<option value='" . $location["location_id"] . "' $selected>" . $location["name"] . "</option>";
        }
        ?>
    </select><br><br>

    <button type="submit" name="updateEnemy">Update Enemy</button>
    <button type="button" onclick="window.location.href='admin.php';">Cancel</button>
</form>
</body>
</html>
