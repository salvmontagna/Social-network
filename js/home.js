//Insert the like into the database
//It is called by the "check_like" function which checks if the button is set to "like" or "not unlike"
function like(event){
  const id_post_fetched = event.currentTarget.value;
  fetch(host+'/api/like.php?id_post='+id_post_fetched).then(onResponseText).then(onTextGetting);
}

function onResponseText(response){
  return response.text();
}

function onTextGetting(){
  post_getting();
}

//Delete del like dal database
function unlike(event){
  const id_post_fetched = event.currentTarget.value;
  fetch(host+'/api/unlike.php?id_post='+id_post_fetched).then(onResponseText).then(onTextGetting);  
}

//Function that checks if the like button is actually set to like or unlike, subsequently calling the correct like or unlike function
//Check the class of the clicked element, which varies from like to unlike
function check_like(event){

  if(event.currentTarget.classList=="like_button") {
    like(event);
    event.currentTarget.classList.remove("like_button");
    event.currentTarget.classList.add("unlike_button");
  }

  else {
    unlike(event);
    event.currentTarget.classList.remove("unlike_button");
    event.currentTarget.classList.add("like_button");
  }
}

function onUsersResponse(response){
  return response.json();
}

//Function to prevent the internal click from leaving the modal (preventing the propagation of the click from inside to outside)
function int_modal_prevent(event){
  event.stopPropagation();

}

//Exit from modal
function modal_exit(){
  const x = document.querySelector(".modal_view");
  x.remove();
  const body = document.querySelector("body");
  body.style="overflow: null";
}

//Json which contains the elements that will be printed in the modal (username with its image)
function onUsersJson (json){
  
  const body = document.querySelector("body");
  body.style="overflow: hidden";

  var modal_section = document.createElement("section");
  modal_section.classList.add("modal_view");
  modal_section.addEventListener("click", modal_exit);
  
  
  const internal_div = document.createElement("div");
  internal_div.addEventListener("click",int_modal_prevent);
  internal_div.classList.add("internal_div");

  const users_title = document.createElement("label");
  users_title.classList.add("users_title");
  users_title.textContent="Users who likes this post:"
  internal_div.appendChild(users_title);

  //Check that the json contains elements
  if(json.length==0){
      const error = document.createElement("p");
      error.classList.add("error");
      error.textContent="Nessun like trovNothing was foundato";

  }
  
  else for(elem of json){
    //Create element a
    const a = document.createElement("a");
    a.classList.add("item_list");

    //Create image
    const img = document.createElement("img");
    img.src="./images/user_img/"+elem.image;
    img.classList.add("user_img_likes");
    
    //Create username
    const label_username = document.createElement("label");
    label_username.classList.add("user_list");
    label_username.textContent = elem.id_username_like;

    a.appendChild(img);
    a.appendChild(label_username);
    
    internal_div.appendChild(a);

    modal_section.appendChild(internal_div);

    body.appendChild(modal_section);

  }
}

//Fetch to get users who have liked a post, check that there are no 0 likes so I avoid opening the modal
function get_users(event){

  if (event.currentTarget.textContent!="0"){
    const id_post_fetched = event.currentTarget.value;
    fetch(host+"/api/get_users.php?id_post="+id_post_fetched).then(onUsersResponse).then(onUsersJson);
  }
}

function onResponse(response){
  return response.json();
}

function onJson(json){
  section.innerHTML="";

  //Check json has elements
  if(json.length==0){
    const error = document.createElement("p");
    error.classList.add=("error");
    error.textContent="Nothing was found";
    under_section.appendChild(error);
  }
  
  else for(elem of json){

    const mini_container = document.createElement("div");
    mini_container.classList.add("mini_container");

    const user_section = document.createElement("div");
    user_section.classList.add("user_section");

    const user_img = document.createElement("img");
    user_img.classList.add("user_img");
    user_img.src="./images/user_img/"+elem.image;

    const item = document.createElement("div");
    item.classList.add("item");

    const user_nick = document.createElement("div");
    user_nick.classList.add("user_nick");
    var only_date = elem.date_stamp;
    user_nick.textContent = elem.id_username + " (Posted: "+ only_date + ")";

    const post_title = document.createElement("div");
    post_title.classList.add("post_title");
    post_title.textContent = elem.title;

    const post_img = document.createElement("img");
    post_img.src=elem.post_image;
    post_img.classList.add("post_image");

    const likes_section = document.createElement("div");
    likes_section.classList.add("likes_section");

    const like_button = document.createElement("a");
    like_button.classList.add("like_button");
    like_button.addEventListener("click",check_like);

    
    like_button.value=elem.id_post;
    
    if(elem.id_username_like!==null){
      like_button.classList.remove("like_button");
      like_button.classList.add("unlike_button");
    } 
    
    const like_counter = document.createElement("label");
    like_counter.classList.add("like_counter");
    var valore_provv = elem.like_counter;
    like_counter.innerHTML=valore_provv;
    like_counter.value=elem.id_post;
    like_counter.addEventListener("click",get_users);
    
    section.appendChild(mini_container);
    mini_container.appendChild(user_section);
    user_section.appendChild(user_img);
    user_section.appendChild(user_nick);
    mini_container.appendChild(item);
    item.appendChild(post_title);
    item.appendChild(post_img);
    mini_container.appendChild(likes_section);
    likes_section.appendChild(like_button);
    likes_section.appendChild(like_counter);
  }
}

//Fetch to the api to show all posts (contains joins to get username image and post likes)
function post_getting(){
  fetch(host+'/api/post_getting.php?').then(onResponse).then(onJson);
}

//Global selector
const getting_username = document.querySelector("#getting_username").textContent;
const section = document.querySelector(".section");

//Listener to load function on page start to show all contents.
window.addEventListener("load",post_getting);

//Globals
var host="your_host_url";
