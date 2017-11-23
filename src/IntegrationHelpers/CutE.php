<?php

namespace Accendo\PsychometricAssessment\IntegrationHelpers;

class CutE
{
    public $soapOption = array('soap_version' => 'SOAP_1_2', "trace" => 1, "exception" => 0, 'compression' => SOAP_COMPRESSION_GZIP);
    public $soapClient;
    
    public function initSoapClient($url) {
        $this->soapClient = new \SoapClient($url . '?WSDL', $this->soapOption);
    }

    public function getSoapUrl($wsdl) {
		return config('cute.protocol') . '://' . config('cute.domain') . '/' . config('cute.path') . '/' . $wsdl;
    }
    public function registerIntegratable(){
        /*parameters 
            registerIntegratable(
                $cute_secure_code,
                $client_id,
                $project_id,
                $id,
                $first_name,
                $last_name
            )
        */
        $url = $this->getSoapUrl('ws.asmx');

        $this->initSoapClient($url);

        $params = array(
			'requesttype' => 'page_candhub_autoregister', // register candidate
			'securecode' => "3c44a4958cd1718be606912c3f58d980", // $cute_secure_code = $integratable->getCuteSecureCode()
			'clientid' => "2432", //$client_id = $integratable->getCuteClientId()
			'jobid' => '',
			'languageid' => '2',
			'projectid' => '143310',//$project_id = $integratable->getCuteProjectId()
			'candidateid' => '1',//$id = $integratable->getId()
			'instrumentid' => '',
			'reportid' => '',
			'normsetid' => '',
			'firstname' => 'mhd',//$first_name = $integratable->getFirstName()
			'lastname' => 'hlby',//$last_name = $integratable->getLastName()
			'genderid' => '1',
			'ipaddress' => '',
			'returnurl' => '',
			'notifylist' => '',
			'emailaddress' => '',
			'resultposturl' => '',
			'resultpostheaders' => '',
			'resultpostbodytemplate' => '',
		);

        $ret = $this->soapClient->runWSxml($params);

        $response = $this->soapClient->__getLastResponse();

        $p = xml_parser_create();
        xml_parse_into_struct($p, $response, $vals, $index);

        $result = false;
        foreach ($vals as $val)
        {
            if($val['tag'] == 'RESULT'){
                $result = $val['value'];
                return $result;
            }

            if($val['tag'] == 'ERROR'){
                $result = $val['value'];
                return $result;
            }
        }

        return $result;
    }
}