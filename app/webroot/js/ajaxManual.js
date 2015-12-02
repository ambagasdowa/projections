function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined')
        {
            xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function generaRFC()
{
    if(
        document.getElementById('FCN_EMP').value.length == 10 &&
        document.getElementById('APM_EMP').value.length > 2 &&
        document.getElementById('NOM_EMP').value.length > 2
      )
    {
        divResultado = document.getElementById('divRFC');
        apaterno = document.getElementById('APP_EMP').value;
        amaterno = document.getElementById('APM_EMP').value;
        nombre = document.getElementById('NOM_EMP').value;
        edad = document.getElementById('FCN_EMP').value;

        fecha = document.getElementById('FCN_EMP').value;
        fecha = fecha.replace("-", "");  
        fecha = fecha.replace("-", "");  
        ajax=objetoAjax();
        ajax.open("POST", "../empleados/rfc",true);
        ajax.onreadystatechange=function()
        {
            if (ajax.readyState==4)
            {
                divResultado.innerHTML = ajax.responseText;
            }
        }
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=utf-8");
        ajax.send("fecha="+fecha+"&nombre="+nombre+"&apaterno="+apaterno+"&amaterno="+amaterno+"&edad="+edad);
    }
}

function calculaEdad()
{
    divResultado = document.getElementById('divEdad');
    edad = document.getElementById('FCN_EMP').value;
    ajax=objetoAjax();
    ajax.open("POST", "../empleados/edad",true);
    ajax.onreadystatechange=function()
    {
        if (ajax.readyState==4)
        {
            divResultado.innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=utf-8");
    ajax.send("edad="+edad);
}

function soloNumeros(evt)
{
    if(document.getElementById('num_emp').checked==true)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if(charCode > 31 && (charCode < 45 || charCode >57))
        {
            return false;

        }else{
                return true;
             }
    }
}

function calculaHomoClv()
{
    divResultado = document.getElementById('divHCLV');
    fecha = document.getElementById('FCN_EMP').value;
    nombreCompleto= document.getElementById('APP_EMP').value+' '+document.getElementById('APM_EMP').value+' '+document.getElementById('NOM_EMP').value;
    rfc = document.getElementById('RFC_EMP').value;
    ajax=objetoAjax();
    ajax.open("POST", "../empleados/homoclv",true);
    ajax.onreadystatechange=function()
    {
        if (ajax.readyState==4)
        {
            divResultado.innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=utf-8");
    ajax.send("nombre="+nombreCompleto+"&fecha="+fecha+"&rfc="+rfc);
}

function calculaCURP()
{
    
    divResultado = document.getElementById('divCURP');
    fecha = document.getElementById('FCN_EMP').value;
    
    apaterno= document.getElementById('APP_EMP').value;
    
    amaterno = document.getElementById('APM_EMP').value;
    
    nombre = document.getElementById('NOM_EMP').value;
    
    entidad = document.getElementById('EDO_EMP').value;
   
    genero = document.getElementById('SEX_EMP').value;
     
    ajax=objetoAjax();
    ajax.open("POST", "../empleados/curp",true);
    ajax.onreadystatechange=function()
    {
        if (ajax.readyState==4)
        {
            divResultado.innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=utf-8");
    ajax.send("apaterno="+apaterno+"&amaterno="+amaterno+"&nombre="+nombre+"&fecha="+fecha+"&entidad="+entidad+"&genero="+genero);
}


function jsClock24hr(){
  var time = new Date()
  var hour = time.getHours()
  var minute = time.getMinutes()
  var second = time.getSeconds()
  var temp = "" + ((hour < 10) ? "0" : "") + hour
  temp += ((minute < 10) ? ":0" : ":") + minute
  temp += ((second < 10) ? ":0" : ":") + second
  document.clockForm24hr.digits.value = temp
  id = setTimeout("jsClock24hr()",1000)
}
