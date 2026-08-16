<?php

declare(strict_types=1);

/**
 * LibreDTE: Core - El núcleo de LibreDTE Edición Comunidad en una API
 * Copyright (C) LibreDTE <https://www.libredte.cl>
 *
 * Este programa es software libre: usted puede redistribuirlo y/o modificarlo
 * bajo los términos de la Licencia Pública General Affero de GNU publicada por
 * la Fundación para el Software Libre, ya sea la versión 3 de la Licencia, o
 * (a su elección) cualquier versión posterior de la misma.
 *
 * Este programa se distribuye con la esperanza de que sea útil, pero SIN
 * GARANTÍA ALGUNA; ni siquiera la garantía implícita MERCANTIL o de APTITUD
 * PARA UN PROPÓSITO DETERMINADO. Consulte los detalles de la Licencia Pública
 * General Affero de GNU para obtener una información más detallada.
 *
 * Debería haber recibido una copia de la Licencia Pública General Affero de
 * GNU junto a este programa.
 *
 * En caso contrario, consulte <http://www.gnu.org/licenses/agpl.html>.
 */

use Derafu\Http\Runtime;

if (
    true === (require_once dirname(__DIR__) . '/vendor/autoload.php')
    || empty($_SERVER['SCRIPT_FILENAME'])
) {
    return;
}

// Create the runtime.
$runtimeClass = $_SERVER['APP_RUNTIME'] ?? $_ENV['APP_RUNTIME'] ?? Runtime::class;
$runtime = new $runtimeClass();

// Get the handler.
$app = require $_SERVER['SCRIPT_FILENAME'];
if (!is_callable($app)) {
    throw new TypeError(sprintf(
        'Invalid return value: callable expected, "%s" returned from "%s".',
        get_debug_type($app),
        $_SERVER['SCRIPT_FILENAME']
    ));
}
$handler = $app($runtime->getApplicationContext());

// Run the application using the handler.
exit($runtime->run($handler));
