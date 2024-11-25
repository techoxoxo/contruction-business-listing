/**
 * Created by Vignesh on 10/04/2023.
 */

// <!--    Job Filter Script Starts-->

$('.job-filters').on('click', function () {
    var value = this.id;
    var type = $(this).attr("data-type");
    var current_url = $(location).attr('href');

    var href = new URL(current_url);
    if (type == 'category') {
        var new_url = current_url.replace(value, '');
    }

    if (type == 'city') {
        var city_all = href.searchParams.get('city');

        if (city_all.indexOf(value + ',') != -1) {

            var new_url = current_url.replace(value + ',', '');

        } else {
            var new_url = current_url.replace(value, '');
        }
    }

    if (type == 'job_type') {

        var job_type_all = href.searchParams.get('job_type');

        if (job_type_all.indexOf(value + ',') != -1) {
            var new_url = current_url.replace(value + ',', '');

        } else {
            var new_url = current_url.replace(value, '');
        }
    }

    if (type == 'job_salary') {
        var job_salary_all = href.searchParams.get('job_salary');

        if (job_salary_all.indexOf(value + ',') != -1) {

            var new_url = current_url.replace(value + ',', '');

        } else {
            var new_url = current_url.replace(value, '');
        }
    }

    if (type == 'sub_cat') {
        var sub_cat_all = href.searchParams.get('sub_cat');

        if (sub_cat_all.indexOf(value + ',') != -1) {

           var new_url = current_url.replace(value + ',', '');

        } else {
            new_url = current_url.replace(value, '');
        }
    }

    document.location.href = new_url;

});

// $("input[type='checkbox'], input[type='radio']").on( "click", jobFilter() );
// $("select").on( "change", jobFilter() );


$(".city_check, .sub_cat_check ,.job_type, .job_salary").on("click", jobFilter);
$("select").on("change", jobFilter);
$(document).on('change', 'input[type="checkbox"]', jobFilter);

function jobFilter() {

    // $(".all-job-total").css("opacity",0);

    var mainarray = [];

    var size = [];
    $('input[name="scheck"]:checked').each(function () {
        size.push($(this).val());
        $('.spansizecls').css('visibility', 'visible');
    });
    if (size === '') $('.spansizecls').css('visibility', 'hidden');
    var size_checklist = "&scheck=" + size;

    //To get Category values from All job page starts

    var cat_check = [];
    $('#cat_check :selected').each(function () {
        // $('input[name="cat_check"]:checked').each(function(){
        cat_check.push($(this).val());
    });

    var cat_checklist = "/" + cat_check;

    //To get Category values from All job page ends


    //To get Sub category values from All job page starts

    var sub_cat_check = [];
    $('input[name="sub_cat_check"]:checked').each(function () {
        sub_cat_check.push($(this).val());

    });

    var sub_cat_checklist = "&sub_cat=" + sub_cat_check;

    //To get Sub category values from All job page ends

    //To get job salary from All job page starts

    var job_salary = [];
    $('input[name="job_salary"]:checked').each(function () {
        job_salary.push($(this).val());

    });

    var job_salarylist = "&job_salary=" + job_salary;

    //To get Job Salary from All job page ends

    var city_check = [];
    $('input[name="city_check"]:checked').each(function () {
        city_check.push($(this).val());

    });
    var city_checklist = "&city=" + city_check;


    //To get Rating values from All job page starts

    var job_type = [];
    $('input[name="job_type"]:checked').each(function () {
        job_type.push($(this).val());
    });
    var job_typelist = "&job_type=" + job_type;

    //To get Rating values from All job page ends


    // var main_string = cat_checklist+sub_cat_checklist+job_typelist+city_checklist+job_salarylist;
    var main_string = sub_cat_checklist + job_typelist + city_checklist + job_salarylist;
    main_string = main_string.substring(1, main_string.length);

    var link = 'all-jobs';

    if (webpage_full_link !== null) {
        link = webpage_full_link + 'all-jobs';
    }

    window.location.href = link + cat_checklist + '?' + main_string;


    //$.ajax({
    //    type: "POST",
    //    url: link,
    //    data: main_string,
    //    cache: false,
    //    success: function(html){
    //        $(".all-job-total").html(html);
    //        $(".all-job-total").css("opacity",1);
    //    }
    //});

}

// <!--    Job Page Filter Script Ends-->