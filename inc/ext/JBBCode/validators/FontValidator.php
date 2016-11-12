<?php

namespace JBBCode\validators;

require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'InputValidator.php';

/**
 * Validador de fuentes para evitar malformaciones en la pagina
 *
 * @author Alan
 * @since Sep 2016
 */

class FontValidator implements \JBBCode\InputValidator {

    /**
     * Retorna true si $input es alfabético
     *
     * @param $input string a validar
     */
    public function validate($input) {
        return !!preg_match('/^[a-z\s]+$/i', $input);
    }

}