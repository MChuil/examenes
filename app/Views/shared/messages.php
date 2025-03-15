<?php if ($msg = session()->getFlashdata('success')) { ?>
    <div class="alert alert-success">
        <?php
        if (is_array($msg)) { //es un array
            echo implode('<br>', $msg);
        } else { //si no es array
            echo $msg;
        }
        ?>
    </div>
<?php } ?>

<?php if ($msg = session()->getFlashdata('error')) { ?>
    <div class="alert alert-error">
        <?php
        if (is_array($msg)) { //es un array
            echo implode('<br>', $msg);
        } else { //si no es array
            echo $msg;
        }
        ?>
    </div>
<?php } ?>


<?php if ($errors = session()->getFlashdata('errors')) { ?>
    <div class="alert alert-danger">
        <?php
        if (is_array($errors)) { 
            echo implode('<br>', $errors);
        } else { 
            echo $errors;
        }
        ?>
    </div>
<?php } ?>