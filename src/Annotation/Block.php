<?php

declare(strict_types=1);

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\BlockBundle\Annotation;

use JMS\DiExtraBundle\Annotation\MetadataProcessorInterface;
use JMS\DiExtraBundle\Metadata\ClassMetadata;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Use annotations to define block classes.
 *
 * @final since sonata-project/block-bundle 3.0
 *
 * @Annotation
 * @Target("CLASS")
 */
class Block implements MetadataProcessorInterface
{
    /**
     * Service id - autogenerated per default.
     *
     * @var string
     */
    public $id;

    public function processMetadata(ClassMetadata $metadata)
    {
        if (!empty($this->id)) {
            $metadata->id = $this->id;
        }

        $metadata->tags['sonata.block'][] = [];
        $metadata->arguments = [$this->id, new Reference('templating')];
    }
}
