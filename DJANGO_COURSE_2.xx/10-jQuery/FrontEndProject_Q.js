// Grab all elements td
var squares = document.querySelectorAll("td");
//create a objet table contain checkSquareInColumn
var table = {0:[],1:[],2:[],3:[],4:[],5:[],6:[],7:[]};
  var column =[];
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
function changeMarker(square){
    if(square === 0 || square === 7 || square === 14 || square === 21 || square === 28){
      squares[i].textContent ='X';
      console.log("ok");
    }else {
    squares[i].textContent = '';
  }
};
// Use a for loop to add Event listeners to all the squares
for (var i = 0; i < squares.length; i++) {
    squares[i].addEventListener('click', changeMarker(i));
    console.log(squares[i]);
}
