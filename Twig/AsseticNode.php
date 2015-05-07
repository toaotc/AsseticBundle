<?php

namespace Toa\Bundle\AsseticBundle\Twig;

use Assetic\Asset\AssetInterface;
use Assetic\Extension\Twig\AsseticNode as BaseAsseticNode;

/**
 * AsseticNode
 *
 * @author Enrico Thies <et@mandarin-medien.de>
 */
class AsseticNode extends BaseAsseticNode
{
    /**
     * {@inheritdoc}
     */
    public function compile(\Twig_Compiler $compiler)
    {
        parent::compile($compiler);

        $compiler
            ->write('unset($context[')
            ->repr('asset_src')
            ->raw("]);\n");
    }

    /**
     * {@inheritdoc}
     */
    protected function compileAsset(\Twig_Compiler $compiler, AssetInterface $asset, $name)
    {
        $compiler
            ->write("// asset source \"$name\"\n")
            ->write('$context[')
            ->repr('asset_src')
            ->raw('] = ')
            ->repr($asset->dump())
            ->raw(";\n");

        parent::compileAsset($compiler, $asset, $name);
    }
}
