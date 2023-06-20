<?php
include_once('inc/init.php');
require_once('inc/db.php');
require_once('function/function.php');
$lang = $_SESSION['lang'] . '.php';
require_once($lang);
?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <!-- Required meta tags -->
    <?php
    require_once('inc/meta.php');
    ?>
    <title>FB Combo Search</title>
    <script type="text/javascript">

        var search_types = ['top', 'videos', 'posts', 'people', 'photos', 'pages', 'places', 'events'];
        var filters = []

        function clear_filters() {
            filters = [];
            document.getElementById('current-filters').innerHTML = '';
            var elements = document.getElementsByTagName("input");
            for (var ii = 0; ii < elements.length; ii++) {
                if (elements[ii].type == "text") {
                    elements[ii].value = "";
                }
            }
        }

        function make_url() {

            search_keyword = document.getElementById("search_keyword").value;
            search_type = document.getElementById('select_search_type').value;

            if (search_types.indexOf(search_type) < 0) {

                alert('Search type ' + search_type + ' not existing');
                return;
            }
            if (!search_keyword) {
                search_keyword = '*';
            }

            joined_filters = '{' + filters.join() + '}';
            encoded_filters = btoa(joined_filters).replace('=', '');
            var search_url = 'https://www.facebook.com/search/' + search_type + '/?q=';

            search_url += search_keyword + '&epa=FILTERS&filters=' + encoded_filters;
            return search_url;
        }

        function add_filter(obj, arg_name) {

            var filter_name = obj.className;
            var value_field = filter_name + '-' + arg_name;
            arg_value = document.getElementsByClassName(value_field);
            var value = '';
            for (i = 0; i < arg_value.length; i++) {
                if (arg_value[i].value) {
                    value = arg_value[i].value;
                    break;
                }
            }
            console.log(value);
            filters.push('"' + filter_name + '":"{\\"name\\":\\"' + arg_name + '\\",\\"args\\":\\"' + value + '\\"}"');
            filters_div = document.getElementById('current-filters');
            filters_div.innerHTML += '<li><b>' + filter_name + '</b> { ' + arg_name + ' : ' + value + '}</li>';
        }

        function add_date_filter() {

            // get user values
            start_year = document.getElementById('start_year').value;
            start_month = start_year + '-' + document.getElementById('start_month').value;
            start_day = start_month + '-' + document.getElementById('start_day').value;

            end_year = document.getElementById('end_year').value;
            end_month = end_year + '-' + document.getElementById('end_month').value;
            end_day = end_month + '-' + document.getElementById('end_day').value;

            search_type = document.getElementById('select_search_type').value;

            console.log('a' + start_year);
            console.log('b' + start_month);
            console.log('c' + start_day);


            if (search_type == 'events') {

                date_interval = start_day + '~' + end_day;
                console.log(date_interval);
                filter = '"rp_events_date":"{\\"name\\":\\"filter_events_date\\",\\"args\\":\\"' + date_interval + '\\"}"';
                filters_div = document.getElementById('current-filters');
                filters_div.innerHTML += '<li><b> rp_events_date </b> {"name":"filter_events_date","args":"' + date_interval + '"}</li>';

            } else {

                filter = '"rp_creation_time":"{\\"name\\":\\"creation_time\\",\\"args\\":\\"{\\\\\\"start_year\\\\\\":\\\\\\"' + start_year + '\\\\\\",\\\\\\"start_month\\\\\\":\\\\\\"' + start_month + '\\\\\\",\\\\\\"end_year\\\\\\":\\\\\\"' + end_year + '\\\\\\",\\\\\\"end_month\\\\\\":\\\\\\"' + end_month + '\\\\\\",\\\\\\"start_day\\\\\\":\\\\\\"' + start_day + '\\\\\\",\\\\\\"end_day\\\\\\":\\\\\\"' + end_day + '\\\\\\"}\\"}"';
                filters_div = document.getElementById('current-filters');
                filters_div.innerHTML += '<li><b> rp_creation_time </b> {"start_year":"' + start_year + '","start_month":"' + start_month + '","end_year":"' + end_year + '","end_month":"' + end_month + '","start_day":"' + start_day + '","end_day":"' + end_day + '"}</li>';
            }

            filters.push(filter);
        }

        function show_only(obj) {

            divsToHide = document.getElementsByClassName("search_category");
            for (var i = 0; i < divsToHide.length; i++) {
                divsToHide[i].style.display = "none";
            }
            document.getElementById(obj.value).style.display = 'block';
            document.getElementById("filter-keywords").style.display = 'block';
            document.getElementById("filter-dates").style.display = 'block';
            document.getElementById("final-buttons").style.display = 'block';
            document.getElementById("current-filters").style.display = 'block';
            clear_filters();
        }

    </script>
</head>
<body>
<?php

require_once 'inc/header.php'

?>

<body>
<main class="container-fluid ">

    <div class="row justify-content-md-center">

        <div class="col-6 text-center">

            <div  id="main">

                <div>
                    <h2>Search</h2>
                    <p>What do you want to search:
                        <select  name="search_type"  id="select_search_type"  onchange="show_only(this)">
                            <option  disabled="disabled"  selected="selected"  value=""> --
                                select a search type -- </option>
                            <option  class=""  value="posts">Posts</option>
                            <option  class=""  value="people">People</option>
                            <option  class=""  value="photos">Photos</option>
                            <option  class=""  value="pages">Pages</option>
                            <option  class=""  value="places">Places</option>
                            <option  class=""  value="videos">Videos</option>
                            <option  class=""  value="events">Events</option>
                            <option  class=""  value="top">Top</option>
                        </select>

                </div>
                <div  id="posts"  class="search_category">
                    <h2>Search Posts</h2>
                    <table>
                        <tbody>
                        <tr>
                            <td> Sort by most recent</td>
                            <td> <input  class="rp_chrono_sort-chronosort"  name="chronosort"
                                         placeholder="Entity id"
                                         value=""
                                         type="hidden">
                            </td>
                            <td> <input  class="rp_chrono_sort"  name="rp_chrono_sort-chronosort"
                                         onclick="add_filter(this,'chronosort')"
                                         value="add filter"
                                         type="submit">
                            </td></tr>
                        <tr><td>
                                Posts from public (needs a keyword):</td><td>
                                <input  class="rp_author-merged_public_posts"  name="merged_public_posts"  type="hidden"></td>
                            <td>
                                <input  class="rp_author"  name="rp_author-merged_public_posts"  onclick="add_filter(this,'merged_public_posts')"
                                        value="add filter"
                                        type="submit">
                            </td></tr>
                        <tr><td>
                                Posts from
                                Posts from specific entity (i.e.: page/user):</td><td>
                                <input  class="rp_author-author"  name="author"  placeholder="Entity id"  type="text"></td>
                            <td>
                                <input  class="rp_author"  name="rp_author-author"  onclick="add_filter(this,'author')"
                                        value="add filter"
                                        type="submit">
                            </td></tr>
                        <tr><td>
                                Restrict to posts published in group</td><td>
                                <input  class="rp_group-group_posts"  name="group_posts"  placeholder="Entity id"
                                        type="text"></td>
                            <td>
                                <input  class="rp_group"  name="rp_group-group_posts"  onclick="add_filter(this,'group_posts')"
                                        value="add filter"
                                        type="submit">
                            </td></tr>
                        <tr><td>
                                Tagged with location</td><td>
                                <input  class="rp_location-location"  name="location"  placeholder="Entity id"
                                        type="text"></td>
                            <td>
                                <input  class="rp_location"  name="rp_location-location"  onclick="add_filter(this,'location')"
                                        value="add filter"
                                        type="submit">
                            </td></tr>
                        </tbody></table>
                </div>






                <div  id="top"  class="search_category">

                    <h2>Search Top Elements</h2>

                    <table>
                        <tbody><tr><td>
                                Sort by most recent
                                <input  class="rp_chrono_sort-chronosort"  name="chronosort"  placeholder="Entity id"
                                        value=""
                                        type="hidden"></td><td></td><td>
                                <input  class="rp_chrono_sort"  name="rp_chrono_sort-chronosort"  onclick="add_filter(this,'chronosort')"
                                        value="add filter"
                                        type="submit">
                            </td></tr>

                        <tr><td>
                                Posts from specific entity (i.e.: page/user):</td><td>
                                <input  class="rp_author-author"  name="author"  placeholder="Entity id"  type="text"></td><td>
                                <input  class="rp_author"  name="rp_author-author"  onclick="add_filter(this,'author')"
                                        value="add filter"
                                        type="submit">
                            </td></tr>
                        <tr><td>
                                Posts from public (needs a keyword):</td><td>
                                <input  class="rp_author-merged_public_posts"  name="merged_public_posts"  type="hidden"></td><td>
                                <input  class="rp_author"  name="rp_author-merged_public_posts"  onclick="add_filter(this,'merged_public_posts')"
                                        value="add filter"
                                        type="submit"></td></tr>

                        <tr><td>
                                Restrict to posts published in group</td><td>
                                <input  class="rp_group-group_posts"  name="group_posts"  placeholder="Entity id"
                                        type="text"></td>
                            <td>
                                <input  class="rp_group"  name="rp_group-group_posts"  onclick="add_filter(this,'group_posts')"
                                        value="add filter"
                                        type="submit">
                            </td></tr>

                        <tr><td>
                                Tagged with location</td><td>
                                <input  class="rp_location-location"  name="location"  placeholder="Entity id"
                                        type="text"></td>
                            <td>
                                <input  class="rp_location"  name="rp_location-location"  onclick="add_filter(this,'location')"
                                        value="add filter"
                                        type="submit">
                            </td></tr>
                        </tbody></table>

                </div>










                <div  id="people"  class="search_category">

                    <h2>Search People</h2>
                    <table>
                        <tbody><tr><td>
                                City</td><td>
                                <input  class="city-users_location"  name="users_location"  placeholder="Entity id"
                                        value=""
                                        type="text"></td><td>
                                <input  class="city"  name="city-chronosort"  onclick="add_filter(this,'users_location')"
                                        value="add filter"
                                        type="submit">
                            </td></tr>

                        <tr><td>
                                School</td><td>
                                <input  class="school-users_school"  name="users_school"  placeholder="Entity id"
                                        value=""
                                        type="text"></td><td>
                                <input  class="school"  name="school-users_school"  onclick="add_filter(this,'users_school')"
                                        value="add filter"
                                        type="submit">
                            </td></tr>

                        <tr><td>
                                Employer</td><td>
                                <input  class="employer-users_employer"  name="users_employer"  placeholder="Entity id"
                                        value=""
                                        type="text"></td><td>
                                <input  class="employer"  name="employer-users_employer"  onclick="add_filter(this,'users_employer')"
                                        value="add filter"
                                        type="submit">
                            </td></tr>

                        <tr><td>
                                Friends with</td><td>
                                <input  class="friends-users_friends_of_people"  name="users_friends_of_people"
                                        placeholder="Entity id"
                                        value=""
                                        type="text"></td><td>
                                <input  class="friends"  name="friends-users_friends_of_people"  onclick="add_filter(this,'users_friends_of_people')"
                                        value="add filter"
                                        type="submit">
                            </td></tr>
                        </tbody></table>
                </div>







                <div  id="photos"  class="search_category">
                    <h2>Search Photos</h2>
                    <table>
                        <tbody><tr><td>
                                Posted by</td><td>
                                <input  class="rp_author-author"  name="author"  placeholder="Entity id"  value=""
                                        type="text"></td><td>
                                <input  class="rp_author"  name="rp_author-author"  onclick="add_filter(this,'author')"
                                        value="add filter"
                                        type="submit">
                            </td></tr>

                        <tr><td>
                                Tagged with location</td><td>
                                <input  class="rp_location-location"  name="location"  placeholder="Entity id"
                                        type="text"></td><td>
                                <input  class="rp_location"  name="rp_location-location"  onclick="add_filter(this,'location')"
                                        value="add filter"
                                        type="submit">
                            </td></tr>

                        <tr><td>
                                Photos you have seen</td><td>
                                <input  class="interacted_photos-interacted_photos"  name="interacted_photos"
                                        type="hidden"></td><td>
                                <input  class="interacted_photos"  name="interacted_photos-interacted_photos"
                                        onclick="add_filter(this,'location')"
                                        value="add filter"
                                        type="submit">
                            </td></tr>
                        </tbody></table>
                </div>








                <div  id="videos"  class="search_category">
                    <h2>Search Videos</h2>
                    <table>
                        <tbody><tr><td>
                                Live videos</td><td>
                                <input  class="videos_source-videos_live"  name="videos_live"  placeholder="Entity id"
                                        value=""
                                        type="hidden"></td><td>
                                <input  class="videos_source"  name="videos_source-videos_live"  onclick="add_filter(this,'videos_live')"
                                        value="add filter"
                                        type="submit"></td></tr>

                        <tr><td>
                                Episodes</td><td>
                                <input  class="videos_source-videos_episode"  name="videos_episode"  placeholder="Entity id"
                                        value=""
                                        type="hidden"></td><td>
                                <input  class="videos_source"  name="videos_source-videos_episode"  onclick="add_filter(this,'videos_episode')"
                                        value="add filter"
                                        type="submit"></td></tr>

                        <tr><td>
                                From friends and group</td><td>
                                <input  class="videos_source-videos_feed"  name="videos_feed"  placeholder="Entity id"
                                        value=""
                                        type="hidden"></td><td>
                                <input  class="videos_source"  name="videos_source-videos_feed"  onclick="add_filter(this,'videos_feed')"
                                        value="add filter"
                                        type="submit"></td></tr>


                        <tr><td>
                                Tagged with location</td><td>
                                <input  class="rp_location-location"  name="location"  placeholder="Entity id"
                                        type="text"></td><td>
                                <input  class="rp_location"  name="rp_location-location"  onclick="add_filter(this,'location')"
                                        value="add filter"
                                        type="submit"></td></tr>
                        </tbody></table>
                </div>




                <div  id="events"  class="search_category">
                    <h2>Search Events</h2>
                    <table>
                        <tbody><tr><td>
                                Location</td><td>
                                <input  class="rp_events_location-filter_events_location"  name="filter_events_location"
                                        placeholder="Location id"
                                        value=""
                                        type="text"></td><td>
                                <input  class="rp_events_location"  name="rp_events_location-filter_events_location"
                                        onclick="add_filter(this,'filter_events_location')"
                                        value="add filter"
                                        type="submit">
                            </td></tr>

                        </tbody></table>
                </div>




                <div  id="pages"  class="search_category">
                    <h2>Search Pages</h2>
                    <table>
                        <tbody><tr><td>
                                Verified</td><td>
                                <input  class="verified-pages_verified"  name="pages_verified"  value=""  type="hidden"></td><td>
                                <input  class="verified"  name="verified-pages_verified"  onclick="add_filter(this,'pages_verified')"
                                        value="add filter"
                                        type="submit"></td></tr>

                        <tr><td>
                                Local Business or Place</td><td>
                                <select  class="category-pages_category"  name="pages_category">
                                    <option  value="1006">Local Business or Place</option>
                                    <option  value="1013">Company, Organization, Or Institution</option>
                                    <option  value="1009">Brand or Product</option>
                                    <option  value="1007,180164648685982">Artist, Band, or Public Figure</option>
                                    <option  value="1019">Entertainment</option>
                                    <option  value="2612">Cause or Community</option>
                                </select></td><td>
                                <input  class="category"  name="category-pages_category"  onclick="add_filter(this,'pages_category')"
                                        value="add filter"
                                        type="submit">
                            </td></tr></tbody></table>

                </div>






                <div  id="filter-dates">

                    <h3>Filter by date</h3>
                    <table><tbody><tr><td>

                                Start date:</td><td>
                                <select  name="start_year"  id="start_year">
                                    <option  disabled="disabled"  selected="selected"  value=""> -- yyyy -- </option>
                                    <script  language="javascript"  type="text/javascript">
                                        var maxYear = new Date().getFullYear();
                                        for(var d=maxYear;d>2000;d--) { document.write('<option value="'+d+'"">'+d+'</option>'); }
                                    </script>
                                </select>
                                <select  name="start_month"  id="start_month">
                                    <option  disabled="disabled"  selected="selected"  value=""> -- mm -- </option>
                                    <script  language="javascript"  type="text/javascript">
                                        for(var d=1;d<=12;d++) { document.write('<option value="'+d+'"">'+d+'</option>'); }
                                    </script>
                                </select>
                                <select  name="start_day"  id="start_day">
                                    <option  disabled="disabled"  selected="selected"  value=""> -- dd -- </option>
                                    <script  language="javascript"  type="text/javascript">
                                        for(var d=1;d<=31;d++) { document.write('<option value="'+d+'"">'+d+'</option>'); }
                                    </script>
                                </select></td><td></td></tr>
                        <tr><td>
                                End date:</td><td>
                                <select  name="end_year"  id="end_year">
                                    <option  disabled="disabled"  selected="selected"  value=""> -- yyyy -- </option>
                                    <script  language="javascript"  type="text/javascript">
                                        var maxYear = new Date().getFullYear();
                                        for(var d=maxYear;d>2000;d--) { document.write('<option value="'+d+'"">'+d+'</option>'); }
                                    </script>
                                </select>
                                <select  name="end_month"  id="end_month">
                                    <option  disabled="disabled"  selected="selected"  value=""> -- mm -- </option>
                                    <script  language="javascript"  type="text/javascript">
                                        for(var d=1;d<=12;d++) { document.write('<option value="'+d+'"">'+d+'</option>'); }
                                    </script>
                                </select>
                                <select  name="end_day"  id="end_day">
                                    <option  disabled="disabled"  selected="selected"  value=""> -- dd -- </option>
                                    <script  language="javascript"  type="text/javascript">
                                        for(var d=1;d<=31;d++) { document.write('<option value="'+d+'"">'+d+'</option>'); }
                                    </script>
                                </select>
                            </td><td>
                                <input  name="date-filter"  value="Add date filter"  onclick="add_date_filter()"
                                        type="submit">
                            </td></tr>
                        </tbody></table>

                </div>

                <div  id="filter-keywords">

                    <h3>Filter by keywords</h3>

                    <input  name="search_keyword"  id="search_keyword"  placeholder="Keywords"  value=""
                            size="30"
                            type="text">

                </div>


                <div  id="final-buttons">
                    <input  name="make_url"  onclick="alert(make_url())"  value="Show URL"  type="submit">
                    <input  name="make_url"  onclick="window.open(make_url())"  value="Open URL in a new window"
                            type="submit">
                    <input  name="clear-filters"  value="Clear Filters"  onclick="clear_filters()"  type="submit">

                </div>



                <div  id="current-filters">
                    <h2>Current Filters</h2>

                </div>

            </div>
        </div>


    </div>
</main>