<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use App\UserLangSkill;
use Illuminate\Support\Facades\Hash;

class CreateSampleUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create_sample_user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create_sample_user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
     
        $datas = [
            [
                'name' => 'サンプルユーザー',
                'email' => 'sample@mail.com',
            ],
            [
                'name' => 'おぐら',
                'email' => 'ogura@mail.com',
            ],
            [
                'name' => 'こうだ',
                'email' => 'koda@mail.com',
            ],
            [
                'name' => 'じんぐう',
                'email' => 'jingu@mail.com',
            ],
            [
                'name' => 'みかせ',
                'email' => 'mikase@mail.com',
            ],
            [
                'name' => 'ユーザーA',
                'email' => 'amail@mail.com',
            ],
            [
                'name' => 'ユーザーB',
                'email' => 'bmail@mail.com',
            ],
            [
                'name' => 'ユーザーC',
                'email' => 'cmail@mail.com',
            ],
            [
                'name' => 'ユーザーD',
                'email' => 'dmail@mail.com',
            ],
            [
                'name' => 'ユーザーE',
                'email' => 'email@mail.com',
            ],
            [
                'name' => 'ユーザーF',
                'email' => 'fmail@mail.com',
            ],
            [
                'name' => 'ユーザーG',
                'email' => 'gmail@mail.com',
            ],
            [
                'name' => 'ユーザーH',
                'email' => 'hmail@mail.com',
            ],
            [
                'name' => 'ユーザーI',
                'email' => 'imail@mail.com',
            ],
            [
                'name' => 'ユーザーJ',
                'email' => 'jmail@mail.com',
            ],
            [
                'name' => 'ユーザーK',
                'email' => 'kmail@mail.com',
            ],
            [
                'name' => 'ユーザーL',
                'email' => 'lmail@mail.com',
            ],
            [
                'name' => 'ユーザーM',
                'email' => 'mmail@mail.com',
            ],
            [
                'name' => 'ユーザーN',
                'email' => 'nmail@mail.com',
            ],
            [
                'name' => 'ユーザーO',
                'email' => 'omail@mail.com',
            ],
            [
                'name' => 'ユーザーP',
                'email' => 'pmail@mail.com',
            ],
            [
                'name' => 'ユーザーQ',
                'email' => 'qmail@mail.com',
            ],
            [
                'name' => 'ユーザーR',
                'email' => 'rmail@mail.com',
            ],
            [
                'name' => 'ユーザーS',
                'email' => 'smail@mail.com',
            ],
            [
                'name' => 'ユーザーT',
                'email' => 'tmail@mail.com',
            ],
            [
                'name' => 'ユーザーU',
                'email' => 'umail@mail.com',
            ],
            [
                'name' => 'ユーザーV',
                'email' => 'vmail@mail.com',
            ],
            [
                'name' => 'ユーザーW',
                'email' => 'wmail@mail.com',
            ],
            [
                'name' => 'ユーザーX',
                'email' => 'xmail@mail.com',
            ],
            [
                'name' => 'ユーザーY',
                'email' => 'ymail@mail.com',
            ],
            [
                'name' => 'ユーザーZ',
                'email' => 'zmail@mail.com',
            ],

        ];

        foreach ($datas as $data) {
            if ( ! User::where('email', $data['email'])->exists() ){
                self::create($data);
            }
        }
    }

    public static function create($data)
    {
        $rand_commands = array_rand(config('command'), 4);
		shuffle($rand_commands);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make('password'),
            'skill1' => $rand_commands[0],
            'skill2' => $rand_commands[1],
            'skill3' => $rand_commands[2],
            'skill4' => $rand_commands[3],
        ]);

        $skills = array('PHP','Python','Ruby','Normal');

        foreach ($skills as &$skill) {
            UserLangSkill::create([
                'skill' => $skill,
                'user_id' => $user->id,
                'level' => '0',
            ]);

        }
    }
}
