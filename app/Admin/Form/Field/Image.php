<?php

namespace App\Admin\Form\Field;

class Image  extends \OpenAdmin\Admin\Form\Field\Image
{
    protected $rules = 'image|mimes:bmp,jpg,png,jpeg,gif,svg,webp';
}
