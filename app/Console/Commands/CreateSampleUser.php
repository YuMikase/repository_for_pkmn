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
                'name' => 'チームA',
                'email' => 'amail@mail.com',
            ],
            [
                'name' => 'チームB',
                'email' => 'bmail@mail.com',
            ],
            [
                'name' => 'チームC',
                'email' => 'cmail@mail.com',
            ],
            [
                'name' => 'チームD',
                'email' => 'dmail@mail.com',
            ],
            [
                'name' => 'チームE',
                'email' => 'email@mail.com',
            ],
            [
                'name' => 'チームF',
                'email' => 'fmail@mail.com',
            ],
            [
                'name' => 'チームG',
                'email' => 'gmail@mail.com',
            ],
            [
                'name' => 'チームH',
                'email' => 'hmail@mail.com',
            ],
            [
                'name' => 'チームI',
                'email' => 'imail@mail.com',
            ],
            [
                'name' => 'チームJ',
                'email' => 'jmail@mail.com',
            ],
            [
                'name' => 'チームK',
                'email' => 'kmail@mail.com',
            ],
            [
                'name' => 'チームL',
                'email' => 'lmail@mail.com',
            ],
            [
                'name' => 'チームM',
                'email' => 'mmail@mail.com',
            ],
            [
                'name' => 'チームN',
                'email' => 'nmail@mail.com',
            ],
            [
                'name' => 'チームO',
                'email' => 'omail@mail.com',
            ],
            [
                'name' => 'チームP',
                'email' => 'pmail@mail.com',
            ],
            [
                'name' => 'チームQ',
                'email' => 'qmail@mail.com',
            ],
            [
                'name' => 'チームR',
                'email' => 'rmail@mail.com',
            ],
            [
                'name' => 'チームS',
                'email' => 'smail@mail.com',
            ],
            [
                'name' => 'チームT',
                'email' => 'tmail@mail.com',
            ],
            [
                'name' => 'チームU',
                'email' => 'umail@mail.com',
            ],
            [
                'name' => 'チームV',
                'email' => 'vmail@mail.com',
            ],
            [
                'name' => 'チームW',
                'email' => 'wmail@mail.com',
            ],
            [
                'name' => 'チームX',
                'email' => 'xmail@mail.com',
            ],
            [
                'name' => 'チームY',
                'email' => 'ymail@mail.com',
            ],
            [
                'name' => 'チームZ',
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
