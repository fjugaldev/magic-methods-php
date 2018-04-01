<?php

class Notification 
{

    const TYPE_SMS   = "SMS";
    const TYPE_EMAIL = "EMAIL";

    protected $title;
    protected $body;
    protected $to;
    protected $type;
    protected $payload;

    public function getTitle() {
        return $this->title;
    }

    public function getBody() {
        return $this->body;
    }

    public function getTo() {
        return $this->to;
    }

    public function getType() {
        return $this->type;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function setTo($to) {
        $this->to = $to;
    }

    public function setType($type) {
        $this->type = $type;
    }

    protected function buildPayload() {
        $configuration = array(
            'provider' => $this->type,
            'params'   => array(
                'title' => $this->title,
                'body'  => $this->body,
                'to'    => $this->to,
            ),
        );

        $this->payload = json_encode($configuration);
    }

    public function __sleep() {
        echo "Serialización detectada..." . PHP_EOL;
        return array(
            'title',
            'body',
            'to',
            'type',
        );
    }
    public function __wakeup() {
        echo "Deserializando..." . PHP_EOL;
        $this->buildPayload();
    }
    
    public function send() {
        echo "Enviando notificación utilizando el payload: {$this->payload} ..." . PHP_EOL;
    }

}
