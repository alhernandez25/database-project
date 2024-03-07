<?php
include_once("connection.php");

$sql = "SELECT * FROM Abilities WHERE enemy_only != 1;";
$abilities_query = mysqli_query($connection, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Player</title>
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
<h1 class="title">Add New Player</h1>
<form id="addPlayerForm" action="./database.php" method="post">
    <label for="playerName">Name:</label>
    <input type="text" id="playerName" name="playerName" required><br>

    <label for="playerAbilities1">Ability 1:</label>
    <select id="playerAbilities1" name="playerAbility1" required>
        <?php
        while ($ability = mysqli_fetch_assoc($abilities_query)) { ?>
            <option value="<?php echo $ability["ability_id"] ?>"><?php echo $ability["name"] ?></option>
            <?php
        }
        mysqli_data_seek($abilities_query, 0);
        ?>
    </select><br><br>

    <label for="playerAbilities2">Ability 2:</label>
    <select id="playerAbilities2" name="playerAbility2" required>
        <?php
        while ($ability = mysqli_fetch_assoc($abilities_query)) { ?>
            <option value="<?php echo $ability["ability_id"]; ?>"><?php echo $ability["name"]; ?></option>
            <?php
        }
        ?>
    </select><br><br>

    <button type="submit" name="addPlayer">Add Player</button>
    <button type="button" onclick="window.location.href='index.php';">Cancel</button>
</form>

</body>
</html>