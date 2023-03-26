<?php

namespace App\Enums;

enum LinkType: string
{
    case VIDEO = 'video';
    case ARTICLE = 'article';
    case POST = 'post';
    case TOOL = 'tool';
}
