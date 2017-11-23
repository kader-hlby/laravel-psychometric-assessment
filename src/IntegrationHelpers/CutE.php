<?php

namespace Accendo\PsychometricAssessment\IntegrationHelpers;

class CutE
{   
    public $soapOption = array('soap_version' => 'SOAP_1_2', "trace" => 1, "exception" => 0, 'compression' => SOAP_COMPRESSION_GZIP);
    public $soapClient;

    public $candidateInstrumentStatusDictionary = array(
		'0' => 'Unknown Error',
		'1' => 'New',
		'2' => 'In Progress',
		'4' => 'Complete',
		'5' => 'Blocked',
    );
    
    public function initSoapClient($url) 
    {
        $this->soapClient = new \SoapClient($url . '?WSDL', $this->soapOption);
    }

    public function getSoapUrl($wsdl) 
    {
		return config('psychometric_assessment.cute.protocol') . '://' . config('psychometric_assessment.cute.domain') . '/' . config('psychometric_assessment.cute.path') . '/' . $wsdl;
    }
    
    public function callRegistrationApi($integratable)
    {
        $url = $this->getSoapUrl('ws.asmx');
        
        $this->initSoapClient($url);

        $params = array(
            'requesttype' => "page_candhub_autoregister",
            'securecode' => $integratable->psychometricAssessmentGetCuteSecureCode(),
            'clientid' => $integratable->psychometricAssessmentGetCuteClientId(), 
            'jobid' => '',
            'languageid' => '2',
            'projectid' => $integratable->psychometricAssessmentGetCuteProjectId(),
            'candidateid' => $integratable->psychometricAssessmentGetId(),
            'instrumentid' => '',
            'reportid' => '',
            'normsetid' => '',
            'firstname' => $integratable->psychometricAssessmentGetFirstName(),
            'lastname' => $integratable->psychometricAssessmentGetLastName(),
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

        return $this->getData($response,'RESULT');
    }

    public function callCheckStatusApi($integratable)
    {
        $url = $this->getSoapUrl('wsmaintenance.asmx');
        
		$this->initSoapClient($url);

        $params = [
            'reqobj'=>[
                'ClientId'=>$integratable->psychometricAssessmentGetCuteClientId(), 
                'ProjectId'=>$integratable->psychometricAssessmentGetCuteProjectId(),
                'InstrumentId'=>'-1',
                'CandidateId'=>$integratable->psychometricAssessmentGetId(),
                'NewCandidateId'=>'testing',
                'SecureCode'=>$integratable->psychometricAssessmentGetCuteSecureCode(),
            ]
        ];
        $ret = $this->soapClient->GetInstrumentStatus($params);

        $response = $this->soapClient->__getLastResponse();
        
        return $this->getData($response,'INSTRUMENTSTATUS');
    }
    
    private function getData($response,$tag)
    {
        $p = xml_parser_create();
        xml_parse_into_struct($p, $response, $vals, $index);

        foreach ($vals as $val)
        {
            if($val['tag'] == $tag){
                $result = $val['value'];
                if($tag == 'INSTRUMENTSTATUS')
                {
                    $status = isset($this->candidateInstrumentStatusDictionary[$result])?
                                $this->candidateInstrumentStatusDictionary[$result]: 
                                "undefine";
                    return ['status' => $status];
                }
                return ['assessment_url' => $result];
            }

            if($val['tag'] == 'ERROR'){
                $result = $val['value'];
                return ['errors' => $result];
            }
        }

        return ['errors' => 'something went wrong'];
    }
}