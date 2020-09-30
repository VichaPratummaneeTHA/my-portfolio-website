// ************************* Variables*************************************

var buttonColors = ["red", "blue", "green", "yellow"];

var gamePattern = [];

var userClickedPatten = [];

var started = false; // check that game started yes or not

var level = 0; // check start at level 0


 // ************************* For Starting Game*************************************

$(document).keydown(function(){
  if(!started){
      $("#level-title").text("level " + level);

      nextSequence();
      started = true;
  }
});

 // ************************* For User Click*************************************

$(".btn").click(function(){

  var userChosenColor = $(this).attr("id"); // get id from click event

  userClickedPatten.push(userChosenColor);

  playSound(userChosenColor);

  checkAnswer(userClickedPatten.length-1);

});

 // ************************* Condition Check Answer*************************************

function checkAnswer(currentLevel){
  if(gamePattern[currentLevel] === userClickedPatten[currentLevel]){

    console.log("sucess");

    if(userClickedPatten.length === gamePattern.length){

        setTimeout(function(){
            nextSequence();
        }, 1000);
    }

  }
  else{

    console.log("wrong");

    playSound("wrong");

    $("body").addClass("game-over");

    setTimeout(function(){
        $("body").removeClass("game-over");
    }, 200);

    $("#level-title").text("Game Over, Press Any Key to Restart");

    startOver();

  }
}

// ************************* Game Patten *************************************

function nextSequence() {

  userClickedPatten = [];

  level++;

  $("#level-title").text("level " + level);

  var randomNumber = Math.floor(Math.random() * 4);

  var randomChosenColor = buttonColors[randomNumber];

  gamePattern.push(randomChosenColor);

  $("#" + randomChosenColor).fadeIn(100).fadeOut(100).fadeIn(100);

  playSound(randomChosenColor);
}

// ************************* Function PlaySound, Play animatePress, set GameOver*************************************

function playSound(name){

    var audio = new Audio("sounds/"+ name +".mp3");
    audio.play();
}

function animatePress(currentColor){

    $("#" + currentColor).addClass("pressed");

    setTimeout(function(){
      $("#" + currentColor).removeClass("pressed");
    }, 100);
}

function startOver(){
  level = 0;
  gamePattern = [];
  started = false;
}
