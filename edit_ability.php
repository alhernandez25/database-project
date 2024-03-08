<?php
include_once("connection.php");

$sql = "SELECT * FROM Abilities WHERE ability_id = ?;";
$stmt = mysqli_stmt_init($connection);

mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "i", $_GET["id"]);
mysqli_stmt_execute($stmt);
$ability_query = $stmt->get_result();
mysqli_stmt_close($stmt);

$ability = mysqli_fetch_assoc($ability_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ability</title>
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
<h1 class="title">Edit Ability</h1>
<form action="./database.php" method="post">
    <input type="hidden" name="abilityID" value="<?php echo $_GET["id"]; ?>">

    <label for="abilityName">Name:</label>
    <input type="text" id="abilityName" name="abilityName" value="<?php echo $ability["name"]; ?>" required><br>

    <label for="abilityDescription">Description:</label>
    <input type="text" id="abilityDescription" name="abilityDescription" value="<?php echo $ability["description"]; ?>" required><br>

    <label for="abilityDamage">Damage/Heal:</label>
    <input type="text" id="abilityDamage" name="abilityDamage" value="<?php echo $ability["damage"]; ?>" required><br>

    <label for="abilityType">Type</label>
    <select id="abilityType" name="abilityType" required>
        <option value="Attack" <?php echo ($ability["type"] == "Attack") ? "selected" : "";?>>Attack</option>
        <option value="Healing" <?php echo ($ability["type"] == "Healing") ? "selected" : "";?>>Healing</option>
        <option value="Enemy" <?php echo ($ability["type"] == "Enemy") ? "selected" : "";?>>Enemy</option>
    </select><br><br>

    <input type="checkbox" id="abilityEnemyOnly" name="abilityEnemyOnly" style="display: inline; width: auto;" <?php echo ($ability["enemy_only"] == "1") ? "checked" : "";?>>
    <label for="abilityEnemyOnly" style="display: inline">Enemy Only Ability?</label><br><br><br>

    <button type="submit" name="updateAbility">Update Ability</button>
    <button type="button" onclick="window.location.href='admin.php';">Cancel</button>
</form>

</body>
</html>