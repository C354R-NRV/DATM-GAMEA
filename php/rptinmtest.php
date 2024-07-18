<?php
require '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;


$doc = '<page backtop="10mm" backbottom="10mm" backleft="20mm" backright="20mm">
    <page_header>
        <table style="width: 100%; border: solid 1px black;">
            <tr>
                <td style="text-align: left;    width: 33%">html2pdf</td>
                <td style="text-align: center;    width: 34%">Test d header</td>
                <td style="text-align: right;    width: 33%"> ssss</td>
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 100%; border: solid 1px black;">
            <tr>
                <td style="text-align: left;    width: 50%">html2pdf.fr</td>
                <td style="text-align: right;    width: 50%">page [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
    </page_footer>
    <span style="font-size: 20px; font-weight: bold">Démonstration des retour à la ligne automatique, ainsi que des sauts de page automatique</span><br>
    <br>
    <br>
    <table style="width: 80%;border: solid 1px #5544DD; border-collapse: collapse" align="center">
        <thead>
            <tr>
                <th style="width: 30%; text-align: left; border: solid 1px #337722; background: #CCFFCC">Header 1</th>
                <th style="width: 30%; text-align: left; border: solid 1px #337722; background: #CCFFCC">Header 2</th>
            </tr>
        </thead>
        <tbody> 
        <tr>
            <td style="width: 30%; text-align: left; border: solid 1px #55DD44">
                test de texte assez long pour engendrer des retours à la ligne automatique...
                a b c d e f g h i j k l m n o p q r s t u v w x y z
                a b c d e f g h i j k l m n o p q r s t u v w x y z
            </td>
            <td style="width: 70%; text-align: left; border: solid 1px #55DD44">
                test de texte assez long pour engendrer des retours à la ligne automatique...
                a b c d e f g h i j k l m n o p q r s t u v w x y z
                a b c d e f g h i j k l m n o p q r s t u v w x y z

            </td>
        </tr> 
        </tbody>
        <tfoot>
            <tr>
                <th style="width: 30%; text-align: left; border: solid 1px #337722; background: #CCFFCC">Footer 1</th>
                <th style="width: 30%; text-align: left; border: solid 1px #337722; background: #CCFFCC">Footer 2</th>
            </tr>
        </tfoot>
    </table>
    <br>
    Ca marche !!!<br>
    refaisons un test : <br>
    <table style="width: 80%;border: solid 1px #5544DD">
    <tr>
        <td style="width: 30%; text-align: left; border: solid 1px #55DD44">
            test de texte assez long pour engendrer des retours à la ligne automatique...
            a b c d e f g h i j k l m n o p q r s t u v w x y z
            a b c d e f g h i j k l m n o p q r s t u v w x y z
        </td>
        <td style="width: 70%; text-align: left; border: solid 1px #55DD44">
            test de texte assez long pour engendrer des retours à la ligne automatique...
            a b c d e f g h i j k l m n o p q r s t u v w x y z
            a b c d e f g h i j k l m n o p q r s t u v w x y z

        </td>
    </tr>
    </table>
    <br>
    Ca marche toujours !<br>
    De plus, vous pouvez faire des sauts de page manuellement en utilisant les balises &lt;page&gt; &lt;/page&gt;, comme ici par exemple :
</page> ';
 
    $html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8', 3); 
    $html2pdf->writeHTML($doc);
    $html2pdf->output(); 
