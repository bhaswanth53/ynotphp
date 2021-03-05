<?php

    namespace Facades;

    use Defuse\Crypto\Key;
    use Defuse\Crypto\Crypto;

    class Crypt
    {
        private function key()
        {
            $keyAscii = env('APP_KEY');
            return Key::loadFromAsciiSafeString($keyAscii);
        }

        public function encrypt($string)
        {
            $key = self::key();
            $ciphertext = Crypto::encrypt($string, $key);
            return $ciphertext;
        }

        public function decrypt($ciphertext)
        {
            $key = self::key();
            $secret_data = Crypto::decrypt($ciphertext, $key);
            return $secret_data;
        }
    }