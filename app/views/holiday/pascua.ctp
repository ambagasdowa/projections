<?php ?>
<center>
<h1>Calcular Pascua:</h1>
<form action="index.php" name="forma" method="post">
<font face="Arial, Helvetica, sans-serif" size="2">
Año: <input type="text" name="anno" size="5" maxlength="4" 
     value="<?php if(intval($_POST['anno']) > 0){ echo intval($_POST['anno']); }else{ echo date("Y"); }?>">
<input type="submit" name="Go!" value="Calcular!">
</font>
</form>
</center>
<?php
#ejecutarlo pasando el año como parámetro.
if (isset($_POST['anno'])) {
	$fecha = explode('-',pascua($_POST['anno']));
?><br />
<div align=center><font face=arial>
La pascua (domingo de resurrección) 
en el año introducido es el: 
<strong><?php echo $fecha[0]; ?> de <?php echo mesespanol($fecha[1]); ?> de <?php echo $fecha[2]; ?></strong><br /><br />
<br />
<table width="400" cellspacing="0" cellpadding="0" style="margin:0px auto;">
        <tr>
          <td colspan="3" align="center"><strong>Fechas especiales:</strong></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr bgcolor="#CCCCCC">
          <td align="left"><strong><font face="arial">Celebracion</font></strong></td>
          <td align="center"><strong>Dia</strong></td>
          <td align="center"><strong>Fecha</strong></td>
        </tr>
        <tr>
          <td align="left"><strong>Domingo de Pascua</strong></td>
          <td align="center"><?php echo diaespanol(date("N", mktime(0,0,0,$fecha[1],$fecha[0],$fecha[2]))); ?></td>
          <td align="center"><?php echo date("d/m/Y", mktime(0,0,0,$fecha[1],$fecha[0],$fecha[2])); ?></td>
        </tr>
        <tr>
          <td align="left">Mi&eacute;rcoles    de ceniza</td>
          <td align="center"><?php echo diaespanol(date("N", mktime(0,0,0,$fecha[1],$fecha[0]-46,$fecha[2]))); ?></td>
          <td align="center"><?php echo date("d/m/Y", mktime(0,0,0,$fecha[1],$fecha[0]-46,$fecha[2])); ?></td>
        </tr>
        <tr>
          <td align="left">Domingo de Ramos</td>
          <td align="center"><?php echo diaespanol(date("N", mktime(0,0,0,$fecha[1],$fecha[0]-7,$fecha[2]))); ?></td>
          <td align="center"><?php echo date("d/m/Y", mktime(0,0,0,$fecha[1],$fecha[0]-7,$fecha[2])); ?></td>
        </tr>
        <tr>
          <td align="left"><strong>Jueves Santo</strong></td>
          <td align="center"><?php echo diaespanol(date("N", mktime(0,0,0,$fecha[1],$fecha[0]-3,$fecha[2]))); ?></td>
          <td align="center"><?php echo date("d/m/Y", mktime(0,0,0,$fecha[1],$fecha[0]-3,$fecha[2])); ?></td>
        </tr>
        <tr>
          <td align="left"><strong>Viernes Santo</strong></td>
          <td align="center"><?php echo diaespanol(date("N", mktime(0,0,0,$fecha[1],$fecha[0]-2,$fecha[2]))); ?></td>
          <td align="center"><?php echo date("d/m/Y", mktime(0,0,0,$fecha[1],$fecha[0]-2,$fecha[2])); ?></td>
        </tr>
        <tr>
          <td align="left">Ascensi&oacute;n</td>
          <td align="center"><?php echo diaespanol(date("N", mktime(0,0,0,$fecha[1],$fecha[0]+39,$fecha[2]))); ?></td>
          <td align="center"><?php echo date("d/m/Y", mktime(0,0,0,$fecha[1],$fecha[0]+39,$fecha[2])); ?></td>
        </tr>
        <tr>
          <td align="left">Pentecost&eacute;s</td>
          <td align="center"><?php echo diaespanol(date("N", mktime(0,0,0,$fecha[1],$fecha[0]+49,$fecha[2]))); ?></td>
          <td align="center"><?php echo date("d/m/Y", mktime(0,0,0,$fecha[1],$fecha[0]+49,$fecha[2])); ?></td>
        </tr>
        <tr>
          <td align="left">Sant&iacute;sima Trinidad</td>
          <td align="center"><?php echo diaespanol(date("N", mktime(0,0,0,$fecha[1],$fecha[0]+56,$fecha[2]))); ?></td>
          <td align="center"><?php echo date("d/m/Y", mktime(0,0,0,$fecha[1],$fecha[0]+56,$fecha[2])); ?></td>
        </tr>
        <tr>
          <td align="left">Corpus Christi</td>
          <td align="center"><?php echo diaespanol(date("N", mktime(0,0,0,$fecha[1],$fecha[0]+60,$fecha[2]))); ?></td>
          <td align="center"><?php echo date("d/m/Y", mktime(0,0,0,$fecha[1],$fecha[0]+60,$fecha[2])); ?></td>
        </tr>
</table>
<br />
</font></div>
<?php }?>
</div>