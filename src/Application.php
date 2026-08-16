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

namespace App;

use Derafu\Backbone\DependencyInjection\ServiceConfigurationCompilerPass;
use Derafu\Backbone\DependencyInjection\ServiceProcessingCompilerPass;
use Derafu\Http\Kernel;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

class Application extends Kernel
{
    protected function configure(
        ContainerConfigurator $configurator,
        ContainerBuilder $container
    ): void {
        parent::configure($configurator, $container);

        $container->addCompilerPass(
            new ServiceProcessingCompilerPass('libredte.lib.')
        );
        $container->addCompilerPass(
            new ServiceConfigurationCompilerPass('libredte.lib.')
        );
    }
}
