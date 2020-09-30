<?php

namespace App\Console\Commands;

use App\Notifications\PostsForPeriod;
use App\Post;
use App\User;
use Illuminate\Console\Command;

class SendNewPosts extends Command
{
    protected $signature = 'admin:send-news-posts {since : The dateTime with format 2020-09-26}';

    protected $description = 'Send information to all users about new posts for the {since} ';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $users = User::all();
        $posts = Post::whereDate('created_at', '>=', $this->argument('since'))->latest()->take(5)->get();

        if ($posts->isNotEmpty() && $users->isNotEmpty()) {
            $this->alert('Письма отправляются...');

            $bar = $this->output->createProgressBar(count($users));

            $bar->start();

            foreach ($users as $user) {
                $user->notify(new PostsForPeriod($posts));

                $bar->advance();
            }

            $bar->finish();
            $this->info(PHP_EOL . 'Письма успешно отправленны');
        } else {
            $this->info(PHP_EOL . 'Письма не были отправлены. Проверьте введенные параметры.');
        }

        return 0;
    }
}
