<?php
	//CostoFijoDetail
?> 

	<table id="dateBottom">
	<tr />
		<td colspan="2" />Costos Fijos Detalle <?php e($costoDetailMes);?>
	</table>

<!-- 	<table id="<?php e(idTotalIndex);?>"> -->
	<table id="menu_info_small" >
		<th />Mes
		<th />Numero de Cuenta
		<th />Nombre de Cuenta
		<th />Cargo
		<th />Abono
		<th />Presupuesto
<?php foreach($costoDetail as $mssqlFetchMonth){?>
		<?php foreach($mssqlFetchMonth as $accountName => $mssqlFetch){?>
			<tr />
			<td /><?php e($mssqlFetch['Mes']);?>
			<td /><?php e($mssqlFetch['NoCta']);?>
			<td /><?php e($mssqlFetch['NombreCta']);?>
			<td /><?php e($mssqlFetch['Cargo']);?>
			<td /><?php e($mssqlFetch['Abono']);?>
			<td /><?php e($mssqlFetch['Presupuesto']);?>
		<?php }?>

<?php }?>
	</table>