//Function to add the clicked user to the follow
//It is called by the "check_following" function which checks if the button is set to "follow" or "unfollow"
function follow(event){
    username_fetched= event.currentTarget.value;
    fetch(host+'/api/follower.php?username='+(getting_username).replace(/ /g,'')+'&username_following='+username_fetched).then(onResponse);
}
function unfollow(event){
    username_fetched= event.currentTarget.value;
    fetch(host+'/api/unfollower.php?username='+ (getting_username).replace(/ /g,'') +'&username_following='+username_fetched).then(onResponse2);
}


//I verify that the user must actually follow or not follow the person, to call the related function to execute
//Checking the text of the button that is clicked "follow" or "unfollow"
function check_following(event){
    if(event.currentTarget.textContent=="Follow") {
        follow(event);
        event.currentTarget.textContent = "Unfollow";
    }
    else if (event.currentTarget.textContent=="Unfollow"){
        unfollow(event);
        event.currentTarget.textContent = "Follow";
    }
}

function onResponse(response){
    return response.text();
}

function onResponse2(response){
    return response.text();
}

// I get the json that contains the info of all the users and I loop it as much as its length
//Obtained all the info, I build the html dynamically to print them
function onJSON(json){

    under_section.innerHTML="";
    //Check if json has elements
    if(json.length==0){
        const error = document.createElement("p");
        error.classList.add("errore");
        error.textContent="Nothing was found";
        under_section.appendChild(error);
    }
    
    else for(elem of json){

        const a = document.createElement("a");
        a.classList.add("item_list");

        const label_img = document.createElement("label");
        const img = document.createElement("img");
        img.src="./images/user_img/"+elem.image;
        img.classList.add("img_list");
        label_img.appendChild(img);

        const label_name = document.createElement("label");
        label_name.classList.add("name_list");
        label_name.textContent= " " + elem.name + " " + elem.surname + " (";

        const label_username = document.createElement("label");
        label_username.classList.add("user_list");
        label_username.textContent = elem.username+") ";

        section.appendChild(under_section);
        under_section.appendChild(a);
        a.appendChild(label_img);
        a.appendChild(label_name);
        a.appendChild(label_username);

        const label_following = document.createElement("label");
        label_following.classList.add("following_list");
     
        //Filter the follow element of the json to see who follows and who doesn't follow the user
        if(elem.follow==1 ){
            label_following.textContent = "Unfollow";
            label_following.value=elem.username;            
            label_following.addEventListener('click', check_following);
        }
        
        else {
            label_following.textContent = "Follow";
            label_following.value=elem.username;
            label_following.addEventListener('click', check_following);
        } 
        //Filter the follow to prevent the user from following himself and append the follow "buttons"
        var last_getting_username = getting_username.replace(/ /g,'');
        if(elem.username.toLowerCase()!==(last_getting_username).toLowerCase()) a.appendChild(label_following);        
    }
}

function onResponse(response){
    return response.json();
}

//Fetch aim research
function aim_research(){
    if(search.value.trim().length!=0)  fetch(host+'/api/do_search_people.php?username=' + search.value +'&name=' + search.value +'&surname=' + search.value).then(onResponse).then(onJSON);
    else{
        //Error if the search is null
        under_section.innerHTML="";
        const error = document.createElement("p");
        error.classList.add("error");
        error.textContent="Nothing was found";
        under_section.appendChild(error);
    }
}

//General research
function general_research(){
    fetch(host+'/api/do_search_people.php?username=' + '&name='+'&surname=').then(onResponse).then(onJSON);
    search.value="";
}

//Selector
const form = document.forms["form_name"];
const section = document.querySelector("#myUl");
const under_section = document.querySelector("#under_section")
const getting_username = document.querySelector("#getting_username").textContent;
const getting_follower = document.querySelector(".user_list");

//Listeners
form.cerca.addEventListener('click',aim_research);
form.cerca_tutti.addEventListener('click',general_research);

//Globals
var host="your_host_url";
let username_fetched="";
const search = form.research;