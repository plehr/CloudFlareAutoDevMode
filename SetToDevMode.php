<?php
// If you would like to enable the development_mode on cloudflare you can use this script.
// Set the envitoment variables "cfzone" with your zone ID, your mail adress for your cloudflare account into "cfuser"
// and your API-Key to the "cfkey"-variable. If you don't know your zoneID: http://bit.ly/1PO9wzP
// Then you have to add a webhook on Github: Github -> your Project -> Settings -> Webhooks & services.
// Add your URL to this php-file. It's important to specify your event triggers.
// When you don't know what you should specify, click "send me everything".
// Push this script and on your next push it should work.
// To debug your connection uncomment the $response.
function devmode($zoneid = null) {
  if ($zoneid != null) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.cloudflare.com/client/v4/zones/" . $zoneid . "/settings/development_mode",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "PATCH",
      CURLOPT_POSTFIELDS => "{\"value\":\"on\"}",
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json",
        "x-auth-email: " . getenv('cfuser'),
        "x-auth-key: " . getenv('cfkey')
      ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
      echo "CF not OK!!";
    } else {
      echo "CF OK";
      //echo $response;
      //echo "User:" . getenv('cfuser');
      //echo "<br>";
      //echo "Key:" . getenv('cfkey');
      //echo "<br>";
      //echo "Zone:" . getenv('cfzone');
    }
  }
}
?>
