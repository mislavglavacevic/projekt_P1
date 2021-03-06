<?php
     
    require 'baza.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $imeError = null;
        $prezimeError = null;
        $terenError = null;
         
        // keep track post values
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $teren = $_POST['teren'];
         
        // validate input
        $valid = true;
        if (empty($ime)) {
            $imeError = 'Unesite ime!';
            $valid = false;
        }
         
        if (empty($prezime)) {
            $prezimeError = 'Unesite prezime!';
            $valid = false;
        }
        
        if (empty($teren)) {
            $terenError = 'Unesite teren!';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Baza::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO rezervacija (ime,prezime,teren) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($ime,$prezime,$teren));
            Baza::disconnect();
            header("Location: index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Unos</h3>
                    </div>
             
                    <form class="form-horizontal" action="create.php" method="post">
                      <div class="control-group <?php echo !empty($imeError)?'error':'';?>">
                        <label class="control-label">Ime</label>
                        <div class="controls">
                            <input name="ime" type="text"  placeholder="ime" value="<?php echo !empty($ime)?$ime:'';?>">
                            <?php if (!empty($imeError)): ?>
                                <span class="help-inline"><?php echo $imeError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($prezimeError)?'error':'';?>">
                        <label class="control-label">Prezime</label>
                        <div class="controls">
                            <input name="prezime" type="text" placeholder="prezime" value="<?php echo !empty($prezime)?$prezime:'';?>">
                            <?php if (!empty($prezimeError)): ?>
                                <span class="help-inline"><?php echo $prezimeError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($prezimeError)?'error':'';?>">
                        <label class="control-label">Teren</label>
                        <div class="controls">
                            <input name="teren" type="text" placeholder="teren" value="<?php echo !empty($teren)?$teren:'';?>">
                            <?php if (!empty($terenError)): ?>
                                <span class="help-inline"><?php echo $terenError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Unesi</button>
                          <a class="btn" href="index.php">Nazad</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
