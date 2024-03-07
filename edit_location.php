<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Location</title>
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
<h1 class="title">Edit Location</h1>
<form id="addPlayerForm">
    <label for="playerName">Name:</label>
    <input type="text" id="playerName" name="playerName" required value="Current Location"><br>

    <label for="playerName">Description:</label>
    <input type="text" id="playerName" name="playerName" required value="Current Description"> <br>

    <label for="playerAbilities">Location Type</label>
    <select id="playerAbilities" name="playerAbilities" required>
        <option value="Kick">Spawn</option>
        <option value="Stab">Healing</option>
        <option value="Punch">Enemy</option>
    </select><br><br>

    <button type="button" onclick="window.location.href='admin.html';">Update Location</button>
    <button type="button" onclick="window.location.href='admin.html';">Cancel</button>
</form>

</body>
</html>