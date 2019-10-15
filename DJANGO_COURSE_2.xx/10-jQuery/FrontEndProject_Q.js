// Grab all elements td
var squares = document.querySelectorAll("td")
// create 2 Player
//var playerOne = prompt("Enter player one's name, you have color blue");
var playerOneColor = ('rgb(6,119,217)')

//var playerTwo = prompt("Enter player two's name, you have color red");
var playerTwoColor = ('rgb(237, 59, 104)')
var squareNull = true
var player1 = true
var player2 = true
//create a funciton that change color with Event listeners
function changeColor(square){
  console.log("plaher1",player1);
  console.log("player2",player2);
  if (($(square).css('background-color') === 'rgb(128, 128, 128)') && player1){
    $(square).css('background-color',playerOneColor);
    console.log('this is ok');
    return squareNull = false;
    return player1 = false;
    return player2 = true;
  }else if
     (($(square).css('background-color') === 'rgb(128, 128, 128)') && player2){
      $(square).css('background-color',playerTwoColor);
      return squareNull = false;
      return player2 = false;
      return player1 = true;
  }
}

$('.board button').on('click',function(){
  var col = $(this).closest("td").index();
  var row = $(this).closest("tr").index();
  checkBottom(col,row);
})

function turnPlayer(){
  if (player1 === true) {
    return player2 = true;
    return player1 = false;
  }else {
    return player1 = true;
    return player2 = false;
  }
}
//create a function check bottom if this is null
function checkBottom(col,row){
  for(var i = 5; i>-1; i--){
    //if(($('.board button').eq(i).find('button').eq(col).css('background-color')) === 'rgb(128, 128, 128)'){
    if (squareNull){
    var x = $('table tr').eq(i).find('button').eq(col)
      changeColor(x);
      //console.log("this ok");
      console.log(squareNull);

    }
    return squareNull = true;
    turnPlayer();


    //}
  }
}
//create a objet table contain checkSquareInColumn

// Create a function check corresponding square in column
// function checkSquareInColumn(){
//   for(i = 0;i<7;i++){
//
//     for (j=0;j<squares.length;j++){
//       if (j === i || j === i+7){
//         table[i] = table[i].push(j);
//       }
//     }
//   }
// }
// var tables = checkSquareInColumn();
//create a function that check square marker when mouse click
function changeMarker(){
    if(this.textContent === ''){
      squares[i].textContent ='X';
      console.log("ok");
    }else {
    squares[i].textContent = '';
  }
}
//Use a for loop to add Event listeners to all the squares
// for (var i = 0; i < squares.length; i++) {
//     squares[i].addEventListener('click', changeMarker(i));
//     console.log(squares[i]);
// }
// $('.board button').on('click',function(){
//   if ($(this).css('background-color') === 'rgb(128, 128, 128)'){
//     $(this).css('background-color','blue');
//   }
// });
