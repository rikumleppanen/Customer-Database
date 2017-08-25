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

//    public function isUnique($email) {
//        $query = DB::connection()->prepare('SELECT COUNT(*) FROM Marketinguru WHERE email=:email');
//        $query->execute(array('email' => $email));
//        $row = $query->fetch();
//
//        if (sum($row['count']) > 0) {
//            return false;
//        } else {
//            return true;
//        }
//    }
}
    