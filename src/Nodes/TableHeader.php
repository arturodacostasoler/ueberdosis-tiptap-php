<?php

namespace Tiptap\Nodes;

class TableHeader extends TableCell
{
    public static $name = 'tableHeader';

    public static function parseHTML($DOMNode)
    {
        return [
            [
                'tag' => 'th',
                'getAttrs' => function ($DOMNode) {
                    $attrs = [];

                    if ($colspan = $DOMNode->getAttribute('colspan')) {
                        $attrs['colspan'] = intval($colspan);
                    }

                    if ($colwidth = $DOMNode->getAttribute('data-colwidth')) {
                        $widths = array_map(function ($w) {
                            return intval($w);
                        }, explode(',', $colwidth));
                        if (count($widths) === $attrs['colspan']) {
                            $attrs['colwidth'] = $widths;
                        }
                    }

                    if ($rowspan = $DOMNode->getAttribute('rowspan')) {
                        $attrs['rowspan'] = intval($rowspan);
                    }

                    if (!count($attrs)) {
                        return null;
                    }

                    return $attrs;
                }
            ],
        ];
    }

    public static function renderHTML($node)
    {
        return [
            'tag' => 'th',
            'attrs' => self::getAttrs($node),
        ];
    }
}
