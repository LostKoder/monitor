<?php
/**
 * Created by PhpStorm.
 * User: evolve
 * Date: 1/14/18
 * Time: 1:59 PM
 */

namespace Core\Proxy;


use Illuminate\Database\Eloquent\Model;

/**
 * Class TorProxy
 *
 * @property integer id
 * @property string address
 * @property string config_file
 * @property boolean enabled
 * @property \DateTimeInterface used_at
 * @property \DateTimeInterface disabled_at
 */
class TorProxy extends Model
{
    protected $table = 'tor_proxies';
    protected static $unguarded = true;
    public $timestamps = false;

    protected $casts = [
      'id' => 'integer',
      'enabled' => 'boolean',
      'address' => 'string',
      'config_file' => 'string',
      'used_at' => 'datetime',
      'disabled_at' => 'datetime',
    ];

    protected $attributes = [
      'enabled' => true,
    ];
}