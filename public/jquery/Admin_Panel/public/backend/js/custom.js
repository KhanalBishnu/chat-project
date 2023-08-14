function submitSEOForm() {
    let validationFields = [
        'keyword', 'meta_description', 'meta_title'
    ];

    let response = this.validate(validationFields);
    if (response == 0) {
        $('#seo_form').submit();
    }

}

function submitReCaptchaForm() {
    let validationFields = [
        'site_key', 'secret_key'
    ];

    let response = this.validate(validationFields);
    if (response == 0) {
        $('#seo_form').submit();
    }
}

function validate(validationFields) {
    let error = 0;
    validationFields.forEach(element => {
        let el = document.querySelector("#" + element);
        let value = $('#' + element).val();
        if (value == null || value == '') {
            error++;
            // $('<span class="text-danger">Required</span>').insertAfter(el);
            $('#' + element).addClass('border border-danger');
        }
    });
    return error;
}

function keywordControl(type) {
    if (type == 'add') {
        $('#jpt').append('<div class="row"><div class="col"><div class="form-group"><input type="text" class="form-control" name="name[]"id="name"></div></div><div class="col"><div class="form-group "><input type="text" class="form-control" name="icon_class[]" id="icon_class"></div></div><div class="col"><div class="form-group "><input type="text" class="form-control" name="url[]" id="url"></div></div><div class="col"><div class="form-group  "><input type="file"  name="logo[]" id="logo"></div></div><div class="col-md-auto"><div class="form-group  "><a class="btn btn-danger py-1" onclick="keywordControl()">-</a></div></div></div>')
    } else {
        event.target.parentElement.parentElement.parentElement.remove();
    }
}

function addTeam(type) {
    if (type == 'add') {
        $('#jpt').append('<div class="row"><div class="col"><div class="form-group"><input type="text" class="form-control" name="name[]"id="name"></div></div><div class="col"><div class="form-group "><input type="text" class="form-control" name="designation[]" id="designation"></div></div><div class="col"><div class="form-group "><input type="text" class="form-control" name="description[]" id="description"></div></div><div class="col"><div class="form-group  "><input type="file"  name="img[]" id="img"></div></div><div class="col-md-auto"><div class="form-group  "><a class="btn btn-danger py-1" onclick="addTeam()">-</a></div></div></div>')
    } else {
        event.target.parentElement.parentElement.parentElement.remove();
    }
}

function addNews(type) {
    if (type == 'add') {
        $('#jpt').append('<div class="row"><div class="col"><div class="form-group"><input type="text" class="form-control" name="title[]"id="title"></div></div><div class="col"><div class="form-group "><input type="text" class="form-control" name="description[]" id="description"></div></div><div class="col"><div class="form-group "><input type="text" class="form-control" name="link[]" id="link"></div></div><div class="col"><div class="form-group "><input type="date" class="form-control" name="published_date[]" id="published_date"></div></div><div class="col"><div class="form-group  "><input type="file"  name="img[]" id="img"></div></div><div class="col-md-auto"><div class="form-group  "><a class="btn btn-danger py-1" onclick="addNews()">-</a></div></div></div>')
    } else {
        event.target.parentElement.parentElement.parentElement.remove();
    }
}

function addChart(type) {
    if (type == 'add') {
        $('#jpt').append('<div class="row"><div class="col"><div class="form-group"><input type="text" class="form-control" name="label[]"id="label"></div></div><div class="col"><div class="form-group "><input type="text" class="form-control" name="value[]" id="value"></div></div><div class="col-md-auto"><div class="form-group  "><a class="btn btn-danger py-1" onclick="addNews()">-</a></div></div></div>')
    } else {
        event.target.parentElement.parentElement.parentElement.remove();
    }
}

function showImage(id) {
    var file = event.target.files[0];
    $('#' + id).empty();

    if (file) {
        let reader = new FileReader();
        reader.onload = function (e) {
            $('#' + id).append('<img src="' + e.target.result + '" width="100" />');
        }
        reader.readAsDataURL(file);
    } else {
        $('#' + id).empty();
    }
}

function toggleCard() {
    $('#media-card').show();
    $('#section-card-custom').show();
    $('#mediabtn').hide();
    $('#table-div').hide();
}

$(document).ready(function () {
    $('#media-card').hide();
    
    $('#category-card-custom').hide();
    $('#section-card-custom').hide();
});

function submitMediaForm() {
    let validationFields = [
        'name', 'icon_class', 'url'
    ];

    let response = this.validate(validationFields);
    if (response == 0) {
        $('#media_form').submit();
    }
}

function submitNewsForm() {
    let validationFields = [
        'title', 'img'
    ];

    let response = this.validate(validationFields);
    if (response == 0) {
        $('#media_form').submit();
    }
}

function submitWebForm() {
    let validationFields = [
        'website_name', 'address', 'contact_number', 'email'
    ];

    let response = this.validate(validationFields);
    if (response == 0) {
        $('#seo_form').submit();
    }
}

function submitChartForm() {
    let validationFields = [
        'label', 'value'
    ];

    let response = this.validate(validationFields);
    if (response == 0) {
        $('#chart_form').submit();
    }
}
function submitQRForm() {
   

    if ($('#img').prop('files').length <= 0) {
        $('#img').addClass('border border-danger');
    }else{
        $('#qr_form').submit();

    }
    
}

function submitTeamForm() {
    let validationFields = [
        'name', 'designation'
    ];

    let response = this.validate(validationFields);
    if (response == 0) {
        $('#team_form').submit();
    }
}

function changePwd() {
    $('#error_msg').empty();
    let new_pass = $('#new_pass').val();
    let confirm_pass = $('#confirm_pass').val();
    let response = 1;
    if (new_pass == confirm_pass) {
        response = 0;
    } else {
        $('#error_msg').append('<small class="text-danger">Pwd didnot match</small>')
    }

    if (response == 0) {
        $('#pwd_form').submit();
    }
}

function submitSectionForm() {
    let validationFields = [
        'title'
    ];

    let response = this.validate(validationFields);
    if (response == 0) {
        $('#section_form').submit();
    }
}

function submitCategoryForm() {
    let validationFields = [
        'title'
    ];

    let response = this.validate(validationFields);
    if (response == 0) {
        $('#category_form').submit();
    }
}
function submitSubCategoryForm() {
    let validationFields = [
        'title'
    ];

    let response = this.validate(validationFields);
    if (response == 0) {
        $('#subcategory_form').submit();
    }
}
