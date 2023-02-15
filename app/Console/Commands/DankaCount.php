<?php

namespace App\Console\Commands;

use App\Models\Danka as ModelsDanka;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
//操作するテーブルを読み込む
use Danka;

class DankaCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'danka:count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
      //標準出力&ログに出力するメッセージのフォーマット
      $message = '[' . date('Y-m-d h:i:s') . ']UserCount:' . ModelsDanka::count();

      //INFOレベルでメッセージを出力
      $this->info( $message );
      //ログを書き出す処理はこちら
      Log::setDefaultDriver('batch');
      Log::info( $message );
    }
}
