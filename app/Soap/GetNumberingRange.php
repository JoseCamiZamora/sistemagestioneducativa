<?php

namespace App\Soap;

use Stenfrank\UBL21dian\Templates\Template;
use Stenfrank\UBL21dian\Templates\CreateTemplate;

/**
 * Send bill async.
 */
class GetNumberingRange extends Template implements CreateTemplate
{
    /**
     * Action.
     *
     * @var string
     */
    public $Action = 'http://wcf.dian.colombia/IWcfDianCustomerServices/GetNumberingRange';

    /**
     * Required properties.
     *
     * @var array
     */
    protected $requiredProperties = [
        'softwareCode'
  
    ];

    /**
     * Construct.
     *
     * @param string $pathCertificate
     * @param string $passwors
     */
    public function __construct($pathCertificate, $passwors)
    {
        parent::__construct($pathCertificate, $passwors);
    }

    /**
     * Create template.
     *
     * @return string
     */
    public function createTemplate()
    {
        return $this->templateXMLSOAP = <<<XML
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:wcf="http://wcf.dian.colombia">
   <soap:Header/>
   <soap:Body>
      <wcf:GetNumberingRange>
      	 <wcf:accountCode>901438919</wcf:accountCode>
          <wcf:accountCodeT>901438919</wcf:accountCodeT>
         <wcf:softwareCode>e0c2502b-d113-4d89-bfc0-225208287a78</wcf:softwareCode>
      </wcf:GetNumberingRange>
   </soap:Body>
</soap:Envelope>
XML;
    }
}
