<?php


    namespace CoffeeHouse\Objects;

    /**
     * Class Session
     * @package CoffeeHouse\Objects
     */
    class Session
    {
        /**
         * The ID of the Session
         *
         * @var string
         */
        public $ID;

        /**
         * The language that this session is based on
         *
         * @var string
         */
        public $Language;

        /**
         * Indicates if this session is available or not
         *
         * @var bool
         */
        public $Available;

        /**
         * The Unix Timestamp of when this session expires
         *
         * @var int
         */
        public $Expires;

        /**
         * Creates an array that represents this object's structure and values
         *
         * @return array
         */
        public function toArray(): array
        {
            return array(
                'session_id' => $this->ID,
                'language' => $this->Language,
                'available' => (bool)$this->Available,
                'expires' => (int)$this->Expires
            );
        }

        /**
         * Creates a session object from an array
         *
         * @param array $data
         * @return Session
         */
        public static function fromArray(array $data): Session
        {
            $SessionObject = new Session();

            if(isset($data['session_id']))
            {
                $SessionObject->ID = $data['session_id'];
            }

            if(isset($data['language']))
            {
                $SessionObject->Language = $data['language'];
            }

            if(isset($data['available']))
            {
                $SessionObject->Available = (bool)$data['available'];
            }

            if(isset($data['expires']))
            {
                $SessionObject->Expires = (int)$data['expires'];
            }

            return $SessionObject;
        }
    }