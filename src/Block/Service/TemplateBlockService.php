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

namespace Sonata\BlockBundle\Block\Service;

use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Form\Mapper\FormMapper;
use Sonata\BlockBundle\Meta\Metadata;
use Sonata\BlockBundle\Meta\MetadataInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\Form\Type\ImmutableArrayType;
use Sonata\Form\Validator\ErrorElement;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Twig\Environment;

/**
 * @author Thomas Rabaix <thomas.rabaix@sonata-project.org>
 */
class TemplateBlockService extends AbstractBlockService implements EditableBlockService
{
    /**
     * @var string
     */
    protected $name;

    public function __construct(string $name, Environment $twig)
    {
        parent::__construct($twig);
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null): Response
    {
        return $this->renderResponse($blockContext->getTemplate(), [
            'block' => $blockContext->getBlock(),
            'settings' => $blockContext->getSettings(),
        ], $response);
    }

    public function configureEditForm(FormMapper $form, BlockInterface $block): void
    {
        $this->configureForm($form, $block);
    }

    public function configureCreateForm(FormMapper $form, BlockInterface $block): void
    {
        $this->configureForm($form, $block);
    }

    public function configureSettings(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'template' => '@SonataBlock/Block/block_template.html.twig',
        ]);
    }

    public function validate(ErrorElement $errorElement, BlockInterface $block): void
    {
    }

    public function getMetadata(): MetadataInterface
    {
        return new Metadata($this->getName(), null, false, 'SonataBlockBundle', [
            'class' => 'fa fa-code',
        ]);
    }

    private function configureForm(FormMapper $form, BlockInterface $block): void
    {
        $form->add('settings', ImmutableArrayType::class, [
            'keys' => [
                ['template', null, [
                    'label' => 'form.label_template',
                ]],
            ],
            'translation_domain' => 'SonataBlockBundle',
        ]);
    }
}
