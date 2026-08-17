<?php

namespace App\Lfm;

use UniSharp\LaravelFilemanager\LfmItem as BaseLfmItem;

class LfmItem extends BaseLfmItem
{
    public function extension()
    {
        return strtolower(parent::extension());
    }
}
