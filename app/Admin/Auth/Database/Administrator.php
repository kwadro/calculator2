<?php

namespace App\Admin\Auth\Database;

use Illuminate\Support\Facades\Storage;
use OpenAdmin\Admin\Auth\Database\Administrator as BaseAdministrator;

class Administrator extends BaseAdministrator
{
    public function getAvatarAttribute($avatar)
    {
        if (url()->isValidUrl($avatar)) {
            return $avatar;
        }

        $disk = config('admin.upload.disk');

        if ($avatar && array_key_exists($disk, config('filesystems.disks'))) {

            return Storage::disk(config('admin.upload.disk'))->url($avatar);
        }

        $default = config('admin.default_avatar') ?: '/vendor/open-admin/open-admin/gfx/user.svg';

        return admin_asset($default);
    }

}
