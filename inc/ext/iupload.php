<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');

function upload($image) {
    $server  = 'https://api.imgur.com/3/image.json';
    $headers = array(
        'Authorization: Client-ID b2fddcb704b44a5'
    );
    $image   = file_get_contents($image);
    $pvars   = array(
        'image' => base64_encode($image)
    );
    $ch      = curl_init();
    curl_setopt($ch, CURLOPT_URL, $server);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $pvars);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

if (isset($_FILES['img'])) {
    $isIframe = ($_POST["iframe"]) ? true : false;
    $idarea   = $_POST["idarea"];
    $response = upload($_FILES['img']['tmp_name']);
    $data     = json_decode($response, true);
    $img_url  = $data['data']['link'];
    if ($isIframe) {
        echo '<html><body>OK<script>window.parent.$("#' . $idarea . '").insertImage("' . $img_url . '","' . $img_url . '").closeModal().updateUI();</script></body></html>';
    } else {
        header("Content-type: text/javascript");
        echo '{"status":1,"msg":"OK","image_link":"' . $img_url . '","thumb_link":"' . $img_url . '"}';
    }
} else {
    header("Content-type: text/javascript");
    echo '{"status":0,"msg":"Empty"}';
}