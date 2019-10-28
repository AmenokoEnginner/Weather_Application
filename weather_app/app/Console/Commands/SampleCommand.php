<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Notifications\SampleNotification;
use Illuminate\Notifications\Notification;

class SampleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send to Slack at 18:00 everyday';

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
        // Notifiableなオブジェクトを作成
        $users = [];
        $users[] = new User();

        // 複数人にSlackメッセージ配信
        \Notification::send($users, new SampleNotification());

        // コマンド実行完了メッセージ
        $this->info('DailyAt 18:00 Update has been send successfully');
    }
}
