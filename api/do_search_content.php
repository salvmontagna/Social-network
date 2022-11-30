<?php
      
    //Initializing variables
    $service_value=$_POST["service_value"];
    $service_selected=$_POST["service_selected"];
    
    if(isset($_POST["service_value"])){
        //key giphy
        if($service_selected=="giphy"){
            $encoded_query=urlencode($service_value);
            $ch = curl_init('api.giphy.com/v1/gifs/search?api_key=thisisgiphykey&limit=20&q=' .$encoded_query );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            echo $response;
        }

        //key pixabay
        else if($service_selected=="pixabay"){
            $encoded_query=urlencode($service_value);
            $ch = curl_init('https://pixabay.com/api/?key=thisispixabaykey&q='.$encoded_query); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            echo $response;
        }  
    }
    
?>

