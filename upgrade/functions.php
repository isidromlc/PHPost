<?php
// Se omite la consulta
define('QUERY_RESULT_SKIP', 0);

// Se ejecuto correctamente.
define('QUERY_RESULT_OK', 1);

// Se produjo un error.
define('QUERY_RESULT_ERROR', 2);

/**
 * Conecta a la base de datos.
 * En caso de error informa el tipo.
 * @param string $password Contraseña.
 * @return int 1 Si fue correcto, 0 si no se pudo conectar, -1 si no pudo seleccionar la BD.
 */
function do_connect($db)
{
    
    $db_link = @mysql_connect($db['hostname'], $db['username'], $db['password']);

	if (empty($db_link))
	{
	    return 0;
	}
	else
	{
	    if ( ! @mysql_select_db($db['database'], $db_link))
	    {
	        return -1;
	    }
	    else
	    {
	        return 1;
	    }
	}
}

/**
 * Comprobamos la coneccion a la base de datos.
 */
function check_connection()
{
    if ( ! isset($_SESSION['db']))
    {
        header("Location: index.php?step=1");
    }

    $db = $_SESSION['db'];
    $rst = do_connect($db);

    if ($rst !== 1)
    {
        unset($_SESSION['db']);
        session_destroy();
        header("Location: index.php?step=1");
    }
}

/**
 * Como do_query pero usa un stdClass para funciones complejas.
 */
function do_object_query($query)
{
    $fname = $query->fname;

    try {
        $rst = call_user_func($fname);
        return array(QUERY_RESULT_OK, NULL);
    }
    catch(Exception $e)
    {
        return array(QUERY_RESULT_ERROR, $e->getCode().': '.$e->getMessage());
    }
}

/**
 * Realizamos una consulta si es necesario.
 * @param string $query Consulta SQL.
 * @param bool $do Realizar la consulta.
 * @return array Arreglo, en 0 está el resultado (de tipo QUERY_RESULT_*)
 * y en 1 el mensaje de error si lo hubiera.
 */
function do_query($query, $do = TRUE, $status = NULL)
{
    $rst = array();
    if ($do)
    {
        // Si es stdClass es funcion externa.
        if (is_object($query))
        {
            return do_object_query($query);
        }

        // Si es una arreglo usamos transacción.
        if (is_array($query))
        {
            // Iniciamos transacción.
            mysql_query("BEGIN"); // No funcionan en MySQL.

            //Ejecutamos las consultas.
            $err = TRUE;
            foreach($query as $k => $q)
            {
                if (is_array($status) && isset($status[$k]))
                {
                    $err = FALSE;
                    continue;
                }

                $err = @mysql_query($q);

                if ($err === FALSE)
                {
                    $err = TRUE;
                    break;
                }
                else
                {
                    $err = FALSE;
                }
            }

            // Terminamos la transacción
            if ($err)
            {
                $rst[1] = mysql_errno().': '.mysql_error();
                $rst[0] = QUERY_RESULT_ERROR;
                mysql_query("ROLLBACK");
            }
            else
            {
                mysql_query("COMMIT");
                $rst[0] = QUERY_RESULT_OK;
                $rst[1] = NULL;
            }
        }
        else
        {
            // Ejecutamos la consulta.
            $q_r = mysql_query($query);
            if ($q_r)
            {
                $rst[0] = QUERY_RESULT_OK;
                $rst[1] = NULL;
            }
            else
            {
                $rst[0] = QUERY_RESULT_ERROR;
                $rst[1] = mysql_errno().': '.mysql_error();
            }
        }

    }
    else
    {
        $rst[0] = QUERY_RESULT_SKIP;
        $rst[1] = NULL;
    }
    return $rst;
}

/**
 * Agregamos una consulta a ejecutar.
 * @param string $name Nombre del paso.
 * @param array $collection Colección de las consultas.
 * @param string $query Consulta de Instalación.
 * @param string $u_query Consulta de desinstalación. Si no se pone no se puede deshacer.
 * @return array Nueva colección de consultas.
 */
function add_query($name, $collection, $query, $u_query = NULL)
{
    // Verificamos que la coleccion sea un arreglo.
    if ( ! is_array($collection))
    {
        throw new InvalidArgumentException("La colección debe ser un arreglo.");
        return FALSE;
    }

    // Generamos la clave en base a un hash.
    $key = md5($name);

    // Creamos el objeto a agregar a la coleccion.
    $add = new stdClass;
    $add->query = $query;
    $add->u_query = $u_query;
    $add->name = $name;

    // Verificamos si existen varias consultas para ese nombre.
    if (isset($collection[$key]))
    {
        $collection[$key]->queries[] = $add;
    }
    else
    {
        $obj = new stdClass;
        $obj->name = $name;
        $obj->queries = array($add);
        $collection[$key] = $obj;
    }
    return $collection;
}

function add_check_query($name, $collection, $query)
{
    // Verificamos que la coleccion sea un arreglo.
    if ( ! is_array($collection))
    {
        throw new InvalidArgumentException("La colección debe ser un arreglo.");
        return FALSE;
    }

    // Generamos la clave en base a un hash.
    $key = md5($name);

    $collection[$key] = $query;

    return $collection;
}

/**
 * Genera el HTML de la collección.
 * @param array $collection Colección de las consultas.
 */
function generate_collection($collection)
{
    // Verificamos que la coleccion sea un arreglo.
    if ( ! is_array($collection))
    {
        throw new InvalidArgumentException("La colección debe ser un arreglo.");
        return FALSE;
    }

    // Generamos el HTML
    $list = array();
    foreach($collection as $key => $element)
    {
        $list[] = "<dt class=\"cf\"><label for=\"$key\">{$element->name}:</label><br /></dt><dd class=\"cf\"><input type=\"checkbox\" checked=\"checked\" value=\"1\" id=\"$key\" name=\"update[$key]\" /></dd>";
    }
    return implode("\n", $list);
}

/**
 * Ejecutamos todas las consultas de limpieza y generamos el resultado.
 */
function procesar_limpieza_collection($collection)
{
    // Verificamos que la coleccion sea un arreglo.
    if ( ! is_array($collection))
    {
        throw new InvalidArgumentException("La colección debe ser un arreglo.");
        return FALSE;
    }

    // Procesamos la collección.
    $rst = array();
    $i = 0;
    foreach($collection as $key => $element)
    {
        $arr_list = array_map(create_function('$a','return $a->u_query;'), $element->queries);
        $arr_list = array_filter($arr_list, create_function('$a', 'return !empty($a);'));

        // Verificamos la cantidad para el tipo.
        if (count($arr_list) == 0)
        {
            $q_rst = array(QUERY_RESULT_SKIP, NULL);
        }
        elseif (count($arr_list) == 1)
        {
            $q_rst = do_query($arr_list[0], TRUE);
        }
        else
        {
            $q_rst = do_query($arr_list, TRUE);
        }
        $rst[$key] = $q_rst;
    }

    return $rst;
}

/**
 * Ejecutamos todas las consultas y generamos el resultado.
 */
function procesar_collection($collection, $selected, $c_collection)
{
    // Verificamos que la coleccion sea un arreglo.
    if ( ! is_array($collection))
    {
        throw new InvalidArgumentException("La colección debe ser un arreglo.");
        return FALSE;
    }

    // Procesamos la collección.
    $rst = array();
    $i = 0;
    foreach($collection as $key => $element)
    {
        $do = isset($selected[$key]) && $selected[$key];

        if ($do)
        {
            // Comprobamos el estado.
            $status = check_install_step($c_collection, $key);
            if (is_array($status) || $status === TRUE)
            {
                $arr_list = array_map(create_function('$a','return $a->query;'), $element->queries);
                // Verificamos la cantidad para el tipo.
                if (count($arr_list) == 0)
                {
                    $q_rst = array(QUERY_RESULT_OK, NULL);
                }
                elseif (count($arr_list) == 1)
                {
                    if(is_array($status) && isset($status[0]))
                    {
                        $s = $status[0];
                    }
                    else
                    {
                        $s = TRUE;
                    }
                    $q_rst = do_query($arr_list[0], $s);
                }
                else
                {
                    $q_rst = do_query($arr_list, $do, $status);
                }
            }
            else
            {
                $q_rst = array(QUERY_RESULT_SKIP, NULL);
            }
        }
        else
        {
            $q_rst = array(QUERY_RESULT_SKIP, NULL);
        }
        $rst[$key] = $q_rst;
    }

    return $rst;
}

/**
 * Generamos un HTML para informar del estado de la limpieza.
 */
function resultado_limpieza_html($collection, $resultado)
{
    // Verificamos que la coleccion sea un arreglo.
    if ( ! is_array($collection))
    {
        throw new InvalidArgumentException("La colección debe ser un arreglo.");
        return FALSE;
    }

    // Verificamos que el resultado sea un arreglo.
    if ( ! is_array($resultado))
    {
        throw new InvalidArgumentException("El resultado debe ser un arreglo.");
        return FALSE;
    }

    // Verificamos que correspondan los tamaños
    if (count($collection) != count($resultado))
    {
        throw new InvalidArgumentException("No coinciden los arreglos de resultado.");
        return FALSE;
    }

    // Generamos el informe
    $list = array();
    foreach($collection as $key => $element)
    {
        $rst = $resultado[$key][0];
        $html_rst = ($rst == QUERY_RESULT_SKIP ? 'skip' : ($rst == QUERY_RESULT_OK ? 'ok' : 'error'));
        $error_html = $resultado[$key][0] == QUERY_RESULT_ERROR ? "<div class=\"error-msg\">{$resultado[$key][1]}</div>" : '';

        $arr_list = array_map(create_function('$a','return $a->u_query;'), $element->queries);
        $arr_list = array_filter($arr_list, create_function('$a', 'return !empty($a);'));

        $queries_count = count($arr_list);
        $queries_html = $queries_count.' consulta'.($queries_count > 1 ? 's' : '');

        $list[] = "<dt class=\"cf\"><label for=\"$key\">{$element->name}:</label><br /><span>$queries_html</span></dt><dd class=\"cf\"><div class=\"rst-$html_rst\">$html_rst</div></dd>$error_html";
    }
    return implode("\n", $list);
}

/**
 * Verificamos si debe realizarse ese paso.
 */
function check_install_step($check_collection, $key)
{
    if ( ! isset($check_collection[$key]))
    {
        return TRUE;
    }

    $data = $check_collection[$key];

    if ($data[0] == 'table' || $data[0] == 'table_not')
    {
        // Comprobar existencia tabla.
        $result = @mysql_query("SELECT COUNT(*) FROM {$data[1]}");
        if (is_resource($result))
        {
            return $data[0] == 'table_not' ? TRUE : FALSE;
        }
        else
        {
            return $data[0] == 'table_not' ? FALSE : TRUE;
        }
    }
    elseif ($data[0] == 'fields')
    {
        // Comprobamos existencia de los campos.

        //Obtenemos el listado de campos.
        $rst = @mysql_query("DESCRIBE {$data[1]}");

        if ( ! $rst)
        {
            return FALSE;
        }

        $list = array();
        while ($row = mysql_fetch_assoc($rst))
        {
            $list[$row['Field']] = $row;
        }

        $c = array();
        foreach($data[2] as $kk => $f)
        {
            switch($f[1])
            {
                case 'DROP':
                    if ( ! isset($list[$f[0]]))
                    {
                        $c[$kk] = FALSE;
                    }
                    break;
                case 'ADD':
                    if (isset($list[$f[0]]))
                    {
                        $c[$kk] = FALSE;
                    }
                    break;
                case 'CHANGE':
                    if ( ! isset($list[$f[0]]) && isset($list[$f[2]]))
                    {
                        $c[$kk] = FALSE;
                    }
                    break;
                default:
                    $c[$kk] = FALSE;
            }
        }
        if (count($c) != 0)
        {
            return $c;
        }
        else
        {
            return TRUE;
        }
    }
    elseif ($data[0] == 'custom')
    {
        return call_user_func($data[1]);
    }
    else
    {
        // NADA RECONOCIDO.
        return TRUE;
    }
}

/**
 * Generamos un HTML para informar del estado de la actualización.
 */
function resultado_html($collection, $resultado)
{
    // Verificamos que la coleccion sea un arreglo.
    if ( ! is_array($collection))
    {
        throw new InvalidArgumentException("La colección debe ser un arreglo.");
        return FALSE;
    }

    // Verificamos que el resultado sea un arreglo.
    if ( ! is_array($resultado))
    {
        throw new InvalidArgumentException("El resultado debe ser un arreglo.");
        return FALSE;
    }

    // Verificamos que correspondan los tamaños
    if (count($collection) != count($resultado))
    {
        throw new InvalidArgumentException("No coinciden los arreglos de resultado.");
        return FALSE;
    }

    // Generamos el informe
    $list = array();
    foreach($collection as $key => $element)
    {
        $rst = $resultado[$key][0];
        $html_rst = ($rst == QUERY_RESULT_SKIP ? 'skip' : ($rst == QUERY_RESULT_OK ? 'ok' : 'error'));
        $error_html = $resultado[$key][0] == QUERY_RESULT_ERROR ? "<div class=\"error-msg\">{$resultado[$key][1]}</div>" : '';
        $queries_count = count($element->queries);
        $queries_html = $queries_count.' consulta'.($queries_count > 1 ? 's' : '');

        $list[] = "<dt class=\"cf\"><label for=\"$key\">{$element->name}:</label><br /><span>$queries_html</span></dt><dd class=\"cf\"><div class=\"rst-$html_rst\">$html_rst</div></dd>$error_html";
    }
    return implode("\n", $list);
}

function execute_safe($sql, $error = array(), $rollback = FALSE)
{
    if ( ! @mysql_query($sql))
    {
        $err_str = mysql_error();
        $err_no  = mysql_errno();
        if ($rollback) mysql_query("ROLLBACK");
        if ($err_str === '')
        {
            throw new Exception($err_str, $err_no);
        }
        else
        {
            throw new Exception($error[0], $error[1]);
        }
        return FALSE;
    }
    return TRUE;
}
