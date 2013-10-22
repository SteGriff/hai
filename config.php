<?php

// Fills in the flavour text, "I'm the mail robot for [example.com]"
// and the default subject (below)
$domain = 'example.com';

//Recipient for mail (can't be specified by POST atm)
$default_recipient = 'test@example.com';

//Default subject for mail (overwritten by POST subject=)
$default_subject = "$domain mailbot submission";

//The email address to send as
$bot_email = "haitatsu@example.com";

//The Reply-To address on bot email. Should probably be a human.
$reply_to = "human@example.com";

?>