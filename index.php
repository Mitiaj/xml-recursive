<?php
$aRequest = [
    'attr' => [
        'id' => 15
    ],
    'auth' => [
        'value' => 'test',
        'attr' => [
            'token' => 'aklsdjlaskdjasldfre'
        ],
        'user' => [
            'value' => 'pidar'
        ]
    ],
    'search' => [
        'attr' => [
            'locId' => 123
        ],
        'value' => 'testing',
        'search' => [
            'attr' => [
                'locId' => 123
            ],
            'value' => 'testing',
            'search' => [
                'attr' => [
                    'locId' => 123
                ],
                'value' => 'testing',
                'search' => [
                    'attr' => [
                        'locId' => 123
                    ],
                    'value' => 'testing',
                    'search' => [
                        'attr' => [
                            'locId' => 123
                        ],
                        'value' => 'testing',
                        'search' => [
                            'attr' => [
                                'locId' => 123
                            ],
                            'value' => 'testing',
                        ]
                    ]
                ]
            ]
        ]
    ]
];

function parseNode(SimpleXMLElement &$xml, $child, $nodeArray)
{
    if (isset($nodeArray['value']))
        $xml->addChild($child, $nodeArray['value']);
    else
        $xml->addChild($child);

    foreach ($nodeArray as $node => $nodeValue) {
        if ($node == 'attr') {
            foreach ($nodeValue as $attr => $attrValue) {
                $xml->$child->addAttribute($attr, $attrValue);
            }
        } elseif ($node == 'value') {
            continue;
        } else {
            parseNode($xml->$child, $node, $nodeValue);
        }
    }
}

$xml = new SimpleXMLElement('<request/>');
parseNode($xml, 'test', $aRequest);
echo $xml->asXML();