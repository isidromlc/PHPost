<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Modelo para subir im�genes
 *
 * @name    c.upload.php
 * @author  PHPost Team
 */
class tsUpload {
    var $type = 1;  // TIPO DE SUBIDA
    var $max_size = 1048576;    // 1MB 
    var $allow_types = array('png','gif','jpeg'); // ARCHIVOS PERMITIDOS
    var $found = 0; // VARIABLE BANDERA 
    var $file_url = ''; // URL
    var $file_size = array(); // TAMA�O DEL ARCHIVO REMOTO
    var $image_size = array('w' => 570, 'h' => 450);
    var $image_scale = false;
    var $servers = array();
    var $server = 'imgur';  // DEFAULT IMGUR

    // CONSTRUCTOR
	public function __construct(){
	   $this->servers = array(
            'imgur' => 'https://api.imgur.com/3/image.json',
            'imgshack' => 'http://post.imageshack.us/transload.php',
       );
	}
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*\
								UPLOAD
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*
		newUpload($type)
        :: $type => URL o ARCHIVO
	*/
    function newUpload($type = 1){
        $this->type = $type;
        // ARCHIVOS
        if($this->type == 1){
            foreach($_FILES as $file)
                $fReturn[] = $this->uploadFile($file);
        // DESDE URL
        }elseif($this->type == 2) {
               $fReturn[] = $this->uploadUrl();
        // CROP
        } elseif($this->type == 3){
            if(empty($this->file_url)) {
                foreach($_FILES as $file)
                    $fReturn = $this->uploadFile($file);
                    if(empty($fReturn['msg'])) return array('error' => $fReturn[1]);
            } else {
                $file = array(
                    'name' => substr($this->file_url, -4),
                    'type' => 'image/url',
                    'tmp_name' => $this->file_url,
                    'error' => 0,
                    'size' => 0
                );
                //
                $fReturn = $this->uploadFile($file, 'url');
                if(empty($fReturn['msg'])) return array('error' => $fReturn[1]);
            }
        }
        //
        if($this->found == 0) return array('error' => 'No se ha seleccionado archivo alguno.');
        else return $fReturn;
	}
	/*
        uploadFiles()
    */
    function uploadFile($file, $type = 'file'){
        // VALIDAR
        $error = $this->validFile($file, $type);
        if(!empty($error)){
            return array(0, $error);
        }else{
            $type = explode('/',$file['type']);
            $ext = ($type[1] == 'jpeg' || $type[1] == 'url') ? 'jpg' : $type[1]; // EXTENCION
            $key = rand(0,1000);
            $newName = 'phpost_'.$key.'.'.$ext;
            // IMAGEN
            if($this->type == 1)
                return array(1, $this->sendFile($file,$newName), $type[1]);
            // CROP
            else
                return array('msg' => $this->createImage($file,$newName), 'error' => '', 'key' => $key, 'ext' => $ext);
            //
        }
    }
    /*
        uploadUrl()
    */
    function uploadUrl(){
        $error = $this->validFile(null, 'url');
        if(!empty($error)) return array(0, $error);
        else return array(1, urldecode($this->file_url));
    }
    /*
        validFile()
    */
    function validFile($file, $type = 'file'){
        // ARCHIVO
        if($type == 'file'){
            // SE ENCONTRO EL ARCHIVO
            if(empty($file['name'])) return 'No Found';
            else $this->found = $this->found + 1;
            //
            $type = explode('/',$file['type']);
            if($file['size'] > $this->max_size) return '#'.$this->found.' pesa mas de 1 MB.';
            elseif(!in_array($type[1], $this->allow_types)) return '#'.$this->found.' no es una imagen.';
        } elseif($type == 'url'){
            $this->file_size = getimagesize($this->file_url);
            // TAMA�O MINIMO
            $min_w = 160;
            $min_h = 120;
            // MAX PARA EVITAR CARGA LENTA
            $max_w = 1024;
            $max_h = 1024;
            $this->found = 1;
            //
            if(empty($this->file_size[0])) return 'La url ingresada no existe o no es una imagen v&aacute;lida.';
            elseif($this->file_size[0] < $min_w || $this->file_size[1] < $min_h) return 'Tu foto debe tener un tama&ntilde;o superior a 160x120 pixeles.';
            elseif($this->file_size[0] > $max_w || $this->file_size[1] > $max_h) return 'Tu foto debe tener un tama&ntilde;o menor a 1024x1024 pixeles.';
        }
        // TODO BIEN
        return false;
    }
    /*
      sendFile($file,$name)
    */
    function sendFile($file, $name){
        //
        $url = $this->createImage($file,$name);
        // SUBIMOS...
        $new_img = $this->getImagenUrl($this->uploadImagen($this->setParams($url)));
        // BORRAR
        $this->deleteFile($name);
        // REGRESAMOS
        return $new_img;
    }
    /*
        copyFile($file, $name)
    */
    function copyFile($file,$name){
        global $tsCore;
        // COPIAMOS
        $root = TS_FILES.'uploads/'.$name;
        copy($file['tmp_name'],$root);
        // REGRESAMOS LA URL
        return $tsCore->settings['url'].'/files/uploads/'.$name;
    }
    /*
        createImage()
    */
	function createImage($file, $name){
        global $tsCore;
        // TAMA�O
        $size = empty($this->file_size) ? getimagesize($file['tmp_name']) : $this->file_size;
        if(empty($size)) die('0: Intentando subir un archivo que no es v�lido.');
        $width = $size[0];
        $height = $size[1];
        // ESCALAR SOLO SI LA IMAGEN EXEDE EL TAMA�O Y SE DEBE ESCALAR
        if($this->image_scale == true && ($width > $this->image_size['w'] || $height > $this->image_size['h'])){
                // OBTENEMOS ESCALA
                if($width > $height){
                    $_height = ($height * $this->image_size['w']) / $width;
                    $_width = $this->image_size['w'];
                } else {
                    $_width = ($width * $this->image_size['h']) / $height;
                    $_height = $this->image_size['h'];
                }
            	// TIPO
        		switch($file['type']){
                    case 'image/url':
                        $img = imagecreatefromstring($tsCore->getUrlContent($file['tmp_name']));
                    break;
        			case 'image/jpeg':
        			case 'image/jpg':
        				$img = imagecreatefromjpeg($file['tmp_name']);
        				break;
        			case 'image/gif':
        				$img = imagecreatefromgif($file['tmp_name']);
        				break;
        			case 'image/png':
        				$img = imagecreatefrompng($file['tmp_name']);
        				break;
        		}
                // ESCALAMOS NUEVA IMAGEN
        		$newimg = imagecreatetruecolor($_width, $_height); 
        		imagecopyresampled($newimg, $img, 0, 0, 0, 0, $_width, $_height, $width, $height);
    			// COPIAMOS
                $root = TS_FILES.'uploads/'.$name;
                //
    			imagejpeg($newimg,$root,100);
    			imagedestroy($newimg);
    			imagedestroy($img);
                // RETORNAMOS
                return $tsCore->settings['url'].'/files/uploads/'.$name;
        } else {
            // MANTENEMOS LAS DIMENCIONES Y SOLO COPIAMOS LA IMAGEN
            return $this->copyFile($file, $name);
        }
	}
    /**
     * @name cropAvatar()
     * @uses Creamos el avatar a partir de las coordenadas resibidas
     * @access public
     * @param int
     * @return array
    */
    public function cropAvatar($key){
        $source = TS_FILES.'uploads/phpost_'.$_POST['key'].'.'.$_POST['ext'];
        $size = getimagesize($source);
        // COORDENADAS
        $x = $_POST['x'];
        $y = $_POST['y'];
        $w = $_POST['w'];
        $h = $_POST['h'];
        // TAMA�OS
        $_w = $_h = 120;
        $_tw = $_th = 50;
    	// CREAMOS LA IMAGEN DEPENDIENDO EL TIPO
		switch($size['mime']){
			case 'image/jpeg':
			case 'image/jpg':
				$img = imagecreatefromjpeg($source);
				break;
			case 'image/gif':
				$img = imagecreatefromgif($source);
				break;
			case 'image/png':
				$img = imagecreatefrompng($source);
				break;
		}
        if(!$img) return array('error' => 'No pudimos crear tu avatar...');
        //
        $width = imagesx($img);
        $height = imagesy($img);
        // AVATAR
        $avatar = imagecreatetruecolor($_w, $_h);
        imagecopyresampled($avatar, $img, 0, 0, $x, $y, $_w, $_h, $w, $h);
        // AVATAR THUMB
        $thumb = imagecreatetruecolor($_tw, $_th);
        imagecopyresampled($thumb, $img, 0, 0, $x, $y, $_tw, $_th, $w, $h);
        // GUARDAMOS...
        $root = TS_FILES.'avatar/'.$key.'_';
        imagejpeg($avatar,$root.'120.jpg',90);
        imagejpeg($thumb,$root.'50.jpg',90);
        // CLEAR
    	imagedestroy($img);
    	imagedestroy($avatar);
    	imagedestroy($thumb);
        // BORRAMOS LA ORIGINAL
        unlink($source);
        //
        return array('error' => 'success');
    }
    /*
        deleteFile()
    */
    function deleteFile($file){
        $root = TS_FILES.'uploads/'.$file;
        unlink($root);
        return true;
    }
    /*
        uploadImagen()
    */
    function uploadImagen($params){
    	// User agent
    	$useragent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; es-ES; rv:1.9) Gecko/2008052906 Firefox/3.0";
        // SERVIDOR
        $servidor = $this->servers[$this->server];
    	// Autorizar conexión
        $headers = array('Authorization: Client-ID 318cdea21b8f8c0');
        // Abrir conexión
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
		curl_setopt($ch, CURLOPT_URL, $servidor);
		curl_setopt($ch, CURLOPT_TIMEOUT , 30);		
		curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);	
		curl_setopt($ch, CURLOPT_HTTPHEADER , $headers);		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // ESTO ES PARA IMAGESHACK NO TODOS LOS SERVIDORES LO SOPORTAN
        if($this->server == 'imgshack')
            { curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1); }
        // RESULTADO
    	$result = curl_exec($ch);
    	curl_close($ch);
    	return $result;
    }
    /*
        setParams()
    */
    function setParams($url){
        switch($this->server){
            case 'imgur':
                $img = file_get_contents($url);
                return array('image' => base64_encode($img));
            break;
            case 'imgshack':
                return 'MAX_FILE_SIZE=13145728&refer=http://imageshack.us/&brand=&optimage=resample&url='.$url;
            break;
        }
    }
    /**
     * @name getImagenUrl($html)
     * @access public
     * @param string
     * @return string
     * @version 1.1
    */
    public function getImagenUrl($code){
        //
        switch($this->server){
            case 'imgur':
                global $tsCore;
                //
                $image_data = $tsCore->setJSON($code, 'decode');
                $src = $image_data->data->link;
                return $src;
            break;
            // IMAGESHACK
            case 'imgshack':
                $links = explode('Please <',$code);
                $links = explode('" />',$links[1]);
                $link = explode('"',$links[0]);
                $total = count($link);
                return $link[$total-1];
            break;
        }
    }
      
}