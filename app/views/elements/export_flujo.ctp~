<?php // export flujoReport ?>


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
// ?>

<?php
//   pr($rows);exit();
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
    color: #FFF;
} 
</style>


<?php 
    $tclass = 'tableTdContent';
?>


<table>
    <tr>
        <td ><b><?php echo $titulo;?><b></td>
    </tr>
    <tr>
        <td><b>Fecha de Generacion:</b></td>
        <td><?php echo date("d/m/Y"); ?></td>
    </tr>
    <tr>
        <td></td>
        <td style="text-align:left"></td>
    </tr>
</table>

<?php foreach($rows['flujo'] as $month => $Realms){?>
	<table >
		<?php foreach($Realms as $accounts => $AccountData){?>
		  <tr />
		  <td style="font-weight:bolder;" /><?php e(utf8_decode($accounts));?> para el Mes de <?php e($rows['mes'][$month]);?> semana <?php e('');?>
		  <tr />
		   <?php foreach($AccountData as $Account => $entidad){?>
			<td style="font-weight:bolder;" /><?php e(utf8_decode($Account));?>
			  <tr />
				<?php foreach($entidad as $concept => $charge){?>
				  <td class="<?php e($tclass)?>" /><?php e(utf8_decode($concept));?>
				  <td class="<?php e($tclass)?>" /><?php e('$'.number_format(money_format('%i',$charge), 2, '.', ','));?>
				  <tr />
				  
				<?php }?>
				
				<td class="<?php e($tclass)?>" style="font-weight:bolder;" />Total de <?php e(utf8_decode($Account));?>
				<td class="<?php e($tclass)?>" style="font-weight:bolder;" /><?php e('$'.number_format(money_format('%i',$rows['flujoTotalByRealmsClass'][$month][$accounts][$Account]), 2, '.', ','));?>

				<tr />
		  <?php }?>
		  
		<?php }?>
				<tr />
				<td style="font-weight:bolder;" />Total de Ingresos para el Mes de <?php e($rows['mes'][$month]);?>
				<td style="font-weight:bolder;" /><?php e('$'.number_format(money_format('%i',$rows['flujoTotalByRealm'][$month]['Ingresos']), 2, '.', ','));?>
				<tr />
				<td style="font-weight:bolder;" />Total de Egresos para el Mes de <?php e($rows['mes'][$month]);?>
				<td style="font-weight:bolder;" /><?php e('$'.number_format(money_format('%i',$rows['flujoTotalByRealm'][$month]['Egresos']), 2, '.', ','));?>
				<tr />
				<td style="font-weight:bolder;" />Saldo Inicial
				<td style="font-weight:bolder;" /><?php e('$'.number_format(money_format('%i',$rows['saldo'][$month]['FlujoSaldo']['presupuesto']), 2, '.', ','));?>
				<tr />
				<td style="font-weight:bolder;" />Saldo Disponible 
				<td style="font-weight:bolder;" /><?php e('$'.number_format(money_format('%i',$rows['saldo'][$month]['FlujoSaldo']['SaldoDisponible']), 2, '.', ','));?>
				<tr />
				<td style="font-weight:bolder;" />Efectivo Disponible
				<td style="font-weight:bolder;" /><?php e('$'.number_format(money_format('%i',$rows['saldo'][$month]['FlujoSaldo']['EfectivoDisponible']), 2, '.', ','));?>
				<tr />
				<td />
				<td />
		</table>
<?php }?>




