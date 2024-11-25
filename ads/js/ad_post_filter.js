/**
 * Created by Vignesh on 05-03-2024.
 */

// <!--    Ad Post Filter Script Starts-->

$('.ad-post-filters-span').on('click', function () {
    var value = this.id;
    var type = $(this).attr("data-type");
    var current_url = $(location).attr('href');

    var href = new URL(current_url);
    if (type == 'category') {
        href.searchParams.set('category', '');
    }

    if (type == 'city') {
        href.searchParams.set('city', '');
    }

    if (type == 'sort_by') {
        href.searchParams.set('sort_by', '');
    }

    if (type == 'calendar-date') {
        href.searchParams.set('calendar-date', '');
    }

    document.location.href = href.toString();

});

$(".cat_check, .sort_by, .city").on("change", adPostFilter);

//To get Date values from All Ad Post page starts

$('#newdate').datepicker({
    onSelect: function (dateText, inst) {
        if (dateText) {
            adPostFilter(dateText);
        }
    }
});

//To get Date values from All Ad Post page ends

function adPostFilter(date) {

    // $(".all-event-total").css("opacity",0);

    var mainarray = [];

    //To get Category values from All Ad Post page starts

    var cat_check = [];
    $('#cat_check :selected').each(function () {
        cat_check.push($(this).val());
    });

    var cat_checklist = "&category=" + cat_check;

    //To get Category values from All Ad Post page ends

    //To get Date values from All Ad Post page starts

    var newdate_check = [];
    if (date != null) {

        if( date == "[object Object]"){
            date = '';
            newdate_check.push(date);

        }else{
            newdate_check.push(date);
        }
        var date_checklist = "&calendar-date=" + newdate_check;

    }

    //To get City values from All Ad Post page starts

    var city_check = [];
    $('#city :selected').each(function () {
        city_check.push($(this).val());
    });

    var city_checklist = "&city=" + city_check;

    //To get City values from All Ad Post page ends

    //To get Sort values from All Ad Post page starts

    var ad_post_ser_cou = [];
    $('#sort_by :selected').each(function () {
        ad_post_ser_cou.push($(this).val());
    });
    var ad_post_ser_cou_list = "&sort_by=" + ad_post_ser_cou;

    //To get Sort values from All Ad Post page ends

    var main_string = cat_checklist + city_checklist + ad_post_ser_cou_list + date_checklist;
    main_string = main_string.substring(1, main_string.length);

    var link = 'all-ads/';

    if (webpage_full_link !== null) {
        link = webpage_full_link + 'all-ads/';
    }

    window.location.href = link + '?' + main_string;
}

// <!--    Ad Post Page Filter Script Ends-->