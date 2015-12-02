<?php
/*
This file should be in app/views/elements/export_xls.ctp
Thanks to Marco Tulio Santos for this simple XLS Report
*/

	header ("Expires: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/vnd.ms-excel");
	header ("Content-Disposition: attachment; filename=".$filename.".xls" );
	header ("Content-Description: Exported as XLS" );
?>

<style type="text/css">
    .tableTd {
           border-width: 0.5pt;
        border: solid;
    }
    .tableTdContent{
        border-width: 0.5pt;
        border: solid;
    }
    #titles{
        font-weight: bolder;
    }
 table {
    width: 100%;
}
table th a{
    background-color: #639ACE;
    color: #ffffff;
}

table th{
    background-color: #639ACE;
    color: #ffffff;
} 
</style>
<table>
    <tr>
        <td><b><?php echo $titulo;?><b></td>
    </tr>
    <tr>
        <td><b>Fecha de Generacion:</b></td>
        <td><?php echo date("d/m/Y"); ?></td>
    </tr>
    <tr>
        <td></td>
        <td style="text-align:left"></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <?php echo '<tr>';
        foreach($rows as $row):
           
            foreach($row as $line):
                foreach($line as $llave => $valor):
                   
                    echo '<td class="tableTdContent">'.$llave.'</td>';
                   
                endforeach;
            //break;
            endforeach;
         
          break;
          endforeach;
          echo '</tr>';
        ?>       
    <?php foreach($rows as $row):
            echo '<tr>';
            foreach($row as $line):
                foreach($line as $valor):
                    echo '<td class="tableTdContent">'.$valor.'</td>';
                endforeach;
            endforeach;
          echo '</tr>';
          endforeach;
        ?>   
</table>
