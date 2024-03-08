<?php
include_once("connection.php");

$sql = "SELECT * FROM Locations WHERE location_id = ?;";
$stmt = mysqli_stmt_init($connection);

mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "i", $_GET["id"]);
mysqli_stmt_execute($stmt);
$location_query = $stmt->get_result();
mysqli_stmt_close($stmt);

$location = mysqli_fetch_assoc($location_query);
?>
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
<form action="./database.php" method="post">
    <input type="hidden" name="locationID" value="<?php echo $_GET["id"]; ?>">

    <label for="locationName">Name:</label>
    <input type="text" id="locationName" name="locationName" required value="<?php echo $location["name"]; ?>"><br>

    <label for="locationDescription">Description:</label>
    <input type="text" id="locationDescription" name="locationDescription" required value="<?php echo $location["description"]; ?>"> <br>

    <label for="locationType">Location Type</label>
    <select id="locationType" name="locationType" required>
        <option value="Spawn" <?php echo ($location["type"] == "Spawn") ? "selected" : "";?>>Spawn</option>
        <option value="Healing" <?php echo ($location["type"] == "Healing") ? "selected" : "";?>>Healing</option>
        <option value="Enemy" <?php echo ($location["type"] == "Enemy") ? "selected" : "";?>>Enemy</option>
    </select><br><br>

    <button type="submit" name="updateLocation";">Update Location</button>
    <button type="button" onclick="window.location.href='admin.php';">Cancel</button>
</form>

</body>
</html>