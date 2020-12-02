<?php

declare(strict_types=1);

namespace Magma\Utility;

use Magma\Yaml\YamlConfig;

class Token
{

    /** @var string */
    protected string $token;

    /**
     * Class constructor. Create a new random token or assign an existing one if passed in.
     *
     * @param string|null $tokenValue
     * @param int $bytes
     * @throws Exception
     */
    public function __construct(string $tokenValue = null, int $bytes = 16)
    {
        if ($tokenValue) {
            $this->token = $tokenValue;
        } else {
            $this->token = bin2hex(random_bytes($bytes));
        }
    }

    /**
     * Get the token value
     * 
     * @return string the token value
     * @throws Exception
     */
    public function getValue() : string
    {
        return $this->token;
    }

    /**
     * Get the hashed token value
     *
     * @return string The hashed value
     * @throws Exception
     */
    public function getHash() : string
    {
        return hash_hmac('sha256', $this->value, YamlConfig::file('app')['secret_key']);
    }

}