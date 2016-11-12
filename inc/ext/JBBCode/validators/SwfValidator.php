<?php

namespace JBBCode\validators;

require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'InputValidator.php';

/**
 * Un InputValidator para url de aplicación swf válida
 *
 * @author Kmario19
 * @since Jul 2015
 */
class SwfValidator implements \JBBCode\InputValidator {

    /**
     * Retorna true si $input es una url que termina en .swf
     *
     * @param $input texto para validar
     */
    public function validate($input) {
        $valid = filter_var($input, FILTER_VALIDATE_URL);
        $ext = substr($input, -4, 4);
        return !!$valid && $ext == '.swf';
    }

}
