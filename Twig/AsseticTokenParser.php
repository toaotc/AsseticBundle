<?php

namespace Toa\Bundle\AsseticBundle\Twig;

use Assetic\Asset\AssetInterface;
use Symfony\Bundle\AsseticBundle\Twig\AsseticTokenParser as BaseAsseticTokenParser;

/**
 * AsseticTokenParser
 *
 * @author Enrico Thies <et@mandarin-medien.de>
 */
class AsseticTokenParser extends BaseAsseticTokenParser
{
    protected function createNode(AssetInterface $asset, \Twig_NodeInterface $body, array $inputs, array $filters, $name, array $attributes = array(), $lineno = 0, $tag = null)
    {
        return new AsseticNode($asset, $body, $inputs, $filters, $name, $attributes, $lineno, $tag);
    }
}
