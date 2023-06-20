<?php
$filter = 'city';
$filter = 'friends';
$filter = 'school';
$filter = 'employer';



$value = '107436315953233';
$arg_name = 'users_location';
$filters .='"';
$filters .=$filter;
$filters .='":"{\\"name\\":\\"';
$filters .=$arg_name;
$filters .='\\",\\"args\\":\\"';
$filters .=$value;
$filters .='\\"}"';


echo $filters;
$search_keyword = 'viktor';
$search_type = 'people';
$joined_filters .= '{';
$joined_filters .= $filters;
$joined_filters .= '}';
$encoded_filters = base64_encode($joined_filters);
$encoded_filters = str_replace('=', '', $encoded_filters);
echo ' '. $encoded_filters;
$search_url .= 'https://www.facebook.com/search/';
$search_url .=$search_type;
$search_url .='/?q=';
$search_url .= $search_keyword;
$search_url .= '&epa=FILTERS&filters=';
$search_url .= $encoded_filters;
echo ' '. $search_url;


