// Question check information
var firstName = prompt("Hello and Welcome  to Quoc. Please enter your First Name : ")
var lastName = prompt("Please enter your Last Name : ")
var age = prompt("How old are you?")
var tall = prompt("How tall are you  in centimeters?")
var petName =  prompt("What is the name your pet?")
alert("Thank you so much for the information")

// four conditions need to be true for the spy alert!
var cond = false
if(firstName[0]===lastName[0]){ //The Spy has the same first letter of her First Name and Last Name
  cond = true
}
else if (age>20 && age <30) { //The Spy is between the Age of 20 and 30 (exclusive of 20 and 30)
  cond = true
}
else if (tall >= 170){ //The Spy is at least 170 centimeters tall.
  cond = true
}
else if(petName.leght[-1] ==="y"){
  cond = true
}

if(cond){ //check condition if this is true
  console.log("Welcome Comrade! You've passed the Spy Test") //My message secret
}else{
  console.log("Sorry, nothing to see here");
}
