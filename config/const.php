<?php

return [
    //言語のデータ
    'LANG_DATAS' => [
        'PHP',
        'Python',
        'Java Script',
    ],

    //アイテムのデータ
    'ITEM_DATAS' => [
        'しょぼPC',
        'そこそこのPC',
        'なかなかのPC',
        '最高のPC',
    ],

    //名無しに付ける式のバリエーション
    'EQUATIONS' => [
        'λ = hν',
        'β = 1 - v/c',
        'γ = β^(-1)',
    ],

    //コマンドのデータ
    'COMMANDS' => [
        'php' => [
            // 適当に番号 => [
            //     'name' => '関数名'(string),
            //     'type' => コマンドのタイプ(int),
            //     'damage' => ダメージ量(int),
            // ],

            0 => [
                'name' => 'for',
                'type' => 1,
                'damage' => 10,
            ],

            1 => [
                'name' => 'if',
                'type' => 1,
                'damage' => 20,
            ],

            2 => [
                'name' => 'foreach',
                'type' => 1,
                'damage' => 100,
            ],

            3 => [
                'name' => 'require',
                'type' => 2,
                'damage' => 12,
            ],

            4 => [
                'name' => 'in_array',
                'type' => 2,
                'damage' => 14,
            ],

            5 => [
                'name' => 'header',
                'type' => 2,
                'damage' => 15,
            ],
        ],
    ],

];