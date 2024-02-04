<?php

namespace App\Admin\Form\Field;

class MultipleImage extends \OpenAdmin\Admin\Form\Field\MultipleImage
{
    protected $rules = 'image|mimes:bmp,jpg,png,jpeg,gif,svg,webp';

}
