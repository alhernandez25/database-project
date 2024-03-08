<?php
include_once("connection.php");

if (isset($_POST["addPlayer"])) {
    $name = $_POST["playerName"];
    $turn = 10;
    $location_id = 1;

    // Insert player
    $sql = "INSERT INTO Players(name, turn, location_id)
            VALUES(?,?,?)";

    $stmt = mysqli_stmt_init($connection);

    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "sii", $name, $turn, $location_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Get id of recently created player
    $player_id = mysqli_insert_id($connection);

    // Insert first M:M player:ability relationship
    $sql = "INSERT INTO PlayerDetails (player_id, ability_id)
            VALUES (?, ?);";

    $stmt = mysqli_stmt_init($connection);

    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $player_id, $_POST["playerAbility1"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Insert second M:M player:ability relationship
    $sql = "INSERT INTO PlayerDetails (player_id, ability_id)
            VALUES (?, ?);";

    $stmt = mysqli_stmt_init($connection);

    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $player_id, $_POST["playerAbility2"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ./index.php");
}
else if (isset($_POST["deletePlayer"])) {
    // Delete player - CASCADES and deletes M:M players:abilities relationship
    $sql = "DELETE FROM Players WHERE player_id = ?;";

    $stmt = mysqli_stmt_init($connection);

    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $_POST["player_id"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ./index.php");
}
else if (isset($_POST["updatePlayer"])) {
    // Update player name
    $sql = "UPDATE Players SET name = ? WHERE player_id = ?;";
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "si", $_POST["playerName"], $_POST["playerID"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Update player details
    $sql = "UPDATE PlayerDetails SET ability_id = ? WHERE player_details_id = ?;";
    // Update first M:M player:ability relationship
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $_POST["playerAbility1"], $_POST["playerDetails1"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    // Update second M:M player:ability relationship
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $_POST["playerAbility2"], $_POST["playerDetails2"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ./index.php");
}
else if (isset($_POST["addEnemy"])) {
    // Retrieve form data
    $name = $_POST["enemyName"];
    $max_health = $_POST["maxHealth"];
    $location_id = $_POST["enemyLocation"];
    $ability1_id = $_POST["enemyAbility1"];
    $ability2_id = $_POST["enemyAbility2"];

    // Insert enemy
    $sql = "INSERT INTO Enemies (name, health, max_health, location_id) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "siii", $name, $max_health, $max_health, $location_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Get the ID of the newly inserted enemy
    $enemy_id = mysqli_insert_id($connection);

    // Insert first M:M enemy:ability relationship
    $sql = "INSERT INTO EnemyDetails (enemy_id, ability_id) VALUES (?, ?)";
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $enemy_id, $ability1_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Insert second M:M enemy:ability relationship
    $sql = "INSERT INTO EnemyDetails (enemy_id, ability_id) VALUES (?, ?)";
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $enemy_id, $ability2_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ./admin.php");
}
else if (isset($_POST["updateEnemy"])) {
    $enemyID = $_POST["enemyID"];
    $name = $_POST["enemyName"];
    $location_id = $_POST["enemyLocation"];
    $ability1_id = $_POST["enemyAbility1"];
    $ability2_id = $_POST["enemyAbility2"];

    // Update enemy name and location
    $sql = "UPDATE Enemies SET name = ?, location_id = ? WHERE enemy_id = ?";
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "sii", $name, $location_id, $enemyID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Update enemy abilities
    $sql = "UPDATE EnemyDetails SET ability_id = ? WHERE enemy_details_id = ?";

    // Update first M:M enemy:ability relationship
    $stmt1 = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt1, $sql);
    mysqli_stmt_bind_param($stmt1, "ii", $ability1_id, $_POST["enemyDetails1"]);
    mysqli_stmt_execute($stmt1);
    mysqli_stmt_close($stmt1);

    // Update second M:M enemy:ability relationship
    $stmt2 = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt2, $sql);
    mysqli_stmt_bind_param($stmt2, "ii", $ability2_id, $_POST["enemyDetails2"]);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt2);

    header("location: ./admin.php");
}
else if (isset($_POST["deleteEnemy"])) {
    // Delete enemy - CASCADES and deletes M:M enemy:abilities relationship
    $sql = "DELETE FROM Enemies WHERE enemy_id = ?;";

    $stmt = mysqli_stmt_init($connection);

    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $_POST["enemy_id"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ./admin.php");
}
else if (isset($_POST["addLocation"])) {
    $name = $_POST["locationName"];
    $description = $_POST["locationDescription"];
    $type = $_POST["locationType"];

    // Insert location
    $sql = "INSERT INTO Locations (name, description, type) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $name, $description, $type);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ./admin.php");
}
else if (isset($_POST["deleteLocation"])) {
    // Check if there is at least 1 spawn type
    $sql = "SELECT * FROM Locations WHERE type='Spawn';";
    $locations_query = mysqli_query($connection, $sql);

    if (mysqli_num_rows($locations_query) == 1) {
        $row = mysqli_fetch_assoc($locations_query);
        if ($row["location_id"] == $_POST["location_id"]) {
            header("location: ./admin.php?error=spawn_deletion");
        }
    }
    // Delete location
    $sql = "DELETE FROM Locations WHERE location_id = ?;";

    $stmt = mysqli_stmt_init($connection);

    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $_POST["location_id"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ./admin.php");
}
else if(isset($_POST["updateLocation"])) {
    $locationID = $_POST["locationID"];
    $name = $_POST["locationName"];
    $description = $_POST["locationDescription"];
    $type = $_POST["locationType"];

    // Check if there is at least 1 spawn type
    $sql = "SELECT * FROM Locations WHERE type='Spawn';";
    $locations_query = mysqli_query($connection, $sql);

    if (mysqli_num_rows($locations_query) == 1) {
        $row = mysqli_fetch_assoc($locations_query);
        if ($row["location_id"] == $locationID && $type != "Spawn") {
            header("location: ./admin.php?error=spawn_update");
        }
    }

    // Update enemy name and location
    $sql = "UPDATE Locations SET name = ?, description = ?, type = ? WHERE location_id = ?";
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $name, $description, $type, $locationID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ./admin.php");
}
else if (isset($_POST["addAbility"])) {
    $name = $_POST["abilityName"];
    $description = $_POST["abilityDescription"];
    $type = $_POST["abilityType"];
    $enemyOnly = (isset($_POST["abilityEnemyOnly"])) ? 1 : 0;
    $damage = intval($_POST["abilityDamage"]);

    // Insert location
    $sql = "INSERT INTO Abilities (name, description, type, damage, enemy_only) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "sssii", $name, $description, $type, $damage, $enemyOnly);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ./admin.php");
}
else if (isset($_POST["deleteAbility"])) {
    // Delete location
    $sql = "DELETE FROM Abilities WHERE ability_id = ?;";

    $stmt = mysqli_stmt_init($connection);

    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $_POST["ability_id"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ./admin.php");
}
else if(isset($_POST["updateAbility"])) {
    $abilityID = $_POST["abilityID"];
    $name = $_POST["abilityName"];
    $description = $_POST["abilityDescription"];
    $type = $_POST["abilityType"];
    $enemyOnly = (isset($_POST["abilityEnemyOnly"])) ? 1 : 0;
    $damage = intval($_POST["abilityDamage"]);

    // Update ability
    $sql = "UPDATE Abilities SET name = ?, description = ?, type = ?, enemy_only = ?, damage = ? WHERE ability_id = ?";
    $stmt = mysqli_stmt_init($connection);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "sssiii", $name, $description, $type, $enemyOnly, $damage, $abilityID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ./admin.php");
}