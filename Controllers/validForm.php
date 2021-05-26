<?php

function validForm(array $regex, array $data): array
{
    $formError = [];
    foreach ($regex as $input_name => $regex_value) {
        // si le champs firstname n'est pas vide
        if (!empty($data[$input_name])) {
            // si la valeur saisie ne passe pas la regex
            if (!preg_match($regex_value, $data[$input_name])) {
                //défintion d'un message d'erreur et stockage dans un tableau
                $formError[$input_name] = $input_name.'=Caractère non valide';
            }
        } else {
            $formError[$input_name] = $input_name.'=Champs vide';
        }
    }
    return $formError;
}

