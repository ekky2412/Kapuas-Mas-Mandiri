<?php
class Fpdi {

    function __construct() {
        include_once APPPATH . '/third_party/fpdf.php';
        include_once APPPATH . '/third_party/fpdi.php';
        include_once APPPATH . '/third_party/autoload.php';
    }
}
?>