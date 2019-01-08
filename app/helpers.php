<?php


function file_found($file = null)
{
    return $file && is_file('uploads/' . $file) ? true : false;
}

function image($image = null)
{
    return file_found($image) ? $image : 'no-photo.jpg';
}

function unique_file($fileName)
{
    $fileName = str_replace(' ', '-', $fileName);
    return time() . uniqid().'-'.$fileName;
}

function success()
{
   return 'success';
}


function not_active()
{
   return 'not_active';
}


function error()
{
   return 'error';
}


function failed()
{
   return 'failed';
}


function msg($request,$status,$key)
{
   $msg['status'] = $status;
   $msg['msg'] = Config::get('response.'.$key.'.'.$request->header('language'));

   return $msg;
}

