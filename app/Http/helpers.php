<?php
  function checkPermission($permissions){
    $userAccess = getMyPermission(auth()->user()->permission);
    foreach ($permissions as $key => $value) {
      if($value == $userAccess){
        return true;
      }
    }
    return false;
  }


  function getMyPermission($id)
  {
    switch ($id) {
      case 1:
        return 'banhang';
        break;
      case 2:
        return 'thukho';
        break;
      default:
        return 'quanly';
        break;
    }
  }


?>