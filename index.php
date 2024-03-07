<?php
include_once("connection.php");

$sql = "SELECT player_id, name FROM Players";
$players_query = mysqli_query($connection, $sql);

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

        #PlayGame {
            margin-top: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        #GameAdmin {
            margin-top: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        #searchPlayer {
            width: 300px;
            padding: 10px;
            border: 2px solid black;
            border-radius: 5px;
            box-sizing: border-box;
            margin-top: 10px;
            font-size: 18px;
        }
        a {
            color: inherit;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div>
    <h1>Players</h1>
    <form id="playerForm">
        <div style="text-align: center;">
            <button type="button" class="btn" id="addPlayerBtn" onclick="window.location.href='add_player.php';">Add Player</button>
        </div>
        <div style="text-align: center; margin-top: 10px;">
            <input type="text" id="searchPlayer" name="searchPlayer" placeholder="Search Player by Name">
            <button type="button" class="btn" id="searchButton">Search</button>
        </div>
    </form>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody id="currentPlayers">
        <?php
        while ($player = mysqli_fetch_assoc($players_query)) { ?>
            <tr>
                <td><?php echo $player["name"]; ?></td>
                <form action="./database.php" method="post">
                    <input name="player_id" value="<?php echo $player["player_id"]; ?>" type="hidden">
                    <td><button type="submit" name="deletePlayer" class="btn">Delete</button></td>
                </form>
                <td><a href="edit_player.php?id=<?php echo $player["player_id"];?>"><button class="btn">Edit</button></a></td>
            </tr> <?php
        }
        ?>
        </tbody>
    </table>
    <button type="button" class="btn" id="PlayGame" onclick="window.location.href='play.html';">Play Game</button>
    <button type="button" class="btn" id="GameAdmin" onclick="window.location.href='admin.html';">Login as Game Admin</button>
</div>
</body>
</html>