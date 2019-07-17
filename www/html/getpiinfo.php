    
<style type="text/css">
.labelwidth {
  width: 100px;
}
</style>
    <?php
      exec("free -h | grep Mem | awk '{print $3s}'", $output);
  foreach ($output as $key => $value) {
    $memfree = $value;
  };
  $output="";
  exec("free -h | grep Mem | awk '{print $2s}'", $output);
  foreach ($output as $key => $value) {
    $memtotal = $value;
  };
  $output="";
  exec("df -h | grep root | awk '{print $4}'", $output);
  foreach ($output as $key => $value) {
    $diskfree = $value;
  };
  $output="";
  exec("df -h | grep root | awk '{print $2}'", $output);
  foreach ($output as $key => $value) {
    $totaldisk = $value;
  };

// $memfree = 10;
// $memtotal = 20;
// $diskfree = 30;
// $totaldisk = 100;

  
// print '

  
//   <div class="col-sm-12" style="padding-top:4px;">
//     <div class="input-group mb-1">
//       <div class="input-group-prepend">
//         <span class="input-group-text bg-dark text-light labelwidth" id="inputGroup-sizing-default">Ram</span>
//       </div>
//       <div class="form-control">'.$memfree.'/'.$memtotal.'  </div>  
//     </div>

//     <div class="input-group mb-1">
//       <div class="input-group-prepend">
//         <span class="input-group-text bg-dark text-light labelwidth" id="inputGroup-sizing-default">Disk</span>
//       </div>
//       <div class="form-control">'.$diskfree.'/'.$totaldisk.'</div>  
//     </div>
  
//     <div class="input-group mb-1">
//       <div class="input-group-prepend">
//         <span class="input-group-text bg-dark text-light labelwidth" id="inputGroup-sizing-default">IP Add</span>
//       </div>
//       <div class="form-control">'.'192.168.0.1'.'</div>  
//     </div>
//   </div>



// ';

print '
<div class="row">
  <div class="col-sm-4">'.'Ram Free: '.$memfree.'MB of '.$memtotal.'MB</div>
  <div class="col-sm-4">'.'Disk Free: '.$diskfree.' of '.$totaldisk.'</div>
  <div class="col-sm-4">'.'IP Address: '.$_SERVER['SERVER_ADDR'].'</div>
</div>

';

// $_SERVER['SERVER_ADDR']
  ?>
<div class="row">
  <div class="col-sm-4"></div>
  <div class="col-sm-4"></div>
  <div class="col-sm-4"></div>
</div>