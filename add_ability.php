<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Ability</title>
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
<h1 class="title">Add New Ability</h1>
<form action="./database.php" method="post">
    <label for="abilityName">Name:</label>
    <input type="text" id="abilityName" name="abilityName" required><br>

    <label for="abilityDescription">Description:</label>
    <input type="text" id="abilityDescription" name="abilityDescription"><br>

    <label for="abilityDamage">Damage/Heal:</label>
    <input type="text" id="abilityDamage" name="abilityDamage" required><br>

    <label for="type">Type</label>
    <select id="type" name="abilityType" required>
        <option value="Attack">Attack</option>
        <option value="Healing">Healing</option>
        <option value="Enemy">Enemy</option>
    </select><br><br>

    <input type="checkbox" id="abilityEnemyOnly" name="abilityEnemyOnly" style="display: inline; width: auto;">
    <label for="abilityEnemyOnly" style="display: inline">Enemy Only Ability?</label><br><br><br>


    <button type="submit" name="addAbility">Add Ability</button>
    <button type="button" onclick="window.location.href='admin.php';">Cancel</button>
</form>

</body>
</html>