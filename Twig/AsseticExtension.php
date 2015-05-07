<?php

namespace Toa\Bundle\AsseticBundle\Twig;

use Assetic\Factory\AssetFactory;
use Assetic\ValueSupplierInterface;
use Symfony\Bundle\AsseticBundle\Twig\AsseticExtension as BaseAsseticExtension;
use Symfony\Component\Templating\TemplateNameParserInterface;

/**
 * AsseticExtension
 *
 * @author Enrico Thies <et@mandarin-medien.de>
 */
class AsseticExtension extends BaseAsseticExtension
{
    /**
     * @var TemplateNameParserInterface
     */
    private $templateNameParser;

    /**
     * @var array
     */
    private $enabledBundles;

    /**
     * @param AssetFactory                $factory
     * @param TemplateNameParserInterface $templateNameParser
     * @param string                      $useController
     * @param array                       $functions
     * @param array                       $enabledBundles
     * @param ValueSupplierInterface      $valueSupplier
     */
    public function __construct(AssetFactory $factory, TemplateNameParserInterface $templateNameParser, $useController = false, $functions = array(), $enabledBundles = array(), ValueSupplierInterface $valueSupplier = null)
    {
        parent::__construct($factory, $templateNameParser, $useController, $functions, $enabledBundles, $valueSupplier);

        $this->templateNameParser = $templateNameParser;
        $this->enabledBundles = $enabledBundles;
    }

    /**
     * {@inheritdoc}
     */
    public function getTokenParsers()
    {
        return array(
            $this->createTokenParser('embedjavascripts', 'js/*.js'),
            $this->createTokenParser('embedstylesheets', 'css/*.css'),
        );
    }

    private function createTokenParser($tag, $output, $single = false)
    {
        $tokenParser = new AsseticTokenParser($this->factory, $tag, $output, $single, array('package'));
        $tokenParser->setTemplateNameParser($this->templateNameParser);
        $tokenParser->setEnabledBundles($this->enabledBundles);

        return $tokenParser;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'toa_assetic';
    }
}
