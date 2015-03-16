<?php namespace Pikd\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Customer extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    protected $primaryKey = 'cu_id';
    protected $connection = 'customer';
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cu_first_name', 'cu_email', 'cu_password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['cu_password', 'cu_reset_password_code'];

    public function __toString() {
        return "\Pikd\Models\Customer";
    }

    public function getRememberToken()
    {
        return $this->cu_persist_code;
    }

    public function setRememberToken($value)
    {
        $this->cu_persist_code = $value;
    }

    public function getRememberTokenName()
    {
        return 'cu_persist_code';
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->attributes['cu_password'];
    }
}
