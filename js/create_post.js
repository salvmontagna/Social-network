//Function to load the post into the database
function post_uploading(){
    const fetch_title = document.querySelector(".post_title").value;
    fetch(host+'/api/post_uploading.php?title='+ fetch_title.trim() + '&image='+fetch_img_url).then(onResponse2).then(onText);
}

function onResponse2(response){
    return response.text();
}

// I check that the post insert on the db was successful, if yes, I redirect the user to home, otherwise I print an alert
function onText(flag){
    if(flag==1){
        alert("The post has been successfully shared.");
        modal_exit();
        window.open("home.php","_self");
    }

    else alert("Post sharing failed.")
}

//Function to prevent exiting the modal on the internal click (stop propagation of the click from internal to external)
function int_modal_prevent(event){
    event.stopPropagation();
}


//Function to closed modal view
function modal_exit(){
    const x = document.querySelector(".modal_view");
    x.remove();
    const body = document.querySelector("body");
    body.style="overflow: null";
}

//Function to open modal VIEW
function modal_view(event){

    const body = document.querySelector("body");
    body.style="overflow: hidden";
    //I generate a section that will be the modal
    var modal_section = document.createElement("section");
    modal_section.classList.add("modal_view");
    modal_section.addEventListener("click", modal_exit);
   
    const image_clicked=event.currentTarget;

    if (type_service==1){
        var img_clicked_url=image_clicked.src;
        //Create the image and insert the url of the clicked image
        var img = document.createElement("img");
        img.classList.add("image_img");
        img.src=img_clicked_url;
        fetch_img_url=img_clicked_url;
   
    }
    else{
        var img_clicked_url=image_clicked.childNodes[0].src;
        var img = document.createElement("img");
        img.classList.add("gif_img");
        img.src=img_clicked_url;
        fetch_img_url=img_clicked_url;
    }

    var button_section = document.createElement("div");
    button_section.classList.add("button_section");

    ///Modal title
    var modal_title = document.createElement("p");
    modal_title.textContent="What are you thinking?"
    modal_title.classList.add("modal_title");
    modal_title.style="display:inline-block;color: white;font-weight: bold";

    //Title input
    var post_title = document.createElement("input");
    post_title.classList.add("post_title");
    post_title.type="text";
    post_title.setAttribute("id","service_list");
    post_title.placeholder="Post title";
    post_title.style="";
   
    var share_button = document.createElement("button");
    share_button.textContent="Share";
    share_button.classList.add("button_single");
    share_button.addEventListener("click",post_uploading);
    var exit_button = document.createElement("button");

    share_button.value=post_title.value;

    const internal_div = document.createElement("div");
    internal_div.addEventListener("click",int_modal_prevent);
    internal_div.classList.add("internal_div");

    button_section.appendChild(share_button);
    internal_div.appendChild(modal_title);
    internal_div.appendChild(post_title);
    internal_div.appendChild(img);
    internal_div.appendChild(button_section);
   
    //Div to section
    modal_section.appendChild(internal_div);
    //Section to body
    body.appendChild(modal_section);
    
}

//Fetch the rest-api, sending the chosen service and the search value\
function service_check(){ 
    event.preventDefault();
    //Input box value
    const service_input=document.querySelector("#myInput");
    const service_value = encodeURIComponent(service_input.value);
    //Service and word choosen
    var service_selected = service_list.options[service_list.selectedIndex].value;
   
    const formData = new FormData();
    formData.append("service_selected", service_selected);
    formData.append("service_value", service_value);
    
    //Check service is selected
    if (service_selected=="none"){
        under_section.innerHTML = "";
        event.preventDefault();
        const error = document.createElement("p");
        error.classList.add("error");
        error.textContent="Choose a service";
        under_section.appendChild(error);
    }
    else //If selected, I fetch
    fetch(host+"/api/do_search_content.php", { method: "POST", body: formData }).then(onResponse).then(onJson);
    
}

function onResponse(response){
    return response.json();
}

//Dynamically show all the results found based on the service chosen and the search performed
function onJson(json){
    
    under_section.innerHTML = "";
    const service_input=document.querySelector("#myInput");
    if(service_input.value==""){
      
        const error = document.createElement("p");
        error.classList.add("errore");
        error.textContent="La casella è vuota";
        under_section.appendChild(error);
    }

    else{
        var service_selected = service_list.options[service_list.selectedIndex].value;

        if (service_selected=="giphy"){
            under_section.innerHTML = "";
            json.data.forEach(gif => {
                let item = document.createElement("div");
                item.dataset.gifId = gif.id;
                item.dataset.gifTitle = gif.title;
                item.dataset.gifUrl = gif.images.fixed_height_small.url;
            
                let myimg = document.createElement("img");
                myimg.src = gif.images.fixed_height_small.url;
                item.style="display:inline-block; margin:5px";
                
                item.appendChild(myimg);
                under_section.appendChild(item);
                under_section.classList.remove("images");
                under_section.classList.add("gif");
                item.addEventListener('click',modal_view);
                type_service=0;
            });
        }
        else if(service_selected=="pixabay"){
            let item = document.createElement("div");
            item.classList.add("item_images");
            for(item2 of json.hits){
                under_section.innerHTML = "";
                
                let my_img = document.createElement("img");
                
                my_img.src=item2.webformatURL;
                my_img.dataset.url = item2.largeImageURL;
                    
                item.appendChild(my_img);
                under_section.appendChild(item);
                under_section.classList.remove("gif");
                under_section.classList.add("images");
                under_section.appendChild(item);
                type_service=1;
                
                my_img.addEventListener('click',modal_view);
            }
        }
    }
}

//Globals
var host="your_host_url";
var flag=0;
var type_service=0;
var fetch_title="";
var fetch_img_url="";
//Form
const form = document.forms['form_name'];
const under_section = document.querySelector("#under_section");
//Add listener
form.addEventListener('submit', service_check);
