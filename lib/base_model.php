<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {
        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    public function errors() {
        // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        $errors = array();

        foreach ($this->validators as $validator) {
            $errors = array_merge($errors, $this->{$validator}());
        }

        return $errors;
    }

    public function validate_email() {
        $errors = array();
        if ($this->email != '' and ! filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Give the email address, please!';
        }
        return $errors;
    }

    public function validate_password() {
        $errors = array();
        if (strlen($this->password) < 4) {
            $errors[] = 'Give at least four (4) characters for the password, please!';
        }
        return $errors;
    }

    public function validate_EmailUniqueness() {
        $errors = array();
        $unique = Marketinguru::isUnique($this->email);
        Kint::dump($unique);
        if ($unique[0] > 0) {
            $errors[] = 'There cannot be several registered users with the same email address';
        }
        return $errors;
    }

    public function validate_number() {
        $errors = array();
        if ($this->number != '' and ! preg_match("/^[\s\d]+$/", $this->number)) {
            $errors[] = 'No white space, extra characters or country codes are needed in phone number!';
        }
        return $errors;
    }

    public function validate_name() {
        $errors = array();
        if ($this->name == '' || $this->name == null) {
            $errors[] = 'You must give a name!';
        }
        if (!preg_match('/^[a-öA-Ö ]*$/', $this->name)) {
            $errors[] = 'Only letters and white space allowed for name!';
        }
        if (strlen($this->name) < 5) {
            $errors[] = 'Name requires at least 5 characters';
        }
        return $errors;
    }

}
