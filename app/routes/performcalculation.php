<?php
/**
 * Created by PhpStorm.
 * User: slim
 * Date: 13/10/17
 * Time: 10:41
 */

use Slim\Http\Request;
use Slim\Http\Response;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$app->post(
    '/performcalculation',
    function (Request $request, Response $response) use ($app) {

        $logs_file_path = '/p3t/phpappfolder/logs/';
        $logs_file_name = 'calculations.log';
        $logs_file = $logs_file_path . $logs_file_name;

        $log = new Logger('logger');
        $log->pushHandler(new StreamHandler($logs_file, Logger::INFO));

        $file_path = dirname(__DIR__) . '/src/';
        require $file_path . 'calculateValidate.php';
        require $file_path . 'calculateModel.php';

        $params = $request->getParsedBody();

//      Stores value from each field
        $deviceMSISDN_1 = $params['deviceMSISDN1'];
        $switch1_setting = $params['switch1'];
        $switch2_setting = $params['switch2'];
        $switch3_setting = $params['switch3'];
        $switch4_setting = $params['switch4'];
        $fan_setting = $params['fan'];
        $temperature = $params['temperature1'];
        $lastDigit = $params['lastDigit1'];

//      Creates connection to soapclient
        $soapclient = new SoapClient('https://m2mconnect.ee.co.uk/orange-soap/services/MessageServiceByCountry?wsdl');
        ini_set('soap.wsdl_cache_enabled',0);

//      Create the message
        $message = 'Group WAO - Switch 1: ' . $switch1_setting . ' Switch 2: ' . $switch2_setting . ' Switch 3: ' . $switch3_setting . ' Switch 4: ' . $switch4_setting . ' - Fan: ' . $fan_setting . ' Temperature: ' . $temperature . ' Degrees Celsius - Last Digit Entered: ' . $lastDigit;

        //Use the functions of the client, the params of the function are in
        //the associative array
        $params = array('username' => '19p17193256', 'password' => 'Bnoyes981234', 'deviceMSISDN' => $deviceMSISDN_1, 'message' => $message, 'deliveryReport' => 0, 'mtBearer' => 'SMS');

        $response = $soapclient->__soapCall('sendMessage', $params);

        $log->info($response);

        return $this->view->render(
            $response,
            'calculation_result.html.twig',
            [
                'value_1' => $value_1,
                'value_2' => $value_2,
                'calculation_type' => $calculation_type,
                'calculation_result' => $calculation_result,
            ]
        );
    }
)->setName('performcalculation');
