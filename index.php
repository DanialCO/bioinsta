<?php
/*
ربات نوشته شده توسط دانیال ملک زاده (@JanPHP)دریافت اخبار در @Danial_Rbo
*/
//------@mriven----//
define('API_KEY','420983979:AAE_u9vOmozv9lUu62d27mE4bHzZIUQbYec');
//-----@mriven-----//
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
function sendmessage($chat_id, $text){
 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>$text,
 'parse_mode'=>"MarkDown"
 ]);
 } 
 function objectToArrays($object)
    {
        if (!is_object($object) && !is_array($object)) {
            return $object;
        }
        if (is_object($object)) {
            $object = get_object_vars($object);
        }
        return array_map("objectToArrays", $object);
    }
//-------@mriven-----//
$update = json_decode(file_get_contents('php://input'));
$from_id = $update->message->from->id; 
$chat_id = $update->message->chat->id;
$chatid = $update->callback_query->message->chat->id;
$data = $update->callback_query->data;
$text = $update->message->text;
$message_id = $update->callback_query->message->message_id;
$message_id_feed = $update->message->message_id;
////------@mriven-----//
if(preg_match('/^\/([Ss]tart)/',$text)){
bot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"سلام به ربات دریافت اطلاعات اینستاگرام خوش آمدی.",
    'parse_mode'=>'html',
   'reply_markup'=>json_encode([
      'inline_keyboard'=>[
	  	  [
['text'=>'دریافت اطلاعات','callback_data'=>'men']
]
		]
		])
  ]);
  }elseif ($data == "blok") {
  bot('editMessagetext',[
    'chat_id'=>$chatid,
	'message_id'=>$message_id,
    'text'=>"به ربات دریافت اطلاعات اینستاگرام خوش آمدید.",
    'parse_mode'=>'html',
   'reply_markup'=>json_encode([
      'inline_keyboard'=>[
	  [
['text'=>'دریافت اطلاعات','callback_data'=>'men']
]
		]
		])
  ]);
  }elseif ($data == "men") {
  bot('editMessagetext',[
    'chat_id'=>$chatid,
	'message_id'=>$message_id,
    'text'=>"خب دوست عزیز ایدی کاربر را بدون @ ارسال کن تا اطلاعاتشو بگم:",
    'parse_mode'=>'html',
   'reply_markup'=>json_encode([
      'inline_keyboard'=>[
	  [
['text'=>'بازگشت','callback_data'=>'blok']
]
		]
		])
  ]);
  }
elseif($text){
$ali1 = json_decode(file_get_contents("https://instagram.com/".$text."/?__a=1"));
    $tik2 = objectToArrays($ali1);
    $a1 = $tik2['user']['biography'];
    $a2 = $tik2["user"]["followed_by"]["count"];
    $a3 = $tik2["user"]["follows"]["count"];
    $a4 = $tik2["user"]["media"]["count"];
    $a5 = $tik2["user"]["external_url"];
    $a6 = $tik2["user"]["username"];
     $a7 = $tik2["user"]["profile_pic_url_hd"];
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"خوب اینم بیوگرافی  کاربر :",
 'parse_mode'=>'html',
   'reply_markup'=>json_encode([
      'inline_keyboard'=>[
	             [
                 ['text'=>"بیوگرافی:",'url'=>"http://instagram.com/$text"]
             ],
             [
                 ['text'=>"$a1",'url'=>"http://instagram.com/$text"]
             ],
             [
                 ['text'=>"دنبال کنندها:",'url'=>"http://instagram.com/$text"]
             ],
             [
                 ['text'=>"$a2",'url'=>"http://instagram.com/$text"]
             ],
             [
                 ['text'=>"دنبال شدگان",'url'=>"http://instagram.com/$text"]
             ],
             [
                 ['text'=>"$a3",'url'=>"http://instagram.com/$text"]
                 ],
                 [
                 
                 ['text'=>"پست ها:",'url'=>"http://instagram.com/$text"]
                 ],
                 [
                 ['text'=>"$a4",'url'=>"http://instagram.com/$text"]               
             ]
         ]
     ])
 ]);
}
?>
