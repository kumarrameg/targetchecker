

<?php
error_reporting(E_ERROR | E_PARSE);
if (isset($_POST["submit-btn"]))
{
    
    $profitLossAmount=0;
    $afteraddchar= preg_replace('/^/m', '!', $_POST["signalresults"]);
    $oneDArray = array_filter(explode('!', $afteraddchar));
    $twoDArray = [];
    $lossandprviouscanldeArray = [];

    foreach ($oneDArray as $singlePairResult)
    {
        array_push($twoDArray, array_filter(explode(' ', $singlePairResult)));

    }
    
echo '<div id="sample">';
    foreach ($twoDArray as $singlePairResult)
    {

     
      if($singlePairResult[3]=='⛔' || $singlePairResult[3]== '⛔️' || $singlePairResult[3]== 'DOJI'){
        
        
          $profitLossAmount=$profitLossAmount-10;      
          $singlePairResult['target'] =$profitLossAmount;
        }
        
        else if($singlePairResult[3]=='✅' || $singlePairResult[3]== '✅'){
          $profitLossAmount=$profitLossAmount+8.5;
          $singlePairResult['target'] =$profitLossAmount;
        }else{
          continue;
        }
      
        echo "<br>";
        echo $singlePairResult[0].' '.$singlePairResult[1].' '.$singlePairResult[3];
        if($singlePairResult['target'] < 1){          
          echo '= <strong class="red-color"> '.$singlePairResult['target'].'</strong>';
        }else if($singlePairResult['target'] > 50){
          echo '= <strong class="green-color"> '.$singlePairResult['target'].'</strong>';
        }
        else{
          echo '= <strong > '.$singlePairResult['target'].'</strong>';
        }
        
        

    }

     echo '</div>';
    

} ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>BACKTEST</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
      .red-color{
        color:red;
      }
      .green-color{
        color:green;
      }
      .btn {
            text-decoration: none;
            border: none;
            padding: 12px 40px;
            font-size: 16px;
            background-color: green;
            color: #fff;
            border-radius: 5px;
            box-shadow: 7px 6px 28px 1px rgba(0, 0, 0, 0.24);
            cursor: pointer;
            outline: none;
            transition: 0.2s all;
        }
        /* Adding transformation when the button is active */
          
        .btn:active {
            transform: scale(0.98);
            /* Scaling button to 0.98 to its original size */
            box-shadow: 3px 2px 22px 1px rgba(0, 0, 0, 0.24);
            /* Lowering the shadow */
        }
    </style>
  </head>
  <body>
    <br>
  <a class='btn' href="#" onclick="CopyToClipboard('sample');return false;">Copy To Clipboard</a>
    <div class="container">
      <br>
      <br>
      <!-- <a href="dashboard.php" class="btn btn-danger" role="button">Details Results</a> -->
      <!-- <h2>HERE YOU NEED TOO PASTE A SIGNAL FROM DB FORMAT SHOUD BE'!11:45 USDCHF-OTC CALL ✅ ¹ ' IT WILL SORT LOSS SIGNAL AND SUBTRACT 5MIN FROM IT .</h2> -->
      <br>
      <br>
      <form method="post">
        <div class="form-group">
          <!-- <input type="date" name="currentdate"> -->
        </div>
        <div class="form-group">
          <textarea class="form-control" name="signalresults" rows="21" id="comment"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="submit-btn" value="submit">Submit</button>
      </form>
    </div>
  </body>

  <script>
function CopyToClipboard(id)
{
var r = document.createRange();
r.selectNode(document.getElementById(id));
window.getSelection().removeAllRanges();
window.getSelection().addRange(r);
document.execCommand('copy');
window.getSelection().removeAllRanges();
}
</script>

</html>