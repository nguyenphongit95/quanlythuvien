<?php

include 'config/configuration.php';

function get_base_url() {
   if(BASE_URL) {
       return BASE_URL;
   }
   return '';
}