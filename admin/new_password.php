<?php
    chdir('../');
    include_once 'functions/connect.php';
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $sql = "SELECT APELLYNOMBRE FROM personas WHERE `LEGAJO` = ?;";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('s', $_POST['legajo']);
        $stmt->execute();
        $stmt->bind_result($NOMBRE);
        $stmt->fetch();
        $stmt->close();
        if(!is_null($NOMBRE ))
        {
            $sql = "INSERT INTO `pass_reset_users` (`LEGAJO`) VALUES (?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('s', $_POST['legajo']);
            $stmt->execute();
            echo $NOMBRE;
        }
        exit(0);
    }else if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
        $keys = array_keys($_GET);
        foreach($keys as $k){
            list($a,$b) = preg_split("/_/",$k);
            if($a == 'legajo')
            {
                $sql = "DELETE FROM `pass_reset_users` WHERE `LEGAJO` = ?;";
                $stmt = $con->prepare($sql);
                $stmt->bind_param('s', $b);
                $stmt->execute();
            }
        }
        exit(0);
    }

    include 'head.php'; 
    include 'header.php'; 

    if(!$_SESSION['can-change-passwords'] || !$_SESSION['empleado'] || $_SESSION['NOMBREUSUARIO'] != '12005'){
        die('no permitido');
    }

    $sql = "SELECT Pa.LEGAJO, Pe.APELLYNOMBRE FROM pass_reset_users Pa, personas Pe WHERE Pa.LEGAJO = Pe.LEGAJO";

    $stmt = $con->prepare($sql);
    if ($stmt) {
        $stmt->execute();
        $stmt->store_result();		
        $allowedUsers = array();
        $stmt->bind_result($LEGAJO, $NOMBRE);
        while($stmt->fetch())
        {
            $allowedUsers[$LEGAJO] = $NOMBRE;
        }
    } else {
        $allowedUsers = array();
    }
?>
<div >

    <div class="container-login100">
        <input type="text" id="legajo"  style="border: 2px solid black; border-radius: 4px;">
        <input type="button" id="add" value="add" onclick="addLegajo()" />
    </div>
    <div class="container-login100" id="legajosList">
    <?php foreach($allowedUsers as $legajo => $nombre) {?>
    <div id="legajo_<?php echo $legajo ;?>" title="<?php echo $nombre?>"><?php echo $legajo;?><input type='button' value="(X)" onclick="remove('legajo_<?php echo $legajo;?>');" /></div>
    <?php } ?>
    </div>

</div>
<script>
    var apiUrl = '<?php echo $_SERVER['REQUEST_URI'] ?>';
    function remove(legajo)
    {
        $.ajax({
        url: apiUrl + '?' + legajo,
        type: 'DELETE',
        success: function(result) {
          $('#'+ legajo).remove();
        }});
        return false;
    }

    function addLegajo()
    {
        var legajo=$('#legajo').val();
        $('#legajo').val('');
        if(legajo == '') return false;
        $.post(apiUrl, {legajo: legajo},function(response){
            var newdiv1 = $( "<div id='legajo_"+legajo+"' title='"+response+"'>"+legajo+"<input type='button' value='(X)' onclick=\"remove(\'legajo_"+legajo+"');\" /></div>" );
            $('#legajosList').append(newdiv1);
        });
        return false;
    }

</script>
<?php include 'footer.php'; ?>
</body>
</html>