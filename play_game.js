
const players = [
  {
    name: "Juan",
    health: 100,
    abilities: ["Basic Attack", "Magic Attack", "Heal"],
    turns: 3,
    attack_damage: 30,
    location: "home"
  },
  {
    name: "Alejandro",
    health: 100,
    abilities: ["Basic Attack", "Magic Attack", "Heal"],
    turns: 3,
    attack_damage: 20,
    location: "home"
  },
  {
    name: "Bot",
    health: 100,
    abilities: ["Basic Attack", "Magic Attack", "Heal"],
    turns: 3,
    attack_damage: 50,
    location: "home"
  }
];


const enemies = [ // currently only using plankton
  {
    name: "Plankton",
    health: 1000,
    location: "Not Home",
    attack_damage: 35
  },
  {
    name: "SpongeBob",
    health: 1200,
    location: "Not Home",
    attack_damage: 40
  }
];


let currentPlayerIndex = 0; 
let currentEnemyIndex = 0;


document.addEventListener("DOMContentLoaded", function() {
  const basicAttackBtn = document.querySelector("#basicAttackBtn");
  const changeLocationBtn = document.querySelector("#changeLocationBtn");
  const useHealBtn = document.querySelector("#useHealBtn");
  const skipTurnBtn = document.querySelector("#skipTurnBtn");

  basicAttackBtn.addEventListener("click", useBasicAttack);
  changeLocationBtn.addEventListener("click", changeLocation);
  useHealBtn.addEventListener("click", useHeal);
  skipTurnBtn.addEventListener("click", skipTurn);

  updateUI();
});


function updateUI() {
  const currentPlayer = players[currentPlayerIndex];
  const nextIndex = (currentPlayerIndex + 1) % players.length;
  const nextPlayer = players[nextIndex];

  document.getElementById("health").innerText = currentPlayer.health;
  document.getElementById("playerName").innerText = currentPlayer.name;
  document.getElementById("nextPlayer").innerText = nextPlayer.name;
  document.getElementById("turns").innerText = currentPlayer.turns;
  document.getElementById("currentLocation").innerText = currentPlayer.location;
}

function useBasicAttack() {
  if (players[currentPlayerIndex].location == enemies[currentEnemyIndex].location){
  enemies[currentEnemyIndex].health -= players[currentPlayerIndex].attack_damage; 
  addLog(`${players[currentPlayerIndex].name} used Basic Attack! on ${enemies[currentEnemyIndex].name} dealing ${players[currentPlayerIndex].attack_damage}`);
  }
  else{
    addLog(`The attack missed, there are no enemies in your current location. Change locations next turn`);
  }
  updateUI();
  nextTurn();
}

function changeLocation() {
  players[currentPlayerIndex].location = "Not Home"
  addLog(`${players[currentPlayerIndex].name} has updated their location`);

  // check if enemy has someone to attack
  if (players[currentPlayerIndex].location == enemies[currentEnemyIndex].location){
    addLog(`${players[currentPlayerIndex].name} has entered enemy territory be careful on the next turn`);
  }

  updateUI();
  nextTurn();
}

function useHeal() {
  if (players[currentPlayerIndex].health < 100){
  players[currentPlayerIndex].health += players[currentPlayerIndex].attack_damage
  addLog(`${players[currentPlayerIndex].name} used Heal. Health has increased by ${players[currentPlayerIndex].attack_damage}`);
  } else{
    addLog(`Player is already at max health`);
  }
  updateUI();
  nextTurn();
}

function skipTurn() {
  addLog(`${players[currentPlayerIndex].name} skipped a turn`);
  updateUI();
  nextTurn();
}

function enemyAttacks() {
  if (players[currentPlayerIndex].location == enemies[currentEnemyIndex].location){
    players[currentPlayerIndex].health -= enemies[currentEnemyIndex].attack_damage
    addLog(`${enemies[currentEnemyIndex].name} used Basic Attack! on ${players[currentPlayerIndex].name} dealing ${enemies[currentEnemyIndex].attack_damage}`);
  }

  if (players[currentPlayerIndex].health <= 0){
    addLog(`${enemies[currentEnemyIndex].name} has killed you. Better luck next time.`);
  }
}

function nextTurn() {
  // update turns left
  players[currentPlayerIndex].turns -= 1

  // enemy turn, then skip to next player
  addLog(`Its time for the enemy to attack, the enemy can only deal damage to the current player and if the current player is in enemy territory`);
  enemyAttacks();

  // swtich to next player
  currentPlayerIndex = (currentPlayerIndex + 1) % players.length;

  // needs to be updated if more than 3 players 
  if (players[currentPlayerIndex].health <=0 || players[currentPlayerIndex].turns == 0){
    currentPlayerIndex = (currentPlayerIndex + 1) % players.length;
  }

  // check if all players are dead
  let gameOver = false
  for (let i = 0; i < players.length; i++){
    if (players[i].health < 1 || players[i].turns == 0){
      gameOver = true
    }else{
      gameOver = false
    }
  }

  if (gameOver){
    addLog(`Game Over`);
  }
  
  updateUI();
}

function addLog(logMessage) {
  const logsContainer = document.getElementById("logContainer");
  const logItem = document.createElement("p");
  logItem.textContent = logMessage;
  logsContainer.appendChild(logItem);
}
