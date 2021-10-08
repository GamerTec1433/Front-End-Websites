<?php
    class AlertBox
    {
        public static $alertTypeSes = "alert_type";
        public static $alertMessageSes = "alert_message";

        public static $info = 'info-message';
        public static $warning = 'warning-message';
        public static $error = 'error-message';
        public static $success = 'success-message';

        private $infoIcon = '<i class="fas fa-exclamation-circle"></i>';
        private $warningIcon = '<i class="fas fa-exclamation-triangle"></i>';
        private $errorIcon = '<i class="fas fa-times-circle"></i>';
        private $successIcon = '<i class="fas fa-check-circle"></i>';

        private $alertBoxHTML;
        private $type;
        private $content;
        private $typeName;
        private $typeIcon;

        function __construct($type, $content){
            $this->type = $type;
            $this->content = $content;

            switch ($type) {
                case self::$info:
                    $this->typeName = 'Info';
                    $this->typeIcon = $this->infoIcon;
                    break;
                case self::$warning:
                    $this->typeName = 'Warning';
                    $this->typeIcon = $this->warningIcon;
                    break;
                case self::$error:
                    $this->typeName = 'Error';
                    $this->typeIcon = $this->errorIcon;
                    break;
                case self::$success:
                    $this->typeName = 'Success';
                    $this->typeIcon = $this->successIcon;
                    break;
                default:
                    $this->typeName = 'Info';
                    $this->typeIcon = $this->infoIcon;
                    break;
            }

            $this->alertBoxHTML = '<div class="alert '.$this->type.' d-flex justify-content-between align-items-center p-3">
                '.$this->typeIcon.'
                <div>
                    <strong>'.$this->typeName.': </strong>
                    <span>'.$this->content.'</span>
                </div>
                <button onclick="CloseAlertBox(this)"><i class="fas fa-times"></i></button>
                </div>';
        }

        public function GetAlertBoxHTML() {
            return $this->alertBoxHTML;
        }

        public static function GetSessionAlertBoxHTML() {
            if (session_status() == PHP_SESSION_NONE)
                session_start();

            if (isset($_SESSION[self::$alertTypeSes]))
            {
                $type = $_SESSION[self::$alertTypeSes];
                $mess = $_SESSION[self::$alertMessageSes];
                $alertBox = new AlertBox($type, $mess);
                return $alertBox->GetAlertBoxHTML();
            }
        }

        public static function SetStackAlertBox($alertContent) {
            return '<div id="alert-stack" class="d-flex flex-column justify-content-end align-items-center">
                '.$alertContent.'
            </div>';
        }

        

        public static function SetSessionAlertBox($alertType, $alertContent) {
            if (session_status() == PHP_SESSION_NONE)
            {
                session_start();
            }

            $_SESSION[self::$alertTypeSes] = $alertType;
            $_SESSION[self::$alertMessageSes] = $alertContent;
        }

        public static function DestroySessionAlertBox() {
            if (session_status() == PHP_SESSION_NONE)
                session_start();

            if (isset($_SESSION[self::$alertTypeSes]))
                unset($_SESSION[self::$alertTypeSes]);

            if (isset($_SESSION[self::$alertMessageSes]))
                unset($_SESSION[self::$alertMessageSes]);
        }
    }
?>