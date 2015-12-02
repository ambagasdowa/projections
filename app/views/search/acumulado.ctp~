<?php
//   pr($acumulado['acumulateByAccountClass']);
// 	 pr($acumulado['totalByAccountWeek']);
?>
<?php
  /**
   * TODO=>make the detail by day and week
   * @package => flujo
   */
//   pr($acumulado['acumulateByRealms']);
?>
	  <table id="menu_info_small">
		<td style="text-align:center;font-weight:bold;font-variant:small-caps;"/>
			  <a class="show" href="#" onclick="Effect.toggle('AcumWeekly', 'appear'); return false;">
				  &#9660; Acumulado Semanal &#9660;
			  </a>
	  </table>

  <div id="AcumWeekly">
	<div id="carousel-wrapper_flujo">
	  <div id="carousel-content_flujo" >
	  
	  <?php
		foreach($acumulado['accountByWeek'] as $numWeek => $RealmsData){
	  ?>
		<div class="slide_flujo" >
<!-- 		code from hir -->

	  <?php
		foreach($RealmsData as $Realms => $Account){
	  ?>
		<table id="menu_info_small" >
	  <!-- 	<tr /> -->
	  <!-- 	  <td colspan="3"/>&nbsp; -->
		  <tr />
			<th style="font-weight:bolder;padding-left:12px;" colspan="4" /> 
				  Acumulado de <?php e($Realms);?> 
				  para la Semana <?php e($numWeek); ?> 
				  hasta el dia <?php e($acumulado['until'][$numWeek]);?>
				  de <?php e($acumulado['mes']);?> 
		  <tr />

		  <?php
			foreach($Account as $realmsClass => $accounts){
		  ?>
				<tr />
				  <td style="font-weight:bolder;padding-left:12px;" colspan="4" /><?php e($realmsClass);?>
		  <?php
			  foreach($accounts as $accountName => $accountValue){
		  ?>
				  <?php //pr($accounts);?>
				<tr />
				  <td style="background-color:white;" width="10%" colspan="2" />&nbsp;
				  <td style="background-color:white;" /><?php e($accountName);?>
				  <td style="font-weight:bolder;text-align:right;background-color:white;" />
						<?php 
						  if(!isset($accountValue)){
							e('$ '.number_format(money_format('%i','0'), 2, '.', ','));
						  }else{
							e('$ '.number_format(money_format('%i',$accountValue), 2, '.', ','));
						  }
						?>

		  <?php
			  }// end by accounts
		  ?>
				<tr style="border:none;"/>
				  <td width="5%" />&nbsp;
				  <td style="font-weight:bolder;padding-left:12px;" colspan="2" />
						Total <?php e($realmsClass);?>
				  <td style="font-weight:bolder;padding-left:12px;text-align:right;border-top:solid 1px;" >
						<?php 
						  if(!isset($acumulado['totalByAccountWeek'][$numWeek][$Realms][$realmsClass])){
							e('$ '.number_format(money_format('%i','0'), 2, '.', ','));
						  }else{
							e('$ '.number_format(money_format('%i',$acumulado['totalByAccountWeek'][$numWeek][$Realms][$realmsClass]), 2, '.', ','));
						  }
						?>
				<tr />
				  <td colspan="4" />&nbsp;
			  
		  <?php
			} // end foreach Account
		  ?>
		  <?php ?>
	  
		</table>
		

	  <?php
		} // RealmsData
	  ?>
	  <!-- 		  to hir -->
		</div> <!--end class slide-->
	  <?php
		} // End foreach => acumulado[accountByWeek]
	  ?>
	  </div>
	</div>
  

	  <script type="text/javascript">
	      new Carousel('carousel-wrapper_flujo',
			$$('#carousel-content_flujo .slide_flujo'),
			$$('a.carousel-control', 'a.carousel-jumper'),
			{
			transition: 'spring',
// 			selectedClassName:'carousel-jumper',
			effect: 'fade',
			duration: 0.4,
			wheel: false
			}
		  );
	 </script>
	  <div style="margin:10px;"></div>
		<a href="javascript:" class="carousel-control icon arrowright" rel="next" style="float: right">Siguiente</a>
		<a href="javascript:" class="carousel-control icon arrowleft" rel="prev">Anterior</a>
  </div> <!--end AcumWeekly-->
  
  
	  <div style="margin:10px;"></div>
<!--   a:link, a:hover, a:active and a:visited -->
<!-- <a href="#" class="button icon arrowright">Siguiente</a> -->
	  <style>
		  .linksToleft{
			text-align:left;
			font-weight:bold;
			border:solid 1px;
			margin-left:5px;
			background-color:white;
			padding:2px;
		  }
		  .show:link{
			color:black;
		  }
		  .show:hover{
			color:black;
		  }

	  </style>

	  
	  <table id="menu_info_small">
		<td style="text-align:center;font-weight:bold;font-variant:small-caps;"/>
			  <a class="show" href="#" onclick="Effect.toggle('appear', 'appear'); return false;">
				  &#9660; Acumulado Mensual &#9660;
			  </a>
	  </table>

	  <div id="appear" style="display:none;">
		  <?php
		  foreach($acumulado['acumulateByAccount'] as $Realms => $Account){
		  ?>
		<table id="menu_info_small" >
	  <!-- 	<tr /> -->
	  <!-- 	  <td colspan="3"/>&nbsp; -->
		  <tr />
			<th style="font-weight:bolder;padding-left:12px;" colspan="4" /> Acumulado mensual de <?php e($Realms);?> para el mes de <?php e($acumulado['mes']);?>
		  <tr />

		  <?php
			foreach($Account as $realms_class => $value){
		  ?>

		  <?php
			foreach($acumulado['acumulateByAccountClass'][$Realms][$realms_class] as $cuenta => $data){
		  ?>
			<tr />
			  <td width="5%" />&nbsp;
			  <td width="5%" />&nbsp;
			  <td style="font-weight:normal;" /><?php e($cuenta);?>
			  <td style="font-weight:bolder;text-align:right;" />
				<?php 
				  if(!isset($data)){
					e('$ '.number_format(money_format('%i','0'), 2, '.', ','));
				  }else{
					e('$ '.number_format(money_format('%i',$data), 2, '.', ','));
				  }
				?>
			<tr />
			  <td colspan="4" />
		  <?php
			}
		  ?>
		  <tr />
			  <td colspan="2" width="5%" />&nbsp;
	  <!-- 		<td  width="5%" />&nbsp; -->
			  <td style="font-weight:bold;" /><?php e($realms_class);?>
			  <td style="font-weight:bolder;text-align:right;" />
				<?php 
				  if(!isset($value)){
					e('$ '.number_format(money_format('%i','0'), 2, '.', ','));
				  }else{
					e('$ '.number_format(money_format('%i',$value), 2, '.', ','));
				  }
				?>
		  <tr />
			  <td colspan="4" width="5%" />&nbsp;
		  <?php
				}
		  ?>
		  <tr />
			<td style="font-weight:bold;" colspan="3" />Acumulado mensual de <?php e($Realms);?>
			<td style="font-weight:bolder;text-align:right;border-top:solid 1px;" /><?php e('$ '.number_format(money_format('%i',$acumulado['acumulateByRealms'][$Realms]), 2, '.', ','));?>
		</table>

		  <?php
			  }
		  ?>
		  
	  </div> <!--end of the appearDiv-->

	  <div style="margin:10px;"></div>

	  <table id="menu_info_small">
		<td style="text-align:center;font-weight:bold;font-variant:small-caps;"/>
			  <a class="show" href="#" onclick="Effect.toggle('SaldoDisp', 'appear'); return false;">
				  &#9660; Saldo Disponible por Semana &#9660;
			  </a>
	  </table>

	  <div id="SaldoDisp" style="display:none;">
		<table id="menu_info_small">
		<?php
		  foreach($acumulado['until'] as $week => $untilDate){
		?>
		  <tr />
			<td width="15%"/>Para la Semana
			<td width="5%" style="font-weight:bolder;" /><?php e($week);?>
	  <!-- 	<tr /> -->
			<td />Hasta el d&iacute;a
			<td style="font-weight:bolder;" /><?php e($untilDate);?> de <span><?php e($acumulado['mes']);?></span>
	  <!-- 	<tr /> -->
			<td />Saldo Disponible
			<td style="font-weight:bolder;text-align:right;" />
			  <?php
				  if(!isset($acumulado['acumByWeek'][$week])){
					e('$ '.number_format(money_format('%i','0'), 2, '.', ','));
				  }else{
					e('$ '.number_format(money_format('%i',$acumulado['acumByWeek'][$week]), 2, '.', ','));
				  }
			  ?>
		  <tr />
		<?php
		  }
		?>
		  <tr />
<!--			<td colspan="5" />Acumulado
			<td style="font-weight:bolder;text-align:right;" />--><?php //e('$ '.number_format(money_format('%i',$acumulado['acumulate']), 2, '.', ','));?>

		</table>
	  </div>

	  
	  <table id="menu_info_small">
		<td style="text-align:center;font-weight:bold;font-variant:small-caps;"/>
			  <a class="show" href="#" onclick="Effect.toggle('export', 'appear'); return false;">
				  &#9660; Exportar &#9660;
			  </a>
	  </table>
	  
	  <div id="export" style="display:none;">
<!-- 	  <div> -->
		  <?php
		      echo $this->Html->link( 
			   $this->Html->image("icons/excel_small.png",
			                array('alt' => "Exportar a una hoja de Excel",
								  'title' => 'Exportar a una hoja de Excel',
								  'width' => '22',
								  'height' => '22'
					)
			   ),
					array(
					  'controller'=>'search',
					  'action'=>'exportXlsAcum',
					  'Reporte de Flujo',
					  "CreacionReporteFlujo-".date('Y-m-d'),
					  "export_acumulado"
					) ,
					array('escape' => false),
					null
			);
		  ?>
	  </div>