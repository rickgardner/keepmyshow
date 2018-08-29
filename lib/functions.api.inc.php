<?php

function getApiKey() {
  $apikey = "f58f8be9b4c426b7b720548bd0ec7f36";
  return $apikey;  
}


function getTmdbShow($showid) {
  $apikey = getApiKey();
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.themoviedb.org/3/tv/$showid?api_key=$apikey&language=en-US",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => "[]",
    CURLOPT_HTTPHEADER => array(
      "Cache-Control: no-cache",
      "Content-Type: application/json",
      "Postman-Token: 1bfd2e63-5cc1-40d4-abe9-b84d796f56e2"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    return $response;
  }
}

function getBackdrops($showid) {
  //https://api.themoviedb.org/3/tv/66871/images?api_key=f58f8be9b4c426b7b720548bd0ec7f36
  $apikey = getApiKey();
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.themoviedb.org/3/tv/$showid/images?api_key=$apikey",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => "[]",
    CURLOPT_HTTPHEADER => array(
      "Cache-Control: no-cache",
      "Content-Type: application/json",
      "Postman-Token: 1bfd2e63-5cc1-40d4-abe9-b84d796f56e2"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    return $response;
  }
}


function getExternalIds($showid) {
  $apikey = getApiKey();
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.themoviedb.org/3/tv/$showid/external_ids?api_key=$apikey",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => "[]",
    CURLOPT_HTTPHEADER => array(
      "Cache-Control: no-cache",
      "Content-Type: application/json",
      "Postman-Token: 1bfd2e63-5cc1-40d4-abe9-b84d796f56e2"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    return $response;
  }
}


?>