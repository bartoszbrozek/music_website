<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'settings';

    protected $fillable = [
        'key',
        'value'
    ];

    /**
     * Timestamps
     *
     * @var boolean
     */
    public $timestamps = true;

    /**
     * Get all settings
     *
     * @return array
     */
    public function getAllToArray():array
    {
        $settingsTmp = self::get();
        $settings = [];

        foreach ($settingsTmp as $setting) {
            $settings[$setting->key] = $setting->value;
        }

        return $settings;
    }

    /**
     * Get setting
     *
     * @param string $key
     * @return void
     */
    public function getSetting(string $key)
    {
        return self::where("key", "=", $key)->first();
    }

    /**
     * Update setting
     *
     * @param string $key
     * @param string $value
     * @return void
     */
    public function saveSetting(string $key, string $value): void
    {
        self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}
