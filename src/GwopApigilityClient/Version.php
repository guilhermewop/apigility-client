<?php
namespace GwopApigilityClient;

class Version
{

    /** @var string */
    const VERSION = '0.1.0-rc1';

    /**
     * Obtém o número da versão atual do Client
     *
     * @return string
     */
    public static function getVersion()
    {
        return self::VERSION;
    }
}
