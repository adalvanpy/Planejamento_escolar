<?php
session_start();
include("conexao.php");
 require 'vendor/autoload.php';
 use Dompdf\Dompdf;

 $html = $_POST['html'];
 $dompdf = new Dompdf();
 $dompdf->loadHtml($html);
 $dompdf->setPaper('A4', 'portrait');
 $dompdf->render();
 $dompdf->stream('planejamento.pdf', ["Attachment" => true]);
?>