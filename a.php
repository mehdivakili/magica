مجید مؤذنی, [14.10.20 22:26]
<?php
$input = file_get_contents("php://input");
file_put_contents('result.txt', $input . PHP_EOL . PHP_EOL, FILE_APPEND);
$update = json_decode($input, true);
define('API_TOKEN', '1318380384:AAEgFWiyma7R5BowUvqj_jo9MYUcIl6KkmM');
$api_url = 'https://api.telegram.org/bot' . API_TOKEN . '/';
$user_id = $update['message']['from']['id'];
$chat_id = $update['message']['chat']['id'];
$text = $update['message']['text'];
$message_id = $update['message']['message_id'];
//file_get_contents($api_url.'sendmessage?chat_id='.$chat_id.'&text=سلام '.'&reply_to_message_id='.$message_id);
if ($text == "سلام") {
    file_get_contents($api_url . 'sendmessage?chat_id=' . $chat_id . '&text=سلام' . '&reply_to_message_id=' . $message_id);
} else {
    file_get_contents($api_url . 'sendmessage?chat_id=' . $chat_id . '&text=نمیفهمم' . '&reply_to_message_id=' . $message_id);
}
/*function foshlock(){
    $input=file_get_contents("php://input");
    file_put_contents('result.txt',$input.PHP_EOL.PHP_EOL,FILE_APPEND);
    $update=json_decode($input,true);
    define('API_TOKEN','1318380384:AAEgFWiyma7R5BowUvqj_jo9MYUcIl6KkmM');
    $api_url='https://api.telegram.org/bot'.API_TOKEN.'/';
    $user_id=$update['message']['from']['id'];
    $chat_id=$update['message']['chat']['id'];
    $text=$update['message']['text'];
    $message_id=$update['message']['message_id'];
    if ($text=='کیر'){
        $res=file_get_contents($api_url.'deleteMessage?chat_id='.$chat_id.'&message_id='.$message_id);}
    else{
        $res=file_get_contents($api_url.'sendmessage?chat_id='.$chat_id.'&text='.$text.'&reply_to_message_id='.$message_id);

    }

}*/
/*if ($text=='hello'){
    $res=file_get_contents($api_url.'sendmessage?chat_id='.$chat_id.'&text='.'&reply_to_message_id='.$message_id);

}*/
/*if ($text=='کیر'){
  $res=file_get_contents($api_url.'deleteMessage?chat_id='.$chat_id.'&message_id='.$message_id);}
  else{
  $res=file_get_contents($api_url.'sendmessage?chat_id='.$chat_id.'&text='.$text.'&reply_to_message_id='.$message_id);

//}*/
$res = file_get_contents($api_url . 'sendmessage?chat_id=' . $chat_id . '&text=' . $text . '&reply_to_message_id=' . $message_id);
file_put_contents('result2.txt', $res . PHP_EOL . PHP_EOL, FILE_APPEND);
?>
