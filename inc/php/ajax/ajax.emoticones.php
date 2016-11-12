<?php if ( ! defined('TS_HEADER')) exit('No se permite el acceso directo al script');
/**
 * Controlador AJAX
 *
 * @name    ajax.emoticones.php
 * @author  PHPost Team
*/
/**********************************\

*	(VARIABLES POR DEFAULT)		*

\*********************************/

	// NIVELES DE ACCESO Y PLANTILLAS DE CADA ACCIÓN
	$files = array(
		'emoticonos' => array('n' => 2, 'p' => ''),
	);

/**********************************\

* (VARIABLES LOCALES ESTE ARCHIVO)	*

\*********************************/

	// REDEFINIR VARIABLES
	$tsPage = 'php_files/p.emoticonos.'.$files[$action]['p'];
	$tsLevel = $files[$action]['n'];
	$tsAjax = empty($files[$action]['p']) ? 1 : 0;

/**********************************\

*	(INSTRUCCIONES DE CODIGO)		*

\*********************************/
	
	// DEPENDE EL NIVEL
	$tsLevelMsg = $tsCore->setLevel($tsLevel, true);
	if($tsLevelMsg != 1) { echo '0: '.$tsLevelMsg['mensaje']; die();}
	// HTML
    $emoticones = array(
        array("(A)","014.png"),
        array(":[","043.png"),
        array(":-#","048.png"),
        array(":-*","052.png"),
        array("+o(","053.png"),
        array("(brb)","066.gif"),
        array(":^)","072.gif"),
        array("*-)","073.gif"),
        array("<o)","075.gif"),
        array("8-)","076.gif"),
        array("|-)","078.gif"),
        array(";-/","082.png"),
        array("(jk)","084.png"),
        array("(j)","086.png"),
        array("(V)","087.png"),
        array("(lol)","089.gif"),
        array("(xD)","090.png"),
        array(":8)","088.png"),
        array("(ff)","091.gif"),
        array("(fm)","092.gif"),
        array(":'|","093.gif"),
        array(":]","094.gif"),
        array(":}","095.png"),
        array("(BOO)","096.png"),
        array("*|","097.gif"),
        array("*\\","098.png"),
        array("(wm)","100.png"),
        array("(xo)","101.gif"),
        // OBJETOS
        array("(l)","015.png"),
        array("(u)","016.png"),
        array("(@)","018.png"),
        array("(&)","019.png"),
        array("(S)","020.png"),
        array("(*)","021.png"),
        array("(~)","022.png"),
        array("(8)","023.png"),
        array("(E)","024.png"),
        array("(F)","025.png"),
        array("(W)","026.png"),
        array("(O)","027.gif"),
        array("(K)","028.png"),
        array("(G)","029.png"),
        array("(^)","030.png"),
        array("(P)","031.png"),
        array("(I)","032.png"),
        array("(C)","033.png"),
        array("(T)","034.png"),
        array("({)","035.png"),
        array("(})","036.png"),
        array("(B)","037.png"),
        array("(D)","038.png"),
        array("(Z)","039.png"),
        array("(X)","040.png"),
        array("(Y)","041.png"),
        array("(N)","042.png"),
        array("(nnh)","044.png"),
        array("(#)","046.png"),
        array("(R)","047.png"),
        array("(sn)","054.png"),
        array("(tu)","055.png"),
        array("(pl)","056.png"),
        array("(||)","057.png"),
        array("(pi)","058.png"),
        array("(so)","059.png"),
        array("(au)","060.png"),
        array("(ap)","061.png"),
        array("(um)","062.png"),
        array("(ip)","063.png"),
        array("(co)","064.png"),
        array("(mp)","065.png"),
        array("(st)","067.png"),
        array("(pu)","102.png"),
        array("(yn)","068.png"),
        array("(h5)","069.gif"),
        array("(mo)","070.png"),
        array("(bah)","071.png"),
        array("(li)","074.gif"),
        array("(wo)","077.png"),
        array("'.'","080.png"),
        array("(bus)","045.png"),
        array("*p*","079.png"),
        array("*s*","085.png"),
        array("(M)","017.png"),
        array("(xx)","103.png"),
);
    // 
    foreach($emoticones as $key => $emo){
        echo '<a smile="'.$emo[0].'" href="#"><img src="'.$tsCore->settings['default'].'/images/smiles/'.$emo[1].'" style="margin:auto 2px;"/></a>';
    }
?>