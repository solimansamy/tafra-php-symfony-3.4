<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/api/webhook")
 */
class WebHookController extends Controller
{
    /**
     * @Route("/messenger")
     * @Method({"POST"})
     */
    public function MessengerAction()
    {
        return $this->render('AppBundle:WebHook:messenger.html.php', array(
            // ...
        ));
    }

    /**
     * @Route("/whatsapp")
     * @Method({"POST"})
     */
    public function WhatsappAction()
    {
        // listen to the POST request from Dialogflow
        $request = file_get_contents("php://input");
        $requestJson = json_decode($request, true);

        $city = $requestJson['queryResult']['parameters']['geo-city'];

        if (isset($city)) {
            echo $this->getWeatherInformation($city);exit;
        }
    }

    /**
     * Makes an API call to OpenWeatherMap and
     * retrieves the weather data of a given city.
     *
     * @param string $city
     *
     * @return void
     */
    private function getWeatherInformation($city)
    {
        $apiKey = '4960e8061ca1902d42f16f9313c6fbcf';
        $weatherUrl = "https://api.openweathermap.org/data/2.5/weather?q=$city&units=metric&appid=$apiKey";
        $weather = file_get_contents($weatherUrl);

        $weatherDetails =json_decode($weather, true);


        $temperature = round($weatherDetails["main"]["temp"]);
        $weatherDescription = $weatherDetails["weather"][0]["description"];

        return $this->sendFulfillmentResponse($temperature, $weatherDescription);
    }

    /**
     * Send weather data response to Dialogflow
     *
     * @param integer $temperature
     * @param string  $weatherDescription
     *
     * @return void
     */
    private function sendFulfillmentResponse($temperature, $weatherDescription)
    {
        $response = "It is $temperature degrees with $weatherDescription";

        $fulfillment = array(
            "fulfillmentText" => $response
        );

        return (json_encode($fulfillment));
    }

}
