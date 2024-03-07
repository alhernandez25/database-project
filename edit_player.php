<?php
include_once("connection.php");

$sql = "SELECT Players.player_id, Players.name AS player_name, 
Abilities.ability_id, Abilities.name AS ability_name,
PlayerDetails.player_details_id
FROM Players
JOIN PlayerDetails on Players.player_id = PlayerDetails.player_id
JOIN Abilities on PlayerDetails.ability_id = Abilities.ability_id
WHERE Players.player_id = ?;";
$stmt = mysqli_stmt_init($connection);

mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "i", $_GET["id"]);
mysqli_stmt_execute($stmt);
$player_query = $stmt->get_result();
mysqli_stmt_close($stmt);


$sql = "SELECT * FROM Abilities WHERE enemy_only != 1;";
$abilities_query = mysqli_query($connection, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Player</title>
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
<h1 class="title">Edit Player</h1>
<form action="./database.php" method="post">
    <?php
    $player = mysqli_fetch_assoc($player_query);
    ?>
    <input type="hidden" name="playerID" value="<?php echo $_GET["id"]; ?>">

    <label for="playerName">Name:</label>
    <input type="text" id="playerName" name="playerName" value="<?php echo $player["player_name"]; ?>" required><br>

    <input type="hidden" name="playerDetails1" value="<?php echo $player["player_details_id"]; ?>">
    <label for="playerAbilities1">Ability 1:</label>
    <select id="playerAbilities1" name="playerAbility1" required>
        <?php
        while ($ability = mysqli_fetch_assoc($abilities_query)) {
            $selected = "";

            if ($ability["ability_id"] == $player["ability_id"]) {
                $selected = "selected";
            } ?>
            <option value="<?php echo $ability["ability_id"] ?>" <?php echo $selected;?>><?php echo $ability["name"] ?></option>
            <?php
        }
        mysqli_data_seek($abilities_query, 0);
        $player = mysqli_fetch_assoc($player_query);
        ?>
    </select><br><br>

    <input type="hidden" name="playerDetails2" value="<?php echo $player["player_details_id"]; ?>">
    <label for="playerAbilities2">Ability 2:</label>
    <select id="playerAbilities2" name="playerAbility2" required>
        <?php
        while ($ability = mysqli_fetch_assoc($abilities_query)) {
            $selected = "";
            if ($ability["ability_id"] == $player["ability_id"]) {
                $selected = "selected";
            } ?>
            <option value="<?php echo $ability["ability_id"]; ?>" <?php echo $selected;?>><?php echo $ability["name"]; ?></option>
            <?php
        }
        ?>
    </select><br><br>

    <button type="submit" name="updatePlayer">Update Player</button>
    <button type="button" onclick="window.location.href='index.php';">Cancel</button>
</form>

</body>
</html>