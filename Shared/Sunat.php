<?php

class Sunat
{
    private $url;
    private $token;

    public function __construct()
    {
        $env = getenv();
        $this->url = $env["ZENID_ADS_URL_RUC"];      //"https://dniruc.apisperu.com/api/v1/ruc/";
        $this->token = $env["ZENID_ADS_TOKEN_RUC"]; //"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImlnbmFjaW9ydWVkYWJvYWRhQGdtYWlsLmNvbSJ9.PEtcuSdcO3NvRlhSOe2br5jQHiIr99IIO4SNxH1syRM";
    }

    public function validarRuc($ruc)
    {
        $ruta = $this->url . $ruc . "?token=" . $this->token;
        $respuesta = file_get_contents($ruta);
        $datos = json_decode($respuesta, true);
        
        if (isset($datos["ruc"])) {
            return array(
                "ok" => true,
                "mensaje" => "RUC Válido",
                "empresa"=> $datos["razonSocial"]
            );
        }
        else
        {
            return array(
                "ok" => false,
                "mensaje" => "RUC Inválido"
            );
        }
    }
}

?>