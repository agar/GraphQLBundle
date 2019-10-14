<?php

declare(strict_types=1);

namespace Overblog\GraphQLBundle\Config\Parser\GraphQL\ASTConverter;

use GraphQL\Language\AST\Node;

class ObjectTypeExtensionNode implements NodeInterface
{
    public const TYPENAME = 'object_extension';

    public static function toConfig(Node $node): array
    {
        $config = [
            'fields' => FieldsNode::toConfig($node),
        ];

        if (!empty($node->interfaces)) {
            $interfaces = [];
            foreach ($node->interfaces as $interface) {
                $interfaces[] = TypeNode::astTypeNodeToString($interface);
            }
            $config['interfaces'] = $interfaces;
        }

        return [
            'type' => static::TYPENAME,
            'config' => $config,
        ];
    }
}
