<?php

namespace Criteria\Shared\Infrastructure\Databases;

class MysqlConnection
{
    // implemmtation of connection with mysql


    public function get(string $query): array
    {
        return [
            'query' => $query,
            'result' => [
                'id' => 1,
                'name' => 'Product 1',
                'price' => 1000,
            ],
        ];
    }
}
