function validation(event){
    //Check if all fields are filled
    if(form.username.value.length == 0 ||
       form.password.value.length == 0){
        alert("Fill in all fields.");  
        event.preventDefault();
    }      
}

//Form
const form = document.forms['form_name'];
form.addEventListener('submit', validation);

