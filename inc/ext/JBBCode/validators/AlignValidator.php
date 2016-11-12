<?php

namespace JBBCode\validators;

require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'InputValidator.php';

/**
 * Un InputValidator para valores de alineación de texto válidos
 *
 * @author Kmario19
 * @since Jul 2015
 */
class AlignValidator implements \JBBCode\InputValidator {

    /**
     * Retorna true si $input es un valor válido de alineacion
     * de texto
     *
     * @param $input texto para validar
     */
    public function validate($input) {
        $values = array('left', 'center', 'justify', 'right');
        return (bool) in_array($input, $values);
    }

}
