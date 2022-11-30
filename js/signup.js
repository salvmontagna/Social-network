//Function associated to submit
function form_validation(event){

  //Verify all fields
  if(form.username.value.length == 0 ||
    form.password.value.length == 0||
    form.email.value.length == 0 ||
    form.name.value.length == 0 ||
    form.password.value.length == 0 ||
    form.repassword.value.length == 0 ||
    form.image.value == ""){
      //Alert user
      alert("Fill in all fields.");
      //Prevent form submission
      event.preventDefault();
  }

  if (return_email==1 ) event.preventDefault();

  if(return_username==1) event.preventDefault();

  if(passw_script.value!=repassw_script.value) event.preventDefault();
  
}

//Function to validate password matching
function passw_validation(){

  var z = document.createElement("p");
  z.textContent = ('Passwords do not match');  

//Check that the password textboxes match
  if(passw_script.value !== repassw_script.value){
    if(passw_count !== 0){
      // Double check to not bug the UI, so
      //if the user still hasn't fix the passwords, I remove the error and put it back on the next check
      container_psw.removeChild(container_psw.childNodes[1]);
      passwordbox[0].classList.add("txtbox_error");
      passwordbox[1].classList.add("txtbox_error");
    }
    container_psw.appendChild(z);
    passwordbox[0].classList.add("txtbox_error");
    passwordbox[1].classList.add("txtbox_error");
    passw_count++;
  }
 
//If the passwords match, I remove the error and the classes that highlight the textboxes in red
  if(passw_script.value === repassw_script.value){
    container_psw.removeChild(container_psw.childNodes[1]);
    passwordbox[0].classList.remove("txtbox_error");
    passwordbox[1].classList.remove("txtbox_error");
    passw_count = 0;
  }
}

//Function that gets the string from response, which returns 0 or 1
function onText(flag){

  var z = document.createElement("p");
  z.textContent=("This username already exists.");

  if (flag == 1) {
    return_username = 1;

    if(username_count!==0){
      container_username.removeChild(container_username.childNodes[1]); 
      usernamebox.classList.remove("txtbox_error");
    }

    container_username.appendChild(z);
    usernamebox.classList.add("txtbox_error");
    username_count++; 
  }

  else{
    //Check okay, remove errors
    return_username = 0;
    username_count=0;
    container_username.removeChild(container_username.childNodes[1]);
    usernamebox.classList.remove("txtbox_error");
   
  }
}


//Function that returns the response of the check username query
function onResponse(response){
  return response.text();
}

function username_check(){
  fetch('http://localhost/social/api/checkuser.php?username=' + user_script.value).then(onResponse).then(onText);
}

//Function to validate the correct email format
function email_validation(){

  var z = document.createElement("p");
  z.textContent=("Invalid email.");
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

  if (!mailformat.test(email_script.value) && email_script.value !=0){
    return_email=1;

    if(email_count!==0){
      container_username.removeChild(container_username.childNodes[1]); 
      emailbox.classList.remove("txtbox_error");
    }

    container_email.appendChild(z);
    emailbox.classList.add("txtbox_error");
    email_count++; 
  }

  else {
    return_email=0;
    email_count=0;
    container_email.removeChild(container_email.childNodes[1]);
    emailbox.classList.remove("txtbox_error");
  }    
}


//I select nput image
var fileInput = document.querySelector(".input_file");

//Formats I want to accept
var allowedExtension = ".jpg";
var allowedExtension2 = ".jpeg";
var allowedExtension3 = ".png";

// Function that checks if the extension of the inserted file is different from the accepted one
//if it does not pass the check, an alert is returned and the input file is emptied
fileInput.addEventListener("change", function() {

  var hasInvalidFiles = false;
  for (var i = 0; i < this.files.length; i++) {
    var file = this.files[i];
    if (!file.name.endsWith(allowedExtension) && !file.name.endsWith(allowedExtension2) && !file.name.endsWith(allowedExtension3)) hasInvalidFiles = true;
  }
  if(hasInvalidFiles) {
    fileInput.value = ""; 
    alert("File not supported");
  }
});

//Globals and flag validation
var host="your_host_url";
var return_email = 0;
var return_username =0;
var passw_count=0;
var username_count=0;
var email_count=0;
var image_flag=0;

//Form
const form = document.forms['form_name'];
const user_script = form.username;
const email_script = form.email;
const passw_script = form.password;
const repassw_script = form.repassword;
const container_psw = document.querySelector('#psw');
const container_email = document.querySelector('#email');
const container_username = document.querySelector('#user');
const container_all = document.querySelector("#form_all");
const emailbox=document.querySelector("#emailbox");
const passwordbox=document.querySelectorAll("#passwordbox");
const usernamebox=document.querySelector("#usernamebox");
container_email.style.color="red"; 
container_username.style.color="red"; 
container_psw.style.color="red";
container_email.style.fontWeight="bold";
container_username.style.fontWeight="bold";
container_psw.style.fontWeight="bold";
//Listeners
form.addEventListener('submit', form_validation);
//Blurs
user_script.addEventListener('blur',username_check);
email_script.addEventListener('blur',email_validation);
repassw_script.addEventListener('blur',passw_validation);
passw_script.addEventListener('blur',passw_validation)