<?php

    function typeUser($type){
        return ($type == 'admin') ?  "Administrador" : "Estudiante";
    }


    function todayDate()
    {
        $formatter = new IntlDateFormatter(
            'es_MX', 
            IntlDateFormatter::FULL,
            IntlDateFormatter::NONE,
            'America/Mexico_City',
            IntlDateFormatter::GREGORIAN,
            "EEEE d 'de' MMMM 'de' y" 
        );

        return ucfirst($formatter->format(time()));
    }
