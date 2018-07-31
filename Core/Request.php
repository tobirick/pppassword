<?php

namespace Core;

class Request
{
    private $params;
    private $lang;

    public function __construct($params, $lang)
    {
        $this->params = $params;
        $this->lang = $lang;
    }

    public function getParam($param)
    {
        if (array_key_exists($param, $this->params)) {
            return $this->params[$param];
        } else {
            return false;
        }
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getLang()
    {
        return $this->lang;
    }

    public function isMethod($method)
    {
        if ($_SERVER['REQUEST_METHOD'] === strtoupper($method)) {
            return $_SERVER['REQUEST_METHOD'];
        } else {
            return false;
        }
    }

    public function validate($providedValidations, $type = '')
    {
        if ($this->isMethod('POST') && $_POST) {
            $data = $type ? $_POST[$type] : $_POST;
        } else if(is_array($type)) {
            $data = $type;
        } else {
            $data = $type ? $this->ajax()->getJSON()[$type] : $this->ajax()->getJSON();
        }

        $validator = new Validator($data, $providedValidations, $this->lang);

        $errors = $validator->validate();

        if ($errors) {
            $_SESSION['errors'] = $errors;
        }

        return $errors;
    }

    public function flash()
    {
        $flashClass = new Flash();

        return $flashClass;
    }

    public function session()
    {
        $sessionClass = new Session();

        return $sessionClass;
    }

    public function ajax()
    {
        $ajaxClass = new Ajax();

        return $ajaxClass;
    }

    public function user() {
        if (isset($_SESSION['userid'])) {
            return $_SESSION['userid'];
        }
    }
}