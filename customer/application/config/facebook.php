<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$config['facebook']['application_name'] = 'sospawn';
$config['facebook']['app_id']        = '218113051050273';
$config['facebook']['app_secret']    = '087ee56c720be7f480b6b901a3a934a5';
$config['facebook']['default_graph_version']          = 'v2.12';
$config['facebook']['redirect_url']          = 'https://user.sospawn.com/facebooks/auth.html';
$config['facebook']['scopes']           = array('email','profile');

