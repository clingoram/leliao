<?php

namespace App\Http\Controllers\Hash;

/**
 * 密碼產生方式:
 * salt(隨機產生的salt盡量要含有特殊字元+數字+英文字母且長度10) + 使用者打上的密碼sha1 = PWD
 * 
 * salt值存進對應column內，登入時必須要來做比對檢查
 * 
 * PWD回傳到RegisterController並儲存在密碼那一欄位
 */
class HashController
{
    private string $serial = '';

    public function setRandomSalt(string $letters, string $specialLetters, int $length): void
    {
        for ($i = 0; $i <= 15; $i++) {
            $this->serial .= $letters[rand() % $length];
            $this->serial .= $specialLetters[rand() % 6];
        }
    }

    public function getRandomSalt(): String
    {
        return $this->serial;
    }
}
