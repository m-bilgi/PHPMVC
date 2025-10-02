<?php
declare(strict_types=1);

namespace App\Models;

use DateTime;

class Member extends BaseModel
{
	public ?int $id = null;
	public ?string $guid = null;
	public ?string $name = null;
	public ?string $surname = null;
	public ?string $email = null;
	public ?string $username = null;
	public ?string $password = null;
	public ?int $level = null;
	public ?string $remember_token = null;
	public ?string $email_verified_at = null;
	public ?string $activation_key = null;
	public ?string $avatar_url = null;
	public ?string $biography = null;
	public ?string $birthday = null;
	public ?string $city = null;
	public ?int $country_id = null;
	public ?string $description = null;
	public ?string $gender = null;
	public ?int $hide_birthday = null;
	public ?int $hide_email = null;
	public ?int $hide_fullname = null;
	public ?int $hide_online = null;
	public ?string $hobbies = null;
	public ?string $homepage = null;
	public ?string $ip_address = null;
	public ?string $language = null;
	public ?string $last_ip_address = null;
	public ?string $last_here_date = null;
	public ?string $last_post_date = null;
	public ?string $new_email = null;
	public ?string $occupation = null;
	public ?int $page_views = null;
	public ?string $photo_url = null;
	public ?int $pm_email = null;
	public ?int $pm_receive = null;
	public ?int $posts = null;
	public ?string $quote = null;
	public ?int $receive_email = null;
	public ?int $recmail = null;
	public ?string $register_date = null;
	public ?int $reply = null;
	public ?int $reply_total = null;
	public ?string $signature = null;
	public ?string $social_media = null;
	public ?string $state = null;
	public ?int $status = null;
	public ?int $subscription = null;
	public ?string $theme = null;
	public ?string $title = null;
	public ?string $key2 = null;

	protected static array $casts = [
		'id' => 'int',
		'guid' => 'string',
		'name' => 'string',
		'surname' => 'string',
		'email' => 'string',
		'username' => 'string',
		'password' => 'string',
		'level' => 'int',
		'remember_token' => 'string',
		'email_verified_at' => 'string',
		'activation_key' => 'string',
		'avatar_url' => 'string',
		'biography' => 'string',
		'birthday' => 'string',
		'city' => 'string',
		'country_id' => 'int',
		'description' => 'string',
		'gender' => 'string',
		'hide_birthday' => 'int',
		'hide_email' => 'int',
		'hide_fullname' => 'int',
		'hide_online' => 'int',
		'hobbies' => 'string',
		'homepage' => 'string',
		'ip_address' => 'string',
		'language' => 'string',
		'last_ip_address' => 'string',
		'last_here_date' => 'string',
		'last_post_date' => 'string',
		'new_email' => 'string',
		'occupation' => 'string',
		'page_views' => 'int',
		'photo_url' => 'string',
		'pm_email' => 'int',
		'pm_receive' => 'int',
		'posts' => 'int',
		'quote' => 'string',
		'receive_email' => 'int',
		'recmail' => 'int',
		'register_date' => 'string',
		'reply' => 'int',
		'reply_total' => 'int',
		'signature' => 'string',
		'social_media' => 'string',
		'state' => 'string',
		'status' => 'int',
		'subscription' => 'int',
		'theme' => 'string',
		'title' => 'string',
		'key2' => 'string',
	];

	public function isActive(): bool
	{
		return (int)$this->status === 1;
	}
}
