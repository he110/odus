<?php

declare(strict_types=1);

namespace App\Reference;

class ChatUserReference
{
    public const CHANNEL_TYPE_UNKNOWN  = 0;
    public const CHANNEL_TYPE_TELEGRAM = 1;
    public const CHANNEL_TYPE_WHATSAPP = 2;
    public const CHANNEL_TYPE_VIBER    = 3;
    public const CHANNEL_TYPE_FACEBOOK = 4;
    public const CHANNEL_TYPE_WIDGET   = 4;
}
