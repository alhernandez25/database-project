<?php
include_once("connection.php");
$sql = "SELECT enemy_id, name from Enemies";
$enemies_query = mysqli_query($connection, $sql);

$sql = "SELECT * FROM Locations;";
$locations_query = mysqli_query($connection, $sql);

$sql = "SELECT * FROM Abilities;";
$abilities_query = mysqli_query($connection, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Players</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 24px;
            margin: 20px;
        }

        th, td {
            border: 2px solid black;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: orange;
        }

        form {
            margin-bottom: 20px;
            text-align: center;
        }

        .btn {
            padding: 10px 20px;
            background-color: blue;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-align: center;
        }

        .btn:hover {
            background-color: blue;
        }

        #BackButton {
            margin-top: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

    </style>
</head>
<body>
<div>
    <h1>Manage Game</h1>

    <h2>Current Locations</h2>
    <?php
        if(isset($_GET["error"]) && $_GET["error"] == "spawn_deletion") {
            echo "<p style='color:red;'>Could not delete location. Must have at least 1 location of \"Spawn\" type</p>";
        }
        else if(isset($_GET["error"]) && $_GET["error"] == "spawn_update") {
            echo "<p style='color:red;'>Could not update location spawn type. Must have at least 1 location of \"Spawn\" type</p>";
        }
    ?>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody id="currentLocations">
        <?php
        while ($location = mysqli_fetch_assoc($locations_query)) { ?>
            <tr>
                <td><?php echo $location["name"]; ?></td>
                <form action="./database.php" method="post">
                    <input name="location_id" value="<?php echo $location["location_id"]; ?>" type="hidden">
                    <td><button type="submit" name="deleteLocation" class="btn">Delete</button></td>
                </form>
                <td><a href="edit_location.php?id=<?php echo $location["location_id"];?>"><button class="btn">Edit</button></a></td>
            </tr> <?php
        }
        ?>
        </tbody>
    </table>
    <div style="text-align: center;">
        <button type="button" class="btn" id="addLocationBtn" onclick="window.location.href='add_location.php';">Add Location</button>
    </div>

    <h2>Current Enemies</h2>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody id="currentEnemies">
        <?php
        while ($enemy = mysqli_fetch_assoc($enemies_query)) { ?>
            <tr>
                <td><?php echo $enemy["name"]; ?></td>
                <form action="./database.php" method="post">
                    <input name="enemy_id" value="<?php echo $enemy["enemy_id"]; ?>" type="hidden">
                    <td><button type="submit" name="deleteEnemy" class="btn">Delete</button></td>
                </form>
                <td><a href="edit_enemy.php?id=<?php echo $enemy["enemy_id"]; ?>"><button class="btn">Edit</button></a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <form id="playerForm">
        <div style="text-align: center;">
            <button type="button" class="btn" id="addEnemyBtn" onclick="window.location.href='add_enemy.php';">Add Enemy</button>
        </div>
    </form>

    <h2>Current Abilities</h2>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody id="currentAbilities">
        <?php
        while ($ability = mysqli_fetch_assoc($abilities_query)) { ?>
            <tr>
                <td><?php echo $ability["name"]; ?></td>
                <form action="./database.php" method="post">
                    <input name="ability_id" value="<?php echo $ability["ability_id"]; ?>" type="hidden">
                    <td><button type="submit" name="deleteAbility" class="btn">Delete</button></td>
                </form>
                <td><a href="edit_ability.php?id=<?php echo $ability["ability_id"]; ?>"><button class="btn">Edit</button></a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <form id="playerForm">
        <div style="text-align: center;">
            <button type="button" class="btn" id="addAbilityBtn" onclick="window.location.href='add_ability.php';">Add Ability</button>
        </div>
    </form>

    <button type="button" class="btn" id="BackButton" onclick="window.location.href='index.php';">Back</button>
</div>
</body>
</html>