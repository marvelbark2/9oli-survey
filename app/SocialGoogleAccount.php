<?php
// SocialGoogleAccount.php
namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialGoogleAccount extends Model
{
    protected $fillable = ['user_id', 'provider_user_id', 'provider', 'avatar', 'avatar_original'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
