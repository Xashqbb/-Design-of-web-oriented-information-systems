<?php

// Клас для роботи з Twitter
class TwitterService {
    private $_data;

    public function setMessage($text) {
        $this->_data['message'] = $text;
        echo $this->_data['message'] . PHP_EOL;
    }

    public function sendTweet() {
        echo "I sent a tweet" . PHP_EOL;
    }
}

// Клас для роботи з SMS
class SmsService {
    private $recipient;
    private $message;
    private $time;

    public function setRecipient($recipient) {
        $this->recipient = $recipient;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function setTime($time) {
        $this->time = $time;
    }

    public function sendText() {
        echo "SMS sent to {$this->recipient} at {$this->time}: {$this->message}" . PHP_EOL;
    }
}

// Інтерфейс NotificationInterface
interface NotificationInterface {
    public function setData($data);
    public function sendNotification();
}

// Адаптер для Twitter
class TwitterAdapter implements NotificationInterface {
    protected $_data;

    public function setData($data) {
        $this->_data = $data;
    }

    public function sendNotification() {
        $twitterClient = new TwitterService();
        $twitterClient->setMessage($this->_data['message']);
        $twitterClient->sendTweet();
    }
}

// Адаптер для SMS
class SmsAdapter implements NotificationInterface {
    protected $_data;

    public function setData($data) {
        $this->_data = $data;
    }

    public function sendNotification() {
        $smsClient = new SmsService();
        $smsClient->setRecipient($this->_data['recipient']);
        $smsClient->setMessage($this->_data['message']);

        // Використання реального часу, якщо час не вказано
        if (isset($this->_data['time'])) {
            $smsClient->setTime($this->_data['time']);
        } else {
            $zone = new \DateTimeZone('Europe/Kiev');
            $date = new \DateTime('now', $zone);
            // Якщо час не вказано, використовується поточний час
            $currentTime = $date->format('Y-m-d H:i:s');
            $smsClient->setTime($currentTime);
        }

        $smsClient->sendText();
    }
}

// Інтерфейс INotificationManager
interface INotificationManager {
    public function sendNotification($data, $type = '');
}

// Клас для управління повідомленнями
class NotificationManager implements INotificationManager {

    public function sendNotification($data, $type = '') {
        switch ($type) {
            case "twitter":
                $notification = new TwitterAdapter();
                break;
            case "sms":
                $notification = new SmsAdapter();
                break;
            default:
                echo "Error: Unknown notification type." . PHP_EOL;
                return false;
        }

        $notification->setData($data);
        $notification->sendNotification();
    }
}


$twitterData = array(
    "message" => "This is a tweet message"
);

$a = new NotificationManager();
$a->sendNotification($twitterData, "twitter");

$smsData = array(
    "recipient" => "+1234567890",
    "message" => "This is an SMS message",
    // "time" => "2024-10-25 10:00" // Час можна не встановлювати, тоді використається поточний
);

$a->sendNotification($smsData, "sms");

?>
