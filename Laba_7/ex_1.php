<?php

abstract class PaymentHandler
{
    protected $nextHandler;

    public function setNext($handler)
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    abstract public function handle($amount);
}

class AccountHandler extends PaymentHandler
{
    private $balance;

    public function __construct($balance)
    {
        $this->balance = $balance;
    }

    public function handle($amount)
    {
        if ($this->balance >= $amount) {
            echo "Оплата на суму $amount здійснена з основного рахунку.\n";
        } else {
            if ($this->nextHandler) {
                $this->nextHandler->handle($amount);
            } else {
                echo "Оплату відхилено: недостатньо коштів на рахунку.\n";
            }
        }
    }
}

class CreditCardHandler extends PaymentHandler
{
    private $creditBalance;

    public function __construct($creditBalance)
    {
        $this->creditBalance = $creditBalance;
    }

    public function handle($amount)
    {
        if ($this->creditBalance >= $amount) {
            echo "Оплата на суму $amount здійснена з кредитної картки.\n";
        } else {
            if ($this->nextHandler) {
                $this->nextHandler->handle($amount);
            } else {
                echo "Оплату відхилено: недостатньо коштів на рахунку.\n";
            }
        }
    }
}

// Приклад використання
$accountHandler = new AccountHandler(100); // Основний рахунок з балансом 100
$creditCardHandler = new CreditCardHandler(200); // Кредитна картка з балансом 200

$accountHandler->setNext($creditCardHandler);

// Запит на оплату
$purchaseAmount = 150;
$accountHandler->handle($purchaseAmount);
?>
