<?php

namespace JBBCode\validators;

require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'InputValidator.php';

/**
 * Un InputValidator para valores de tamaño de texto válidos
 *
 * @author Kmario19
 * @since Jul 2015
 */
class SizeValidator implements \JBBCode\InputValidator {

    /**
     * Retorna true si $input es un número
     *
     * @param $input numero para validar
     */
    public function validate($input) {
        return is_numeric($input) && $input > 0;
    }

}
