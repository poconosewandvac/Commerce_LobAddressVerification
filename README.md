# Lob US Address Verification

Verify US addresses during address creation at checkout with Lob's US address verification API. Must have a [Lob account](https://lob.com) to use and [modmore's Commerce](https://www.modmore.com/commerce).

## Installation

1. Install the package from the MODX package provider
2. Go to system settings and insert your API key into `commerce_lobaddressverification.api_key`

## Deliverability Codes

By default, this package includes common invalid deliverability codes. If you wish to modify this, you can adjust the `commerce_lobaddressverification.invalid_dpv` system setting. Lob's documentation provides DPV footnote codes here: https://lob.com/docs#us_verification_details