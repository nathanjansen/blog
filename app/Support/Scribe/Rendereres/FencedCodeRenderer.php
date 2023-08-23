<?php

namespace App\Support\Scribe\Rendereres;

use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Xml\XmlNodeRendererInterface;

class FencedCodeRenderer  implements NodeRendererInterface, XmlNodeRendererInterface
{
    public function render(FencedCode $block, ElementRendererInterface $htmlRenderer)
    {
        $element = parent::render($block, $htmlRenderer);
        if ($element instanceof HtmlElement) {
            // Here, you can dynamically set or modify attributes
            // For example, to add a custom class:
            $existingClass = $element->getAttribute('class');
            $element->setAttribute('class', $existingClass . ' your-custom-class');

            // Or to set a data attribute:
            $element->setAttribute('data-info', $block->getInfoString());
        }
        return $element;
    }

    public function getXmlTagName(Node $node): string
    {
        return 'code_block';
    }

    /**
     * @param FencedCode $node
     *
     * @return array<string, scalar>
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function getXmlAttributes(Node $node): array
    {
        FencedCode::assertInstanceOf($node);

        if (($info = $node->getInfo()) === null || $info === '') {
            return [];
        }

        return ['info' => $info];
    }
}
