<?php

$_lang['commerce_lobaddressverification'] = 'Lob Address Verification';
$_lang['commerce_lobaddressverification.description'] = 'Verify customer addresses with the Lob address verification API.';

// Settings
$_lang['setting_commerce_lobaddressverification.api_key'] = 'Lob API Key';
$_lang['setting_commerce_lobaddressverification.api_key_desc'] = 'Test or live API key retrieved by registering for a Lob account.';
$_lang['setting_commerce_lobaddressverification.invalid_dpv'] = 'Invalid Deliverability Codes';
$_lang['setting_commerce_lobaddressverification.invalid_dpv_desc'] = 'Deliverability codes to reject when verifying the address. This is in the DPV footnotes of the response object. See more at https://lob.com/docs#us_verification_details';

// HTTP errors
$_lang['commerce_lobaddressverification.http_401'] = '[Lob Address Verification] HTTP 401 - Authorization error with your API key or account';
$_lang['commerce_lobaddressverification.http_403'] = '[Lob Address Verification] HTTP 403 - Forbidden error with your API key or account';
$_lang['commerce_lobaddressverification.http_404'] = '[Lob Address Verification] HTTP 404 - The requested item does not exist';
$_lang['commerce_lobaddressverification.http_422'] = '[Lob Address Verification] HTTP 402 - The query or body parameters did not pass validation';
$_lang['commerce_lobaddressverification.http_429'] = '[Lob Address Verification] HTTP 429 - Too many requests have been sent with an API key in a given amout of time';
$_lang['commerce_lobaddressverification.http_500'] = '[Lob Address Verification] HTTP 500 - An internal server error occurred, please contact support@lob.com';

// DPVs
$_lang['commerce_lobaddressverification.dpv_AA'] = 'Some parts of the address (such as the street and ZIP code) are valid.';
$_lang['commerce_lobaddressverification.dpv_A1'] = 'The address is invalid based on given inputs.';
$_lang['commerce_lobaddressverification.dpv_BB'] = 'The address is deliverable.';
$_lang['commerce_lobaddressverification.dpv_CC'] = 'The address is deliverable by removing the provided secondary unit designator.';
$_lang['commerce_lobaddressverification.dpv_N1'] = 'The address is deliverable but is missing a secondary information (apartment, unit, etc).';
$_lang['commerce_lobaddressverification.dpv_F1'] = 'The address is a deliverable military address.';
$_lang['commerce_lobaddressverification.dpv_G1'] = 'The address is a deliverable General Delivery address. General Delivery is a USPS service which allows individuals without permanent addresses to receive mail.';
$_lang['commerce_lobaddressverification.dpv_U1'] = 'The address is a deliverable unique address. A unique ZIP code is assigned to a single organization (such as a government agency) that receives a large volume of mail.';
$_lang['commerce_lobaddressverification.dpv_M1'] = 'The address is missing.';
$_lang['commerce_lobaddressverification.dpv_M3'] = 'The address is invalid.';
$_lang['commerce_lobaddressverification.dpv_P1'] = 'PO Box, Rural Route, or Highway Contract box number is missing.';
$_lang['commerce_lobaddressverification.dpv_P3'] = 'PO Box, Rural Route, or Highway Contract box number is invalid.';
$_lang['commerce_lobaddressverification.dpv_R1'] = 'The address matched to a CMRA and private mailbox information is present.';
$_lang['commerce_lobaddressverification.dpv_RR'] = 'The address matched to a CMRA and private mailbox information is not present.';