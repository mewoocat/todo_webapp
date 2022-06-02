themeLoad(themeNum);
loadItems();
sortColor();

$("#calender-container").hide();
$(".calender-icon").addClass("active-icon");
$("#calender-mode").addClass("active-mode");
$(".active-icon").css("fill", "var(--main-bg)");
$("#sorting-container-buttons").hide();
$(".about-content").hide();

$(document).on("click", "#about-btn", function(){
  $(".about-content").toggle();
})

$(document).on("click", "#sort-button", function(){
  $("#sorting-container-buttons").toggle();
})

$(document).on("mouseenter", ".active-mode", function(){
  $(".active-icon").css("fill", "var(--light-grey)");
});
$(document).on("mouseleave", ".active-mode", function(){
  $(".active-icon").css("fill", "var(--main-bg)");
});

$(document).on("click", "#list-mode", function(){
  $("#list-container").show();
  $("#calender-container").hide();

  $(".calender-icon").css("fill", "var(--main-bg)");
  $(".list-icon").css("fill", "var(--light-grey)");

  $(".list-icon").removeClass("active-icon");
  $(".calender-icon").addClass("active-icon");

  $("#calender-mode").addClass("active-mode");
  $("#list-mode").removeClass("active-mode");

});

$(document).on("click", "#calender-mode", function(){
  $("#list-container").hide();
  $("#calender-container").show();

  $(".list-icon").css("fill", "var(--main-bg)");
  $(".calender-icon").css("fill", "var(--light-grey)");
  $(".calender-icon").removeClass("active-icon");
  $(".list-icon").addClass("active-icon");

  $("#calender-mode").removeClass("active-mode");
  $("#list-mode").addClass("active-mode");

  //$("#list-mode").addClass("active-mode");
  //$("#calender-mode").removeClass("active-mode");
});

$(document).on("click", "#add-edit-item-x-button", function(){
  document.getElementById("add-item-container").style.display = "none";
});

$(document).on("click", ".edit-button", function(){
    var id = $(this).attr("val");
    //$.post("includes/modeSwitch.php", {itemID: id, mode: "edit"});
    document.getElementById("add-item-container").style.display = "flex";

    $.ajax({
      type: "POST",
      url: "includes/modeSwitch.php",
      data: {itemID: id, mode: "edit"},
      dataType: "html",
      success: function(response){
        var result = JSON.parse(response);
        var type = result[2];
        if (type == "task"){
          type = "none";
          $('#add-item-input-date').hide();
        }
        $("#add-item-input-name").val(result[0]);
        $("#add-item-input-date").val(result[1]);
        $("#add-item-type-" + type).prop('checked', true);
      }
    });
    $("#add-item-menu-header-content").html("EDIT ITEM");
    $("#add-item-submit").html("EDIT ITEM");
});

$(document).on("click", ".checkbox", function(){
    deleteItemDb($(this).attr("val"));
    $(".checkbox-bg").css("transform", "scale(1)");
    $(".checkbox-a", this).addClass("animate");
    setTimeout(loadItems, 600);
});

$("#add-item-submit").click(function(event){
  event.preventDefault();

  if($("#add-item-input-name").val() != ""){
    addItemDb();
    setTimeout(function(){
      loadItems();
    }, 50);
    document.getElementById("add-item-container").style.display = "none";
  }
  else{
    $("#add-item-input-name").addClass("error-color");
    $("#add-item-input-name").attr("placeholder", "Please Enter a Name");
  }
});

$("#theme-btn").click(function(){
  console.log(themeNum);
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200){
      themeNum = this.responseText;
      themeLoad(themeNum);
    }
  }
  xhttp.open("GET", "includes/theme.inc.php", true);
  xhttp.send();
});

$("#overflow-x-button").click(function(){
  $("#overflow-content-window").hide();
  $("#overflow-bg").css("display", "none");
});

$(".list-item-content-name").each(function(){
  if ($(this).text().length > 16){
    var text = $(this).text();
    text = text.substr(0, 16) + '...';
    $(this).text(text);
  }
});

$('#add-item-type-none').click(function(){
  $('#add-item-input-date').hide();
});

$('#add-item-type-event').click(function(){
  $('#add-item-input-date').show();
});

$('#add-item-type-due').click(function(){
  $('#add-item-input-date').show();
});

function themeLoad(num){
  if (num == 0){
    document.documentElement.style.setProperty('--main-bg', '#2f3136ff');
    document.documentElement.style.setProperty('--menu-bg', '#151618ff');
    document.documentElement.style.setProperty('--purple', '#3d2f7bff');
    document.documentElement.style.setProperty('--light-grey', '#c3c3c3ff');
  }
  else if (num == 1){
    document.documentElement.style.setProperty('--main-bg', '#467b7fff');
    document.documentElement.style.setProperty('--menu-bg', '#314f59ff');
    document.documentElement.style.setProperty('--purple', '#bca238ff');
    document.documentElement.style.setProperty('--light-grey', '#efefeff0');
  }
}

function open_add_item_menu(){
  $("#add-item-input-name").removeClass("error-color");
  document.getElementById("add-item-container").style.display = "flex";
  $.post("includes/modeSwitch.php", {itemID: 0, mode: "add"});
  $("#add-item-menu-header-content").html("ADD ITEM");
  $("#add-item-submit").html("ADD ITEM");
  document.getElementById("add-item-input-name").value = "";
  document.getElementById("add-item-type-event").checked = "checked";
  $('#add-item-input-date').show();
  document.getElementById("add-item-input-date").value = dateGen();
}

function open_settings_menu(){
  if (document.getElementById("settings-menu-container").style.display == "flex"){
    document.getElementById("settings-menu-container").style.display = "none";
  }
  else{
    document.getElementById("settings-menu-container").style.display = "flex";
  }
}

function open_overflow_content_window(content){
  document.getElementById('overflow-content').innerHTML = content;
  document.getElementById('overflow-content-window').style.display = "flex";
  document.getElementById('overflow-bg').style.display = "flex";
}

function loadItems(){
  $.ajax({
    type: "POST",
    url: "includes/loadItem.inc.php",
    dataType: "html",
    success: function(response){
      $("#todo-list").html(response);
      console.log("updated list");
    }
  });
}

function addItemDb(){
  $.post("includes/addItem.inc.php", $("#add-item-form").serialize());
}

function deleteItemDb(id){
  $.post("includes/deleteItem.inc.php", {itemId: id});
}

function sortColor(){
  if (sort_type == "all"){
    $('#all').css("color", "var(--green)");
  }

  if(sort_type == "today"){
    $('#today').css("color", "var(--green)");
  }

  if(sort_type == "task"){
    $('#task').css("color", "var(--green)");
  }

  if(sort_type == "overdue"){
    $('#overdue').css("color", "var(--green)");
  }
}


function dateGen(){
  var dateObj = new Date();
  var yyyy = dateObj.getFullYear();
  var mm = dateObj.getMonth() + 1;
  mm = mm.toString();
  if (mm.length < 2){
    mm = '0' + mm;
  }
  var dd = dateObj.getDate();
  dd = dd.toString();
  if (dd.length < 2){
    dd = '0' + dd;
  }
  var date = yyyy + '-' + mm + '-' + dd;
  return date;
}
