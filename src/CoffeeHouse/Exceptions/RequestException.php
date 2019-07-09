<?php


    namespace CoffeeHouse\Exceptions;

    use Exception;
    use Throwable;

    /**
     * Class RequestException
     * @package CoffeeHouse\Exceptions
     */
    class RequestException extends Exception
    {
        /**
         * RequestException constructor.
         * @param string $message
         * @param int $code
         * @param Throwable|null $previous
         */
        public function __construct($message = "", $code = 0, Throwable $previous = null)
        {
            parent::__construct($message, $code, $previous);
        }
    }