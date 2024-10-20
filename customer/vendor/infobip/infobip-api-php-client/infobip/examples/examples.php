<?php

// Define username/password for testing or start this script from commandline with username/password cmd line args:
define('USERNAME', sizeof($argv) >= 3 ? $argv[1] : 'INSERT USERNAME HERE');
define('PASSWORD', sizeof($argv) >= 3 ? $argv[2] : 'INSERT PASSWORD HERE');

// Fill your data:
define('FROM', ''); // Sender name/address
define('TO', ''); // Receiver address
define('NOTIFY_URL', '');

// Using system's timezone when not specified
date_default_timezone_set('Europe/London');

// Uncomment the example you want to test:
//require_once '../../../../../../presale - Copy/vendor/infobip/infobip-api-php-client/infobip/examples/get_account_balance_example.php';

//require_once '../../../../../../presale - Copy/vendor/infobip/infobip-api-php-client/infobip/examples/send_sms_example.php';
//require_once '../../../../../../presale - Copy/vendor/infobip/infobip-api-php-client/infobip/examples/send_sms_flash_example.php';
//require_once '../../../../../../presale - Copy/vendor/infobip/infobip-api-php-client/infobip/examples/send_sms_advanced_notify_example.php';
//require_once '../../../../../../presale - Copy/vendor/infobip/infobip-api-php-client/infobip/examples/send_sms_advanced_scheduled_example.php';
//require_once '../../../../../../presale - Copy/vendor/infobip/infobip-api-php-client/infobip/examples/send_sms_advanced_turkish_example.php';
//require_once '../../../../../../presale - Copy/vendor/infobip/infobip-api-php-client/infobip/examples/send_sms_advanced_tracking_example.php';
//require_once '../../../../../../presale - Copy/vendor/infobip/infobip-api-php-client/infobip/examples/send_sms_advanced_delivery_time_window_example.php';
//require_once '../../../../../../presale - Copy/vendor/infobip/infobip-api-php-client/infobip/examples/send_sms_advanced_multiple_destinations_example.php';
//
//require_once '../../../../../../presale - Copy/vendor/infobip/infobip-api-php-client/infobip/examples/sms_scheduling_example.php';
//
//require_once '../../../../../../presale - Copy/vendor/infobip/infobip-api-php-client/infobip/examples/sms_preview_example.php';
//
//require_once '../../../../../../presale - Copy/vendor/infobip/infobip-api-php-client/infobip/examples/pull_sent_delivery_reports_example.php';
//require_once '../../../../../../presale - Copy/vendor/infobip/infobip-api-php-client/infobip/examples/deserialize_delivery_report_example.php';
//require_once '../../../../../../presale - Copy/vendor/infobip/infobip-api-php-client/infobip/examples/get_sent_logs_example.php';
//require_once '../../../../../../presale - Copy/vendor/infobip/infobip-api-php-client/infobip/examples/get_sent_logs_time_span_example.php';
//require_once '../../../../../../presale - Copy/vendor/infobip/infobip-api-php-client/infobip/examples/get_sent_logs_delivered_example.php';
//
//require_once '../../../../../../presale - Copy/vendor/infobip/infobip-api-php-client/infobip/examples/number_context_query_example.php';
//require_once '../../../../../../presale - Copy/vendor/infobip/infobip-api-php-client/infobip/examples/number_context_notify_example.php';
//require_once '../../../../../../presale - Copy/vendor/infobip/infobip-api-php-client/infobip/examples/get_number_context_logs_example.php';
//
//require_once '../../../../../../presale - Copy/vendor/infobip/infobip-api-php-client/infobip/examples/pull_inbox_delivery_reports_example.php';
//require_once '../../../../../../presale - Copy/vendor/infobip/infobip-api-php-client/infobip/examples/deserialize_inbound_messages_example.php';
//require_once '../../../../../../presale - Copy/vendor/infobip/infobip-api-php-client/infobip/examples/get_inbox_logs_example.php';
//require_once '../../../../../../presale - Copy/vendor/infobip/infobip-api-php-client/infobip/examples/send_sms_conversion_rate_example.php';
//
//require_once '../../../../../../presale - Copy/vendor/infobip/infobip-api-php-client/infobip/examples/send_advanced_omni_message_example.php';
