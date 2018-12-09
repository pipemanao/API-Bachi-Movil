<?php

$json = '
{
    "courses": [
        {
            "id": "1",
            "courseCode": "BAIN065",
            "courseName": "ÁLGEBRA PARA INGENIERÍA",
            "mainTag": "MATEMATICAS"
        },
        {
            "id": "2",
            "courseCode": "BAIN067",
            "courseName": "GEOMETRÍA PARA INGENIERÍA",
            "mainTag": "MATEMATICAS"
        },
        {
            "id": "3",
            "courseCode": "BAIN071",
            "courseName": "COMUNICACIÓN IDIOMA ESPAÑOL",
            "mainTag": "IDIOMAS"
        },
        {
            "id": "4",
            "courseCode": "BAIN069 ",
            "courseName": "QUÍMICA PARA INGENIERÍA",
            "mainTag": "QUIMICA"
        },
        {
            "id": "5",
            "courseCode": "BAIN073",
            "courseName": "ÁLGEBRA LINEAL PARA INGENIERÍA",
            "mainTag": "MATEMATICAS"
        },
        {
            "id": "6",
            "courseCode": "BAIN075",
            "courseName": "CÁLCULO EN UNA VARIABLE",
            "mainTag": "MATEMATICAS"
        },
        {
            "id": "7",
            "courseCode": "BAIN079",
            "courseName": "COMUNICACIÓN IDIOMA INGLÉS",
            "mainTag": "IDIOMAS"
        }
    ]
}
';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
echo $json;