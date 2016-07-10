<?php

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\BlockBundle\Twig\TokenParser;

use Sonata\BlockBundle\Templating\Helper\BlockHelper;
use Sonata\BlockBundle\Twig\Node\AssetNode;

/**
 * @author Christian Gripp <mail@core23.de>
 */
final class AssetTokenParser extends \Twig_TokenParser
{
    /**
     * @var BlockHelper
     */
    private $blockHelper;

    /**
     * @var string
     */
    private $tag;

    /**
     * @param string      $tag
     * @param BlockHelper $blockHelper
     */
    public function __construct($tag, BlockHelper $blockHelper)
    {
        $this->tag = $tag;
        $this->blockHelper = $blockHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function parse(\Twig_Token $token)
    {
        if ($this->parser->getStream()->test(\Twig_Token::STRING_TYPE)) {
            $asset = $this->parser->getExpressionParser()->parseExpression();
        } else {
            $asset = null;
        }

        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);

        return new AssetNode($asset, $token->getLine(), $this->getTag());
    }

    /**
     * {@inheritdoc}
     */
    public function getTag()
    {
        return $this->tag;
    }
}
