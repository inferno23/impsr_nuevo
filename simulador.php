 <div id="sidebar-second" class="sidebar">
            <div class="region region-sidebar-second">
    <div id="block-block-2" class="block block-block clearfix">

    <h2 class="title">Calculadora de Créditos</h2>
  
  <div class="content">
    <form name="credi">

<script>
function calc_cuota(){
	v_monto=document.credi.monto.value;
	v_cuotas=document.credi.cant.value;
	ban=0;
 
 switch (v_cuotas){
 	case '4':
 	     if (v_monto < 25100){
 	     	ban=1;
 	     }else{
 	        ban=0
			window.alert("Error: para " + v_cuotas + " cuotas el monto debe ser entre $ 5.000 y $ 25.000");
 	     }
 	     break;
 	        
 	case  '10':
 	     if (v_monto > 4900 && v_monto < 60100) {
 	     	ban=1;
 	     }else{
 	        ban=0;
 	        window.alert("Error: para " + v_cuotas + " cuotas el monto debe ser entre $ 5.000 y $ 60.000");
 	     }
 	     break;
 	case  '12':
 	     if (v_monto > 4900 && v_monto <  100000) {
 	     	ban=1;
 	     }else{
 	        ban=0;
 	        window.alert("Error: para " + v_cuotas + " cuotas el monto debe ser entre $ 5.000 y $ 230.000");
 	     }
 	     break;

    case  '18':
 	     if (v_monto > 4900 && v_monto < 100100) {
 	     	ban=1;
 	     }else{
 	        ban=0;
 	        window.alert("Error: para " + v_cuotas + " cuotas el monto debe ser entre $ 5.000 y $ 230.000");
 	     }
 	     break;
	case  '24':
 	     if (v_monto > 9900) {
 	     	ban=1;
 	     }else{
 	        ban=0;
 	        window.alert("Error: para " + v_cuotas + " cuotas el monto debe ser entre $ 10.000 y $ 230.000");
 	     }
 	     break;
case  '30':
 	     if (v_monto > 60000) {
 	     	ban=1;
 	     }else{
 	        ban=0;
 	        window.alert("Error: para " + v_cuotas + " cuotas el monto debe ser entre $ 61.000 y $ 230.000");
 	     }
 	     break;
        
       
}

if (ban==1){
          valor_cuota=((3.20*v_cuotas/100+1)*(v_monto))/(v_cuotas);
	      redon=valor_cuota-parseInt(valor_cuota);
	         if (redon==0){decimal="0000";
                           }else{decimal=String(redon);
             }
    	   val_cuota=parseInt(valor_cuota)+"."+decimal.substring(2,4);
    	   document.credi.importe.value=val_cuota;
}else{
     document.credi.importe.value=0;
     }
}




</script>
<table border="2">
	<tbody>
		<tr>
			<td colspan="2" style="background-color:#B6CFE6; text-align:center";font-weight:bold;"><strong>Cálculo Cuota Créditos</strong></td>
		</tr>
		<tr>
			<td align="left" style="background-color:#7CAFD3"><strong>Monto</strong></td>
			<td align="right"style="background-color:#7CAFD3">
<script>
   document.write('<select name="monto" style="text-align:right;;font-weight:bold;">');
	 m=5000;
	 while(m<=100000){
	   opt="<option value="+m+">"+m;
		 document.write(opt);
     m=m+500;
	 }
  document.write('</select>');	 
</script>
                         </td>
		</tr>
		<tr>
			<td style="background-color:#7CAFD3;"><strong>Cuotas</strong></td>
			<td align="right"style="background-color:#7CAFD3"><select name="cant"  style="text-align:center;color:#663300;font-weight:bold;">
  <option value="4">04
  <option value="10">10
  <option value="12">12
  <option value="18">18
  <option value="24">24
  <option value="30">30
  
</select></td>
		</tr>
		<tr>
			<td align="left" style="background-color:#7CAFD3;"><strong>Importe</strong></td>
			<td align="right" style="background-color:#7CAFD3"><input type="text" name="importe" value="0" style="text-align:right;color:#005F1C;font-weight:bold;" size="10"></td>
		</tr>
		<tr>
			<td colspan="2" style="background-color:#B6CFE6;" align="center"><input type="button"  value="Calcular" onClick="calc_cuota()"></td>
		</tr>
	</tbody>
</table>
  </div>
</div>
  </div>
        </div>
      
    </div> <!-- /#container -->
  </div> <!-- /#wrapper -->
  </body>
</html>
