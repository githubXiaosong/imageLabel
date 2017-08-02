<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Helper;

/**
 * HelperInterface is the interface all helpers must implement.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface HelperInterface
{
    /**
     * Sets the Helper set associated with this Helper.
     *
     * @param HelperSet $helperSet A HelperSet instance
     */
    public function setHelperSet(HelperSet $helperSet = null);

    /**
     * Gets the Helper set associated with this Helper.
     *
     * @return HelperSet A HelperSet instance
     */
    public function getHelperSet();

    /**
     * Returns the canonical name of this Helper.
     *
     * @return string The canonical name
     */
    public function getName();
}