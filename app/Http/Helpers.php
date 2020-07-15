 <?
class Helpers{

/**
* @param $to
* @param $msg
* @return mixed
*/
public static function smsMisr($to, $msg){

  $url = 'https://smsmisr.com/api/webapi/?';
  $push_payload = array(
     'username' => '****',
     'password' => '****',
     'language' => '****',
     'sender' => 'ipda3',
     'mobile' => '2'. $to,
     'msg' => $msg,

  );

  $rest = curl_init();
  curl_setopt($rest,    CURLOPT_URL,    $url.http_build_query($push_payload));
  curl_setopt($rest,    CURLOPT_POST,    $url.http_build_query($push_payload));
  curl_setopt($rest,    CURLOPT_POSTFIELDS,    $url.http_build_query($push_payload));
  curl_setopt($rest,    CURLOPT_SSL_VERIFYPEER,    true);
  curl_setopt($rest,    CURLOPT_HTTPHEADER,
     array(
       "content-Type" =. "application/x-www-form-urlencoded"
      ));
  curl_setopt($rest,    CURLOPT_RETURNTRANSFER,    1);
  $response = curl_exec($rest);
  curl_close($rest);
  return $response;
 }

}
?>
