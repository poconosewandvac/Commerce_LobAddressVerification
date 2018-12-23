<?php
namespace PoconoSewVac\Lob\AddressVerification\Modules;
use modmore\Commerce\Modules\BaseModule;
use modmore\Commerce\Admin\Widgets\Form\DescriptionField;
use Symfony\Component\EventDispatcher\EventDispatcher;
use modmore\Commerce\Events\AddressValidation;

require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

class AddressVerification extends BaseModule {

    public function getName()
    {
        $this->adapter->loadLexicon('commerce_lobaddressverification:default');
        return $this->adapter->lexicon('commerce_lobaddressverification');
    }

    public function getAuthor()
    {
        return 'Tony Klapatch - Pocono Sew & Vac';
    }

    public function getDescription()
    {
        return $this->adapter->lexicon('commerce_lobaddressverification.description');
    }

    public function initialize(EventDispatcher $dispatcher)
    {
        // Load our lexicon
        $this->adapter->loadLexicon('commerce_lobaddressverification:default');
        $dispatcher->addListener(\Commerce::EVENT_ADDRESS_VALIDATE, [$this, 'validateAddress']);
    }

    public function validateAddress(AddressValidation $event)
    {
        $apiKey = $this->adapter->getOption('commerce_lobaddressverification.api_key');
        $invalidDpv = array_map('trim', explode(',', $this->adapter->getOption('commerce_lobaddressverification.invalid_dpv')));
        $address = $event->getAddress();

        // Map comAddress to Lob fields
        $addressMap = [
            'recipient' => $address->get('company') ?: $address->get('fullname'),
            'primary_line' => $address->get('address1'),
            'secondary_line' => $address->get('address2') ?: null,
            'city' => $address->get('city'),
            'state' => $address->get('state'),
            'zip_code' => $address->get('zip')
        ];

        // Query the lob us verification API
        $ch = curl_init('https://api.lob.com/v1/us_verifications');
        curl_setopt($ch, CURLOPT_USERPWD, $apiKey);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $addressMap);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Handle API errors. HTTP codes from https://lob.com/docs#version
        switch ($httpCode) {
            case 401:
                $this->adapter->log(1, $this->adapter->lexicon('commerce_lobaddressverification.http_401'));
                return;
            case 403:
                $this->adapter->log(1, $this->adapter->lexicon('commerce_lobaddressverification.http_403'));
                return;
            case 404:
                $this->adapter->log(1, $this->adapter->lexicon('commerce_lobaddressverification.http_404'));
                return;
            case 422:
                $this->adapter->log(1, $this->adapter->lexicon('commerce_lobaddressverification.http_422'));
                return;
            case 429:
                $this->adapter->log(1, $this->adapter->lexicon('commerce_lobaddressverification.http_429'));
                return;
            case 500:
                $this->adapter->log(1, $this->adapter->lexicon('commerce_lobaddressverification.http_500'));
                return;
        }

        curl_close($ch);
        $response = json_decode($response, true);

        // Get any invalid deliveryability types from the response
        $invalid = [];
        foreach ($response['deliverability_analysis']['dpv_footnotes'] as $d) {
            if (in_array($d, $invalidDpv)) {
                $invalid[] = $d;
            }
        }

        // Set error messages for invalid deliverability types
        if (count($invalid) > 0) {
            foreach ($invalid as $d) {
                $event->addMessage($this->adapter->lexicon('commerce_lobaddressverification.dpv_' . $d));
            }
        }
    }

    public function getModuleConfiguration(\comModule $module)
    {
        $fields = [];
        
        return $fields;
    }
}
