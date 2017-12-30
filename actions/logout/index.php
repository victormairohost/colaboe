<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

setcookie("ginvest", "", time()-10000000, '/');
setcookie("ginvestid", "", time()-10000000, '/');
header("Location: https://".$_SERVER['HTTP_HOST']);
