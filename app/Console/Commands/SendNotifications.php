<?php

namespace App\Console\Commands;

use App\Http\Service\Mail\MailerService;
use App\Models\Console\Mail\Mail as MailModel;
use App\Models\Console\Notification;
use App\Models\Console\User;
use Illuminate\Console\Command;

class SendNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending notifications';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(MailModel $mail_model)
    {
        parent::__construct();
        $this->mail_model = $mail_model;
    }

    public function handle()
    {
        $pending_list = $this->getPendingEmailList();

        $user_id_list = data_get($pending_list, '*.user_id');
        $notification_id_list = data_get($pending_list, '*.notification_id');

        $user_list = $this->getUserList($user_id_list);
        $notification_list = $this->getNotificationList($notification_id_list);

        $sent_list = [];
        $target_list = [];
        foreach ($pending_list as $item) {
            $notification_id = $item['notification_id'];
            $target_list[$notification_id] = $target_list[$notification_id] ?? [];
            array_push($target_list[$notification_id], $item);
            array_push($sent_list, $item['id']);
        }

        $mail_list = [];
        foreach ($target_list as $notification_id => $list) {
            foreach ($list as $item) {
                $notification = $notification_list[$item['notification_id']] ?? [];
                $recipient = $user_list[$item['user_id']] ?? [];

                if ($recipient && $notification) {
                    $mail_detail = [
                        'user_id' => $item['user_id'],
                        'notification_id' => $item['notification_id'],
                        'title' => $notification['title'],
                        'content' => $notification['content'],
                        'to' => [$recipient['email'], $recipient['name']],
                    ];
                    array_push($mail_list, $mail_detail);
                }
            }
        }

        $mailer = new MailerService();
        foreach ($mail_list as $mail) {
            $name = 'Mail\Console\Notification\NotificationEmail';
            $mailer->send($name, $mail);
            $this->updateEmailListMode($mail['user_id'], $mail['notification_id']);
        }

        return true;
    }

    private function getPendingEmailList()
    {
        return $this->mail_model->getPendingList();
    }

    private function updateEmailListMode(int $user_id, int $notification_id)
    {
        return $this->mail_model->updadeSentModeByUserIdNotificationId($user_id, $notification_id);
    }

    private function getNotificationList(array $notification_id_list)
    {
        $model = new Notification();
        $list = $model->getByIdList($notification_id_list);
        if ($list) {
            $result = [];
            foreach ($list as $item) {
                $result[$item['id']] = $item;
            }
            return $result;
        }
        return [];
    }

    private function getUserList(array $user_id_list)
    {
        $model = new User();
        $list = $model->getByIdList($user_id_list);
        if ($list) {
            $result = [];
            foreach ($list as $item) {
                $result[$item['id']] = $item;
            }
            return $result;
        }
        return [];
    }
}
