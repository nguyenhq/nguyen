//get all squares by tag td
var squares = document.querySelectorAll("td");
// button reset all squares
var restart = document.querySelector("#b");
//create a function clear square
function clearBoard(){
  for(var i = 0; i < squares.length; i++){
    squares[i].textContent = '';
  }
  restart.style.color = 'red';
};
restart.addEventListener('click', clearBoard);

// create a function that check square marker when mouse click
function changeMarker(){
    if (this.textContent === ''){
      this.textContent = 'X';
      this.style.color = 'black';
    }
    else if (this.textContent ==='X'){
      this.textContent = 'O';
      this.style.color = 'red';
    }else {
      this.textContent = '';
    }
};

// use for loop to add Event listeners for all square
for (var i = 0; i < squares.length; i++) {
    squares[i].addEventListener('click', changeMarker);
}
