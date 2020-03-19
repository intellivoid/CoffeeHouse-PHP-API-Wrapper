<?php


    namespace CoffeeHouse;

    use CoffeeHouse\Exceptions\CoffeeHouseException;
    use CoffeeHouse\Exceptions\RequestException;
    use CoffeeHouse\Objects\Session;
    use Exception;

    include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Exceptions' . DIRECTORY_SEPARATOR . 'CoffeeHouseException.php');
    include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Exceptions' . DIRECTORY_SEPARATOR . 'RequestException.php');

    include_once(__DIR__ . DIRECTORY_SEPARATOR . 'Objects' . DIRECTORY_SEPARATOR . 'Session.php');

    /**
     * Class CoffeeHouse
     * @package CoffeeHouse
     */
    class CoffeeHouse
    {
        /**
         * @var string
         */
        private $endpoint;

        /**
         * @var string
         */
        private $api_key;

        /**
         * CoffeeHouse constructor.
         * @param string $api_key
         * @param string $endpoint
         */
        public function __construct(string $api_key, string $endpoint = "https://api.intellivoid.net/coffeehouse")
        {
            $this->api_key = $api_key;
            $this->endpoint = $endpoint;
        }

        /**
         * Sends a POST Request to the API Endpoint
         *
         * @param string $module
         * @param array $request_payload
         * @return string
         * @throws RequestException
         */
        private function sendRequest(string $module, array $request_payload): string
        {
            try
            {
                $ch = curl_init($this->endpoint . "/v2/$module");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $request_payload);
                $response = curl_exec($ch);
                curl_close($ch);
                return $response;
            }
            catch (Exception $exception)
            {
                throw new RequestException($exception->getMessage());
            }
        }

        /**
         * Creates a new session
         *
         * @param string $language
         * @return Session
         * @throws CoffeeHouseException
         * @throws RequestException
         */
        public function createSession(string $language): Session
        {
            $RequestPayload = array(
                'api_key' => $this->api_key,
                'language' => $language
            );
            $Response = json_decode($this->sendRequest('CreateSession', $RequestPayload), true);

            if($Response['status'] == false)
            {
                throw new CoffeeHouseException();
            }

            return Session::fromArray($Response['payload']);
        }

        /**
         * Gets an existing session
         *
         * @param string $session_id
         * @return Session
         * @throws CoffeeHouseException
         * @throws RequestException
         */
        public function getSession(string $session_id): Session
        {
            $RequestPayload = array(
                'api_key' => $this->api_key,
                'session_id' => $session_id
            );
            $Response = json_decode($this->sendRequest('GetSession', $RequestPayload), true);

            if($Response['status'] == false)
            {
                throw new CoffeeHouseException();
            }

            return Session::fromArray($Response['payload']);
        }

        /**
         * Processes user input to get an output from the AI
         *
         * @param string $session_id
         * @param string $input
         * @return string
         * @throws CoffeeHouseException
         * @throws RequestException
         */
        public function thinkThought(string $session_id, string $input): string
        {
            $RequestPayload = array(
                'api_key' => $this->api_key,
                'session_id' => $session_id,
                'input' => $input
            );
            $Response = json_decode($this->sendRequest('ThinkThought', $RequestPayload), true);

            if($Response['status'] == false)
            {
                throw new CoffeeHouseException();
            }

            return $Response['payload']['output'];
        }

        /**
         * @return string
         */
        public function getEndpoint(): string
        {
            return $this->endpoint;
        }

        /**
         * @return string
         */
        public function getApiKey(): string
        {
            return $this->api_key;
        }
    }
