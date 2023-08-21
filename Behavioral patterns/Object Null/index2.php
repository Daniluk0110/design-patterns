<?php

// пример с банковскими транзакциями, где используется паттерн Null Object для обработки случая,
// когда операции с аккаунтом не могут быть выполнены из-за отсутствия аккаунта.
interface Account
{
    public function deposit(float $amount): void;

    public function withdraw(float $amount): void;
}

// Реализация аккаунта
class BankAccount implements Account
{
    private float $balance = 0;

    public function deposit(float $amount): void
    {
        $this->balance += $amount;
        echo "Deposited: $amount\n";
    }

    public function withdraw(float $amount): void
    {
        if ($this->balance >= $amount) {
            $this->balance -= $amount;
            echo "Withdrawn: $amount\n";
        } else {
            echo "Insufficient funds\n";
        }
    }
}

// "Нулевая" реализация аккаунта
class NullAccount implements Account
{
    public function deposit(float $amount): void
    {
        // Ничего не делать
    }

    public function withdraw(float $amount): void
    {
        // Ничего не делать
    }
}

// Функция для получения аккаунта
function getAccountFromDatabase()
{
    // Предположим, что мы получаем аккаунт или null
    return null;
}

// Создание аккаунта (выберите BankAccount или NullAccount)
$account = new NullAccount(); // Используйте NullAccount или BankAccount

// Получение аккаунта
$account = getAccountFromDatabase();

// Пополнение счета или снятие денег
$account->deposit(100); // NullAccount ничего не делает
$account->withdraw(50); // NullAccount ничего не делает
