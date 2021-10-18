<?php
$id = $_GET["id"];
$user_id = $_GET["user_id"];
$username = $_GET["username"];
$tell = $_GET["tell"];
$department = $_GET["dept"];
$header = $_GET["header"];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.line.me/v2/bot/message/push',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'
   { "to": "U70598c9400d87111c492e7ce4223ada7",
    "messages":[
                    {
                    "type": "flex",
                    "altText": "Register Success !",
                    "sender": {
                        "name": "CSG-BOT",
                        "iconUrl": "https://line.me/conyprof"
                    },
                     "contents": {
  "type": "bubble",
  "size": "mega",
  "direction": "ltr",
  "body": {
    "type": "box",
    "layout": "vertical",
    "spacing": "none",
    "margin": "none",
    "contents": [
      {
        "type": "text",
        "text": "'.$header.'",
        "weight": "bold",
        "size": "xl",
        "color": "#57CE5BFF",
        "align": "start",
        "gravity": "bottom",
        "wrap": true,
        "style": "normal",
        "contents": []
      },
      {
        "type": "separator",
        "margin": "md"
      },
      {
        "type": "box",
        "layout": "horizontal",
        "margin": "lg",
        "contents": [
          {
            "type": "text",
            "text": "ID",
            "weight": "bold",
            "align": "start",
            "margin": "none",
            "wrap": true,
            "style": "normal",
            "contents": []
          },
          {
            "type": "text",
            "text": "'.$id.'",
            "align": "start",
            "contents": []
          }
        ]
      },
      {
        "type": "box",
        "layout": "horizontal",
        "margin": "sm",
        "contents": [
          {
            "type": "text",
            "text": "Username",
            "weight": "bold",
            "contents": []
          },
          {
            "type": "text",
            "text": "'.$username.'",
            "contents": []
          }
        ]
      },
      {
        "type": "box",
        "layout": "horizontal",
        "margin": "none",
        "contents": [
          {
            "type": "text",
            "text": "Tell",
            "weight": "bold",
            "contents": []
          },
          {
            "type": "text",
            "text": "'.$tell.'",
            "contents": []
          }
        ]
      },
      {
        "type": "box",
        "layout": "horizontal",
        "contents": [
          {
            "type": "text",
            "text": "Department",
            "weight": "bold",
            "contents": []
          },
          {
            "type": "text",
            "text": "'.$department.'",
            "contents": []
          }
        ]
      },
      {
        "type": "separator",
        "margin": "lg"
      },
      {
        "type": "box",
        "layout": "vertical",
        "margin": "lg",
        "contents": [
          {
            "type": "text",
            "text": "โปรดระบุปัญหาที่พบ โดยละเอียด  หลังจากได้รับข้อความของท่านแล้ว ทางทีมจะติดต่อกลับและดำเนินการต่อโดยเร็ว ขอบคุณ",
            "align": "center",
            "gravity": "center",
            "wrap": true,
            "contents": []
          }
        ]
      }
    ]
  }
}
                     
                    }
            ]
    }',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer J/R5foEYEGdmDL85DJBMdlMfOos7JOKVlqzd4VOE3nXpT8OtSoc6On+3wNH4bZ6GU+4riP4v562ixfwVUwWdDmHae3qbVBxKUMrKcgoBFbGkrpX+QttoamNeNodqY5aXN3hXijql94zqPLAW7d+JgQdB04t89/1O/w1cDnyilFU='
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//  echo $response;

?>